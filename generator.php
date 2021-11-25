<?php

use Jet_Engine\Query_Builder\Manager as Query_Manager;

class Jet_Forms_Posts_Query_Generator extends \Jet_Engine\Forms\Generators\Base {

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
	 * @return array
	 */
	public function generate( $field ) {

		$query = Query_Manager::instance()->get_query_by_id( $field );
		$posts = $query->_get_items();

		foreach ($posts as $post) {
			$result[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
			);
		}
		return $result;

	}

}
