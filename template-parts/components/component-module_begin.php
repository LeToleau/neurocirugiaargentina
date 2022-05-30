<?php
/**
 * Define padding related classes - appearance tab
 */
$padding_options = get_sub_field( 'padding_options' );
$padding_top = $padding_options['padding_top'];
if( '' == $padding_top ){
	$padding_top = 'padding--top-50';
}
$padding_bottom = $padding_options['padding_bottom'];
if( '' == $padding_bottom ){
	$padding_bottom = 'padding--bottom-50';
}

/**
 * Developer tab options
 */
$id = get_sub_field( 'anchor' );
if( '' !== $id ){
	$id = "id='{$id}'";
}

echo "<section {$id} class='module module--{$module} {$padding_top} {$padding_bottom}'>";
