<?php
if ( ! defined('ABSPATH') ) exit;

/**
 * General action, hooks loader
*/
class CG_Loader {

	protected $cg_actions;
	protected $cg_filters;

	/**
	 * Class Constructor
	*/
	function __construct() {

		$this->cg_actions = array();
		$this->cg_filters = array();
	}

	function add_action( $hook, $component, $callback ) {

		$this->cg_actions = $this->add( $this->cg_actions, $hook, $component, $callback );
	}

	function add_filter( $hook, $component, $callback ) {

		$this->cg_filters = $this->add( $this->cg_filters, $hook, $component, $callback );
	}

	private function add( $hooks, $hook, $component, $callback ) {

		$hooks[] = array( 'hook' => $hook, 'component' => $component, 'callback' => $callback );
		return $hooks;
	}

	public function cg_run() {

		foreach( $this->cg_filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}

		foreach( $this->cg_actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}
	}
}
?>