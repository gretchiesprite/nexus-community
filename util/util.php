<?php

class Util {

	public static function sanitize($in) {
		$out = strtr($in, array('(' => '&#40;',
                          	')' => '&#41;',
									        	'"' => '&#34;',
									        	'<' => '&#60;',
									        	'>' => '&#62;',
									        	'&' => '&#38;'));
		return $out;
	}
	
	public static function clean($in) {
		$out = strtr($in, array('(' => '',
                          	')' => '',
									        	'"' => '',
									        	'<' => '',
									        	'>' => '',
									        	'&' => ''));
		$out = trim($out);
		return $out;
	}
	
	public static function validateEmail($in) {
		if (filter_var($in, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	public static function authenticate($uid, $pass) {
		
		$goodUsers = array(
			'anita' => 'good',
			'ada' => 'good',
			'grace' => 'good',
			'jean' => 'good',
			'barbara' => 'good',
			'kathy' => 'good'
		);
		
		if (array_key_exists($uid, $goodUsers)) {
			return true;
		}
		return false;
	}

}

?>