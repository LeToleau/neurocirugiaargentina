<?php
/**
 * Setup activation and deactivation functions
 */
class AlphaOmega{

	function __construct(){
		add_action( 'after_switch_theme', [ $this, '_activation' ] );
		add_action( 'switch_theme', [ $this, '_deactivation' ] );
	}

	function _activation(){
		do_action( 'wcanvas-boilerplate/activate' );
	}

	function _deactivation(){
		do_action( 'wcanvas-boilerplate/deactivate' );
	}

}
