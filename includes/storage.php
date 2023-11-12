<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) {
	exit; }

// Get theme variable
if ( ! function_exists( 'fcunited_storage_get' ) ) {
	function fcunited_storage_get( $var_name, $default = '' ) {
		global $FCUNITED_STORAGE;
		return isset( $FCUNITED_STORAGE[ $var_name ] ) ? $FCUNITED_STORAGE[ $var_name ] : $default;
	}
}

// Set theme variable
if ( ! function_exists( 'fcunited_storage_set' ) ) {
	function fcunited_storage_set( $var_name, $value ) {
		global $FCUNITED_STORAGE;
		$FCUNITED_STORAGE[ $var_name ] = $value;
	}
}

// Check if theme variable is empty
if ( ! function_exists( 'fcunited_storage_empty' ) ) {
	function fcunited_storage_empty( $var_name, $key = '', $key2 = '' ) {
		global $FCUNITED_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return empty( $FCUNITED_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return empty( $FCUNITED_STORAGE[ $var_name ][ $key ] );
		} else {
			return empty( $FCUNITED_STORAGE[ $var_name ] );
		}
	}
}

// Check if theme variable is set
if ( ! function_exists( 'fcunited_storage_isset' ) ) {
	function fcunited_storage_isset( $var_name, $key = '', $key2 = '' ) {
		global $FCUNITED_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return isset( $FCUNITED_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return isset( $FCUNITED_STORAGE[ $var_name ][ $key ] );
		} else {
			return isset( $FCUNITED_STORAGE[ $var_name ] );
		}
	}
}

// Inc/Dec theme variable with specified value
if ( ! function_exists( 'fcunited_storage_inc' ) ) {
	function fcunited_storage_inc( $var_name, $value = 1 ) {
		global $FCUNITED_STORAGE;
		if ( empty( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = 0;
		}
		$FCUNITED_STORAGE[ $var_name ] += $value;
	}
}

// Concatenate theme variable with specified value
if ( ! function_exists( 'fcunited_storage_concat' ) ) {
	function fcunited_storage_concat( $var_name, $value ) {
		global $FCUNITED_STORAGE;
		if ( empty( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = '';
		}
		$FCUNITED_STORAGE[ $var_name ] .= $value;
	}
}

// Get array (one or two dim) element
if ( ! function_exists( 'fcunited_storage_get_array' ) ) {
	function fcunited_storage_get_array( $var_name, $key, $key2 = '', $default = '' ) {
		global $FCUNITED_STORAGE;
		if ( empty( $key2 ) ) {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $FCUNITED_STORAGE[ $var_name ][ $key ] ) ? $FCUNITED_STORAGE[ $var_name ][ $key ] : $default;
		} else {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $FCUNITED_STORAGE[ $var_name ][ $key ][ $key2 ] ) ? $FCUNITED_STORAGE[ $var_name ][ $key ][ $key2 ] : $default;
		}
	}
}

