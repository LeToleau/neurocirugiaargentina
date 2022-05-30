<?php
/**
 * Advanced Archive
 * This class contains the logic for displaying an archive page based on user entry 
 * By default post types are displayed separately in an index view 
 * filters can be used to limit view which produces a more traditional combined list
 *
 * @todo Convert selections to ARIA list box component
 */

if( !function_exists( 'AdvancedArchive' ) ){
	function AdvancedArchive(){
		return NSAAdvancedArchive::getInstance();
	}
	AdvancedArchive();
}

class NSAAdvancedArchive{

	private static $instance = null;

	protected $display_type_filter = false;
	protected $display_search_filter = false;

	protected $search = '';
	protected $type = '';
	protected $types = [];
	protected $filters = [];
	protected $page = 1;

	protected $setup = false;
	protected $index = true;
	protected $index_url = '/resources';
	protected $base_url = '/resources';
	protected $view = 'featured';

	protected $selections = [];

	public static function getInstance(){

		if ( self::$instance == null ){
			self::$instance = new NSAAdvancedArchive();
		}

		return self::$instance;
	}

	function __construct(){
		add_action( 'wp_ajax_order/advanced-archive-post', [ $this, '_ajax_results' ] );
		add_action( 'wp_ajax_nopriv_order/advanced-archive-post', [ $this, '_ajax_results' ] );
	}

	/**
	 * Load settings from current archive post, also read any query values and set class variables
	 */
	function setup(){

		if( $this->setup ){
			return;
		}

		$archive = (int)$this->query_arg( 'archive' );
		if( 0 !== $archive ){
			$post = get_post( $archive );
			setup_postdata( $GLOBALS['post'] =& $post );
		}
		$this->index_url = get_permalink();
		$this->base_url = get_permalink();

		$this->page = $this->query_arg( 'rpage' );
		$this->search = $this->query_arg( 'search' );
		$this->type = $this->query_arg( 'type' );

		while( have_rows( 'post_types' ) ):
			the_row();
			$type = get_sub_field( 'post_type' );
			$obj = get_post_type_object( $type );
			$filter_label = "Filter by Category";
			if( '' === $filter_label ){
				$filter_label = $obj->labels->singular_name;
			}
			$section_label = get_sub_field( 'featured_section_label' );
			if( '' === $section_label ){
				$section_label = __( 'Featured', 'Order' ) .' '. $obj->labels->name;
			}
			$view_all_label = get_sub_field( 'view_all_label' );
			if( '' === $view_all_label ){
				$view_all_label = __( 'See All', 'Order' ) .' '. $obj->labels->name;
			}

			$this->types[ $type ] = [
				'type' => $type,
				'filter_label' => $filter_label,
				'section_label' => $section_label,
				'view_all_label' => $view_all_label,
				'allow_featured' => get_sub_field( 'allow_featured' ),
			];
		endwhile;

		$taxonomy = 'category';
		$obj = get_taxonomy( $taxonomy );
		$filter_label = 'Filter By Category';

		$this->filters[ $taxonomy ] = [
			'taxonomy' => $taxonomy,
			'filter_label' => $filter_label,
			'value' => $this->query_arg( $taxonomy ),
		];

		$this->display_type_filter = get_field( 'type_filter' );
		$this->display_search_filter = get_field( 'search' );

		wp_reset_postdata();

		$this->setup = true;
	}

