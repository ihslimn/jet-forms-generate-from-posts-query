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

		$field = isset( $args['generator_field'] ) ? $args['generator_field'] : $args;

		$args = explode( '|', $field );

		$query_id = $args[0];
		$value_field = isset( $args[1] ) ? $args[1] : 'ID';
		$label_field = isset( $args[2] ) ? $args[2] : 'post_title';
		$additional_args = isset( $args[3] ) ? $args[3] : '';

		$query = Query_Manager::instance()->get_query_by_id( $query_id );
		$result = array();
		if ( $query ) {		
			$query->setup_query();
			$objects = $query->_get_items();

			foreach ($objects as $object) {

				$value = isset( $object->$value_field ) ? $object->$value_field : null;
				$label = isset( $object->$label_field ) ? $object->$label_field : null;

				$value = apply_filters( 'jet-forms-generate-from-query/value', $value, $object, $additional_args );
				$label = apply_filters( 'jet-forms-generate-from-query/label', $label, $object, $additional_args );

				if ( isset( $value ) && isset( $label ) ) {
					$result[] = array(
						'value' => $value,
						'label' => $label,
					);
				}
			}
		}
		return $result;
	}

}
