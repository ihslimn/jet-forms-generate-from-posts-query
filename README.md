Specify the query ID, property to get values from, and property to get labels from:
https://prnt.sc/20xajrc  

5|_ID|cct_created|cct_author_id
- 5 is the query ID
- _ID is the property from which values will be filled
- cct_created is the property from which labels will be filled
- cct_author_id is the property from which calculated values will be filled

Values, labels, and calculated values can be filtered.

Example for WC Query:\
(values will be product IDs, labels - product names)

```
add_filter( 'jet-forms-generate-from-query/value', function( $value, $object ) {
	if( is_a( $object ,'WC_Product') ){
		$value = $object->get_id();
	}
	return $value;
}, 0, 2 );

add_filter( 'jet-forms-generate-from-query/label', function( $label, $object ) {
	if( is_a( $object ,'WC_Product') ){
		$label = $object->get_name();
	}
	return $label;
}, 0, 2 );
```