	/**
	 * Establish our archive parameters
	 * all products by default ordered by menu order desc, alphabet asc
	 */
	function _build_query( $params = [] ){
		$args = $params += [
			'post_type' => array_keys( $this->types ),
			'post_status' => 'publish',
			'orderby' => [
				'menu_order' => 'DESC',
				'date' => 'DESC',
			],
			'posts_per_page' => -1,
			'tax_query' => [],
			'paged' => $this->page,
		];

		if( '' !== trim( $this->search ) ){
			$this->index = false;
			$args['s'] = $this->search;
		}

		//add in any post type filter
		if( '' !== trim( $this->type ) ){
			$this->index = false;
			$args['post_type'] = $this->type;
		}

		// foreach( $this->filters as $taxonomy => $filter ){
			$args['tax_query'] = array(
				array(
					$this->filters['taxonomy']
				)
			);
			foreach( $this->filters as $taxonomy => $filter ){
				if( isset( $filter['value'] ) && '' !== $filter['value'] ){
					$this->index = false;
					$args['tax_query'][] = [
						'taxonomy' => $taxonomy,
						'field' => 'slug',
						'terms' => $filter['value']
					];
				}
			}
		// }

		return apply_filters( 'order/advanced-archive/query', $args );
	}

	/**
	 * Display output of archive based on settings within archive template and query parameters
	 */
	function display( $include_wrapper = true ){
		$this->setup();

		if( $include_wrapper ){
			get_template_part( 'template-parts/resources/wrapper', 'begin', [
				'filters' => $this->filters,
			] );
		}

		switch( $this->view ){
			case 'featured':
			default:
				$this->featured_view();
			break;
		}

		if( $include_wrapper ){
			get_template_part( 'template-parts/resources/wrapper', 'end' );
		}
	}

	/**
	 * View where each post type has it's own section
	 * this allows for each post type to have it's own sort when on the index page
	 */
	function featured_view(){
		$query_args = $this->_build_query([
			// 'posts_per_page' => 12
		]);

			$raw_resources = new WP_Query( $query_args );
			$template_args = [
				'resources' => $raw_resources,
				'clear_link' => $this->clear_link(),
				'selections' => $this->selections,
				'index_url' => $this->index_url,
				'base_url' => $this->base_url,
			];

			$resources = [];

			//get our featured resources
			while( $raw_resources->have_posts() ):
				$raw_resources->the_post();
				$resources[] = $raw_resources->post;
			endwhile;

			if( !$this->index ){
				get_template_part( 'template-parts/resources/query-details', '', $template_args );
			}

			if( $raw_resources->have_posts() ) : 
				get_template_part( 'template-parts/resources/begin', '', $template_args );

				if( $template_args['resources']->query_vars['paged'] == 0 ) {					// Cut the first 5 elements of the Resources
					if( $this->index ){
						$sliced = array_splice( $resources, 0 , 6 );
		
						foreach( $sliced as $slice ){
							setup_postdata( $GLOBALS['post'] =& $slice );
							
							get_template_part( 'template-parts/cards/blog', 'archive' );
						}

						get_template_part( 'template-parts/modules/module-side_text_w_cta' );
					}
				}
				
				foreach( $resources as $resource ){
					setup_postdata( $GLOBALS['post'] =& $resource );
					get_template_part( 'template-parts/cards/blog', 'archive');
				}
				wp_reset_postdata();
				get_template_part( 'template-parts/resources/end', '', $template_args );
			else:
				get_template_part( 'template-parts/resources/none', '', $template_args );
			endif;

	}

	/**
	 * Filter based on post type
	 */
	function type_filter(){

		$label = __( 'Resource Type', 'Order' );
		$ret = [];

		$ret[] = '<label for="Resources_type" class="screen-reader-text">'. $label .'</label>';
		$ret[] = '<div class="filter-archive js-filter-archive">';
		$ret[] = '<div class="filter-archive__label js-filter-archive-open" name="type" id="Resources_type">' . $label . '</div>';
		$ret[] = '<div class="filter-archive__option-container">';
		// $ret[] = '<option value="">' . $label . '</option>';

		foreach( $this->types as $post_type => $type ):
			$sel = '';

			if( $this->type === $post_type ){
				$sel = ' SELECTED';
				$this->selections[] = esc_html( $type['filter_label'] );
				$this->base_url = add_query_arg( 'type', $post_type, $this->base_url );
			}

			$value = esc_attr( $post_type );
			$label = esc_html( $type['filter_label'] );
			$ret[] = "<span class='filter-archive__option js-filter-archive-option-selected' {$sel} value='{$value}'>{$label}</span>";
		endforeach;

		$ret[] = '</div>';
		$ret[] = '</div>';

		return implode( "\n", $ret );
	}

