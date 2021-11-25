<?php

use Jet_Engine\Query_Builder\Manager as Query_Manager;

class Jet_Fb_Posts_Query_Generator extends Jet_Form_Builder\Generators\Base {


	/**
	 * Returns generator ID
	 *
	 * @return string
	 */
	public function get_id() {
		return 'get_from_query';
	}

	/**
	 * Returns generator name
	 *
	 * @return string
	 */
	public function get_name() {
		return 'Get values list from JetEngine Posts Query';
	}

	/**
	 * Returns generated options list
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public function generate( $args ) {
		$result = array();

		$field = isset( $args['generator_field'] ) ? $args['generator_field'] : $args;

		$query = Query_Manager::instance()->get_query_by_id( $field );
		$result = array();
		if ( $query && $query->query_type == 'posts' ) {		

			$posts = $query->_get_items();

			foreach ($posts as $post) {
				$result[] = array(
					'value' => $post->ID,
					'label' => $post->post_title,
				);
			}
		}
		return $result;
	}

}