// Set array element
if ( ! function_exists( 'fcunited_storage_set_array' ) ) {
	function fcunited_storage_set_array( $var_name, $key, $value ) {
		global $FCUNITED_STORAGE;
		if ( ! isset( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$FCUNITED_STORAGE[ $var_name ][] = $value;
		} else {
			$FCUNITED_STORAGE[ $var_name ][ $key ] = $value;
		}
	}
}

// Set two-dim array element
if ( ! function_exists( 'fcunited_storage_set_array2' ) ) {
	function fcunited_storage_set_array2( $var_name, $key, $key2, $value ) {
		global $FCUNITED_STORAGE;
		if ( ! isset( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = array();
		}
		if ( ! isset( $FCUNITED_STORAGE[ $var_name ][ $key ] ) ) {
			$FCUNITED_STORAGE[ $var_name ][ $key ] = array();
		}
		if ( '' === $key2 ) {
			$FCUNITED_STORAGE[ $var_name ][ $key ][] = $value;
		} else {
			$FCUNITED_STORAGE[ $var_name ][ $key ][ $key2 ] = $value;
		}
	}
}

// Merge array elements
if ( ! function_exists( 'fcunited_storage_merge_array' ) ) {
	function fcunited_storage_merge_array( $var_name, $key, $value ) {
		global $FCUNITED_STORAGE;
		if ( ! isset( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$FCUNITED_STORAGE[ $var_name ] = array_merge( $FCUNITED_STORAGE[ $var_name ], $value );
		} else {
			$FCUNITED_STORAGE[ $var_name ][ $key ] = array_merge( $FCUNITED_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Add array element after the key
if ( ! function_exists( 'fcunited_storage_set_array_after' ) ) {
	function fcunited_storage_set_array_after( $var_name, $after, $key, $value = '' ) {
		global $FCUNITED_STORAGE;
		if ( ! isset( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			fcunited_array_insert_after( $FCUNITED_STORAGE[ $var_name ], $after, $key );
		} else {
			fcunited_array_insert_after( $FCUNITED_STORAGE[ $var_name ], $after, array( $key => $value ) );
		}
	}
}

// Add array element before the key
if ( ! function_exists( 'fcunited_storage_set_array_before' ) ) {
	function fcunited_storage_set_array_before( $var_name, $before, $key, $value = '' ) {
		global $FCUNITED_STORAGE;
		if ( ! isset( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			fcunited_array_insert_before( $FCUNITED_STORAGE[ $var_name ], $before, $key );
		} else {
			fcunited_array_insert_before( $FCUNITED_STORAGE[ $var_name ], $before, array( $key => $value ) );
		}
	}
}

// Push element into array
if ( ! function_exists( 'fcunited_storage_push_array' ) ) {
	function fcunited_storage_push_array( $var_name, $key, $value ) {
		global $FCUNITED_STORAGE;
		if ( ! isset( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			array_push( $FCUNITED_STORAGE[ $var_name ], $value );
		} else {
			if ( ! isset( $FCUNITED_STORAGE[ $var_name ][ $key ] ) ) {
				$FCUNITED_STORAGE[ $var_name ][ $key ] = array();
			}
			array_push( $FCUNITED_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Pop element from array
if ( ! function_exists( 'fcunited_storage_pop_array' ) ) {
	function fcunited_storage_pop_array( $var_name, $key = '', $defa = '' ) {
		global $FCUNITED_STORAGE;
		$rez = $defa;
		if ( '' === $key ) {
			if ( isset( $FCUNITED_STORAGE[ $var_name ] ) && is_array( $FCUNITED_STORAGE[ $var_name ] ) && count( $FCUNITED_STORAGE[ $var_name ] ) > 0 ) {
				$rez = array_pop( $FCUNITED_STORAGE[ $var_name ] );
			}
		} else {
			if ( isset( $FCUNITED_STORAGE[ $var_name ][ $key ] ) && is_array( $FCUNITED_STORAGE[ $var_name ][ $key ] ) && count( $FCUNITED_STORAGE[ $var_name ][ $key ] ) > 0 ) {
				$rez = array_pop( $FCUNITED_STORAGE[ $var_name ][ $key ] );
			}
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if ( ! function_exists( 'fcunited_storage_inc_array' ) ) {
	function fcunited_storage_inc_array( $var_name, $key, $value = 1 ) {
		global $FCUNITED_STORAGE;
		if ( ! isset( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = array();
		}
		if ( empty( $FCUNITED_STORAGE[ $var_name ][ $key ] ) ) {
			$FCUNITED_STORAGE[ $var_name ][ $key ] = 0;
		}
		$FCUNITED_STORAGE[ $var_name ][ $key ] += $value;
	}
}

// Concatenate array element with specified value
if ( ! function_exists( 'fcunited_storage_concat_array' ) ) {
	function fcunited_storage_concat_array( $var_name, $key, $value ) {
		global $FCUNITED_STORAGE;
		if ( ! isset( $FCUNITED_STORAGE[ $var_name ] ) ) {
			$FCUNITED_STORAGE[ $var_name ] = array();
		}
		if ( empty( $FCUNITED_STORAGE[ $var_name ][ $key ] ) ) {
			$FCUNITED_STORAGE[ $var_name ][ $key ] = '';
		}
		$FCUNITED_STORAGE[ $var_name ][ $key ] .= $value;
	}
}

// Call object's method
if ( ! function_exists( 'fcunited_storage_call_obj_method' ) ) {
	function fcunited_storage_call_obj_method( $var_name, $method, $param = null ) {
		global $FCUNITED_STORAGE;
		if ( null === $param ) {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $FCUNITED_STORAGE[ $var_name ] ) ? $FCUNITED_STORAGE[ $var_name ]->$method() : '';
		} else {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $FCUNITED_STORAGE[ $var_name ] ) ? $FCUNITED_STORAGE[ $var_name ]->$method( $param ) : '';
		}
	}
}

// Get object's property
if ( ! function_exists( 'fcunited_storage_get_obj_property' ) ) {
	function fcunited_storage_get_obj_property( $var_name, $prop, $default = '' ) {
		global $FCUNITED_STORAGE;
		return ! empty( $var_name ) && ! empty( $prop ) && isset( $FCUNITED_STORAGE[ $var_name ]->$prop ) ? $FCUNITED_STORAGE[ $var_name ]->$prop : $default;
	}
}