	/**
	 * Field for displaying any searched terms
	 */
	function search_filter(){
		$ret = [];

		$terms = esc_attr( $this->search );
		if( '' !== trim( $this->search ) ){
			$this->selections[] = esc_html( $this->search );
			$this->base_url = add_query_arg( 'search', $this->search, $this->base_url );
		}
		$placeholder = __( 'SEARCH FOR TOPICS AND CONTENT', 'Order' );

		$ret[] = "<input class='resource-archive__search' id='Resources_search' type='text' name='search' value='{$terms}' placeholder='{$placeholder}'>";


		return implode( "\n", $ret );
	}

	/**
	 * Build general taxonomy filter for resources
	 */
	function taxonomy_filter( $params = [] ){

		$params += [
			'taxonomy' => $params['taxonomy'],
			'filter_label' => '',
		];

		$terms = get_terms( array(
			'taxonomy' => $params['taxonomy'],
			)
		);

		if( 0 === count( $terms ) ){
			return '';
		}

		$label = $params['filter_label'];

		$ret = [];

		$ret[] = '<div class="filter-archive js-filter-archive">';
		$ret[] = '<div class="filter-archive__label js-filter-archive-open" name="'.$params['taxonomy'].'" id="Resources_'.$params['taxonomy'].'">
		<div class="filter-archive__label-title">' . $label . '</div>
		<svg width="29" height="16" viewBox="0 0 29 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M27.5444 1.45581L14.2725 14.7278L1.00049 1.45581" stroke="black" stroke-width="1.5"/>
		</svg>
		</div>';
		$ret[] = '<div class="filter-archive__option-container">';
		$ret[] = '<a class="filter-archive__option" href="' . $this->clear_link() .'">All</a>';

		foreach( $terms as $term ):
			$sel = '';

			if( $params['value'] === $term->slug ){
				$sel = ' SELECTED';
				$this->selections[] = esc_html( $term->name );
				$this->base_url = add_query_arg( $params['taxonomy'], $term->slug, $this->base_url );
			}

			$value = esc_attr( $term->slug);
			$label = esc_html( $term->name );
			$ret[] = "<span class='filter-archive__option js-filter-archive-option-selected' {$sel} value='{$value}'>{$label}</span>";
		endforeach;

		$ret[] = '</div>';
		$ret[] = '</div>';

		return implode( "\n", $ret );
	}

	/**
	 * This should return a link to index page without any filtering or paging on it
	 */
	function clear_link( $params = [] ){
		$defaults = [
			'type' => false,
			'search' => false,
			'rpage' => false,
		];

		foreach( $this->filters as $taxonomy => $settings ){
			$defaults[ $taxonomy ] = false;
		}

		$params += $defaults;

		return add_query_arg( $params, $this->index_url);
	}

	/**
	 * handle ajax postback
	 */
	function _ajax_results(){

		add_filter( 'paginate_links', [ $this, 'remove_action' ] );

		//do setup and apply filters to set selections variable before display
		$this->setup();
		foreach( $this->filters as $taxonomy => $filter ):
			AdvancedArchive()->taxonomy_filter( $filter );
		endforeach;
		$this->search_filter();
		$this->display( false );
		exit;
	}

	/**
	 * removes ajax action from url when doing ajax postback
	 */
	function remove_action( $link ){
		return add_query_arg( 'action', false, $link );
	}

	/**
	 * Get a query arg from get or post
	 */
	function query_arg( $var ){
		$ret = '';
		$ret = ( isset( $_GET[ $var ] ) && '' !== $_GET[ $var ] )? $_GET[ $var ]:$ret;
		$ret = ( isset( $_POST[ $var ] ) && '' !== $_POST[ $var ] )? $_POST[ $var ]:$ret;
		return $ret;
	}

}
