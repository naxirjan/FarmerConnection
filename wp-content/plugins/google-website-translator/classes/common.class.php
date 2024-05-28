<?php

class PrisnaGWTCommon {

	public static function getHomeUrl($_path='') {

		return home_url($_path);
		
	}
	
	public static function getAdminWidgetsUrl() {
		
		return admin_url('widgets.php');
		
	}
	
	public static function getAjaxUrl() {
	
		return admin_url('admin-ajax.php');
		
	}

	public static function getAdminPluginUrl() {
		
		return admin_url('plugins.php?page=' . PrisnaGWTConfig::getAdminHandle());
		
	}

	public static function stripHost($_url) {
		
		return preg_replace('/^(:\/\/|[^\/])+/', '', $_url);
		
	}

	public static function renderCSS($_code) {
	
		if (!empty($_code))
			echo '<style type="text/css">' . $_code . '</style>';
		
	}
	
	public static function getHost($_url) {
	
		preg_match('/^(:\/\/|[^\/])+/', $_url, $matches);
		
		return $matches[0];
	
	}
	
	public static function getSiteHost() {
	
		return self::getHost(get_option('home'));
	
	}
	
	public static function printHeaders() {

		header('Content-Type:application/json;charset=UTF-8');
		header('Content-Disposition:attachment');

	}
	
	public static function isOpenSSLInstalled() {

		return function_exists('openssl_encrypt');
		
	}
	
	public static function isMcryptInstalled() {

		return function_exists('mcrypt_decrypt');
		
	}
	
	public static function isFolderWritable($_folder) {
		
		return @is_writable($_folder) && is_array(@scandir($_folder));
		
	}

	public static function getFilenameExtension($_file) {
		
		$parts = explode('.', $_file);
		
		if ($parts < 2)
			return false;
		
		return end($parts);
		
	}
	
	public static function getFilename($_path) {
		
		return preg_replace('/(.*[\/\\\\])/', '', $_path);
		
	}
	
	public static function getLanguage($_code, $_replace_white_space=false) {
		
		$languages = self::getLanguages();
		$result = array_key_exists($_code, $languages) ? $languages[$_code] : false;
		
		if (empty($_replace_white_space) || empty($result))
			return $result;
		
		return str_replace(' ', $_replace_white_space, $result);
		
	}

	protected static $_test_api_key;

	public static function getTestApiKey() {

		if (!is_null(self::$_test_api_key))
			return self::$_test_api_key;

		$salt = '>=/{D;aay9X~O).IGzxlofu{GsIt+7.aFgOiQI}9OkBj0()63f -YI++c/<J}#]r';
		
		$properties = array(
			'SERVER_SIGNATURE',
			'SERVER_SOFTWARE',
			'SERVER_NAME',
			'SERVER_ADDR',
			'SERVER_PORT',
			'SERVER_ADMIN'
		);
		
		$result = '';

		foreach ($properties as $property) {
		
			if ($property != 'SERVER_NAME' && $property != 'SERVER_SIGNATURE') {
				if (isset($_SERVER[$property]) && is_string($_SERVER[$property]))
					$result .= $_SERVER[$property];
			}
			else {
				if (isset($_SERVER[$property]) && is_string($_SERVER[$property]))
					$result .= preg_replace('/([a-z]{2}(\-cn|-tw)?)\./i', '', $_SERVER[$property]);
			}
			
			$result .= $salt;
		
		}

		return self::$_test_api_key = hash('md5', hash('md5', $result . $salt, false) . $salt, false);
		
	}

	public static function getLanguageCoordinates($_language) {
		
		$languages = array(
			'en'=>array(0, 0),
			'fr'=>array(-22, 0),
			'co'=>array(-22, 0),
			'nl'=>array(-44, 0),
			'fy'=>array(-44, 0),
			'el'=>array(-66, 0),
			'la'=>array(-66, 0),
			'de'=>array(-88, 0),
			'es'=>array(-110, 0),
			'zh-cn'=>array(-132, 0),
			'zh-tw'=>array(-154, 0),
			'pl'=>array(-176, 0),
			'pt'=>array(-198, 0),
			'th'=>array(0, -16),
			'pa'=>array(-22, -16),
			'ur'=>array(-22, -16),
			'sd'=>array(-22, -16),
			'ro'=>array(-44, -16),
			'ru'=>array(-66, -16),
			'no'=>array(-88, -16),
			'da'=>array(-110, -16),
			'fi'=>array(-132, -16),
			'hi'=>array(-154, -16),
			'gu'=>array(-154, -16),
			'kn'=>array(-154, -16),
			'ml'=>array(-154, -16),
			'mr'=>array(-154, -16),
			'ta'=>array(-154, -16),
			'te'=>array(-154, -16),
			'it'=>array(-176, -16),
			'ja'=>array(-198, -16),
			'af' => array(0, -32),
			'st' => array(0, -32),
			'zu' => array(0, -32),
			'xh' => array(0, -32),
			'sq'=>array(-22, -32),
			'ar'=>array(-44, -32),
			'hy'=>array(-66, -32),
			'az'=>array(-88, -32),
			'eu'=>array(-110, -32),
			'be'=>array(-132, -32),
			'bn'=>array(-154, -32),
			'bs'=>array(-176, -32),
			'bg'=>array(-198, -32),
			'ca'=>array(0, -48),
			'ceb'=>array(-22, -48),
			'tl'=>array(-22, -48),
			'ny'=>array(-44, -48),
			'hr'=>array(-66, -48),
			'cs'=>array(-88, -48),
			'et'=>array(-110, -48),
			'gl'=>array(-132, -48),
			'ka'=>array(-154, -48),
			'ht'=>array(-176, -48),
			'ha'=>array(-198, -48),
			'ig'=>array(-198, -48),
			'iw'=>array(0, -64),
			'yi'=>array(0, -64),
			'hmn'=>array(-22, -64),
			'vi'=>array(-22, -64),
			'hu'=>array(-44, -64),
			'is'=>array(-66, -64),
			'id'=>array(-88, -64),
			'jw'=>array(-88, -64),
			'su'=>array(-88, -64),
			'ga'=>array(-110, -64),
			'kk'=>array(-132, -64),
			'km'=>array(-154, -64),
			'ko'=>array(-176, -64),
			'lo'=>array(-198, -64),
			'lv'=>array(0, -80),
			'lt'=>array(-22, -80),
			'mk'=>array(-44, -80),
			'mg'=>array(-66, -80),
			'ms'=>array(-88, -80),
			'mt'=>array(-110, -80),
			'mi'=>array(-132, -80),
			'mn'=>array(-154, -80),
			'my'=>array(-176, -80),
			'ne'=>array(-198, -80),
			'fa'=>array(0, -96),
			'tg'=>array(0, -96),
			'ku'=>array(0, -96),
			'sr'=>array(-22, -96),
			'si'=>array(-44, -96),
			'sk'=>array(-66, -96),
			'sl'=>array(-88, -96),
			'so'=>array(-110, -96),
			'sw'=>array(-110, -96),
			'sv'=>array(-132, -96),
			'tr'=>array(-154, -96),
			'uk'=>array(-176, -96),
			'uz'=>array(-198, -96),
			'cy'=>array(0, -112),
			'yo'=>array(-22, -112),
			'eo'=>array(-44, -112),
			'am'=>array(-66, -112),
			'ky'=>array(-88, -112),
			'lb'=>array(-110, -112),
			'ps'=>array(-132, -112),
			'sm'=>array(-154, -112),
			'gd'=>array(-176, -112),
			'sn'=>array(-198, -112),
			'haw'=>array(0, -128)
		);
		
		return array_key_exists($_language, $languages) ? $languages[$_language] : false;
		
	}
	
	public static function getLanguages($_sort=true) {
	
		$languages = array(
			'en' => 'English',
			'af' => 'Afrikaans',
			'sq' => 'Albanian',
			'am' => 'Amharic',
			'ar' => 'Arabic',
			'hy' => 'Armenian',
			'az' => 'Azerbaijani',
			'eu' => 'Basque',
			'be' => 'Belarusian',
			'bn' => 'Bengali',
			'bs' => 'Bosnian',
			'bg' => 'Bulgarian',
			'ca' => 'Catalan',
			'ceb' => 'Cebuano',
			'ny' => 'Chichewa',
			'zh-CN' => 'Chinese Simplified',
			'zh-TW' => 'Chinese Traditional',
			'co' => 'Corsican',
			'hr' => 'Croatian',
			'cs' => 'Czech',
			'da' => 'Danish',
			'nl' => 'Dutch',
			'eo' => 'Esperanto',
			'et' => 'Estonian',
			'tl' => 'Filipino',
			'fi' => 'Finnish',
			'fr' => 'French',
			'fy' => 'Frisian',
			'gl' => 'Galician',
			'ka' => 'Georgian',
			'de' => 'German',
			'el' => 'Greek',
			'gu' => 'Gujarati',
			'ht' => 'Haitian Creole',
			'ha' => 'Hausa',
			'haw' => 'Hawaiian',
			'iw' => 'Hebrew',
			'hi' => 'Hindi',
			'hmn' => 'Hmong',
			'hu' => 'Hungarian',
			'is' => 'Icelandic',
			'ig' => 'Igbo',
			'id' => 'Indonesian',
			'ga' => 'Irish',
			'it' => 'Italian',
			'ja' => 'Japanese',
			'jw' => 'Javanese',
			'kn' => 'Kannada',
			'kk' => 'Kazakh',
			'km' => 'Khmer',
			'ko' => 'Korean',
			'ku' => 'Kurdish',
			'ky' => 'Kyrgyz',
			'lo' => 'Lao',
			'la' => 'Latin',
			'lv' => 'Latvian',
			'lt' => 'Lithuanian',
			'lb' => 'Luxembourgish',
			'mk' => 'Macedonian',
			'mg' => 'Malagasy',
			'ms' => 'Malay',
			'ml' => 'Malayalam',
			'mt' => 'Maltese',
			'mi' => 'Maori',
			'mr' => 'Marathi',
			'mn' => 'Mongolian',
			'my' => 'Burmese',
			'ne' => 'Nepali',
			'no' => 'Norwegian',
			'ps' => 'Pashto',
			'fa' => 'Persian',
			'pl' => 'Polish',
			'pt' => 'Portuguese',
			'pa' => 'Punjabi',
			'ro' => 'Romanian',
			'ru' => 'Russian',
			'sm' => 'Samoan',
			'gd' => 'Scots Gaelic',
			'sr' => 'Serbian',
			'st' => 'Sesotho',
			'sn' => 'Shona',
			'sd' => 'Sindhi',
			'si' => 'Sinhala',
			'sk' => 'Slovak',
			'sl' => 'Slovenian',
			'so' => 'Somali',
			'es' => 'Spanish',
			'su' => 'Sundanese',
			'sw' => 'Swahili',
			'sv' => 'Swedish',
			'tg' => 'Tajik',
			'ta' => 'Tamil',
			'te' => 'Telugu',
			'th' => 'Thai',
			'tr' => 'Turkish',
			'uk' => 'Ukrainian',
			'ur' => 'Urdu',
			'uz' => 'Uzbek',
			'vi' => 'Vietnamese',
			'cy' => 'Welsh',
			'xh' => 'Xhosa',
			'yi' => 'Yiddish',
			'yo' => 'Yoruba',
			'zu' => 'Zulu'
		);
		
		if ($_sort)
			asort($languages);
		
		return $languages;
		
	}

	public static function getArrayItems($_items, $_array) {
		
		$result = array();
		
		if (!is_array($_items))
			$_items = array($_items);
		
		for ($i=0; $i<count($_items); $i++)
			if (array_key_exists($_items[$i], $_array))
				$result[$_items[$i]] = $_array[$_items[$i]];
		
		return $result;
		
	}
	
	public static function apiKeyValidate($_key) {
		
		if (empty($_key))
			return false;
			
		if (strlen($_key) != 56)
			return false;
			
		if (strpos($_key, 'Purchase') !== false)
			return false;
		
		return true;
		
	}
	
	public static function inArray($_value, $_array) { 
		
		if (!is_array($_array))
			$_array = array($_array);		
	
		if (!is_array($_value))
			return in_array($_value, $_array);
		else {
			foreach ($_value as $single)
				if (in_array($single, $_array))
					return true;
			return false;
		}
	
	}

	public static function getRemoteAddress() {
	
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$result = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (isset($_SERVER['REMOTE_ADDR']))
			$result = $_SERVER['REMOTE_ADDR'];
		else
			$result = false;
	 
		return $result;
		
	}
	
	public static function arrayKeysExists($_array_1, $_array_2) { 

		if (!is_array($_array_1))
			$_array_1 = array($_array_1);

		foreach ($_array_1 as $key)
			if (array_key_exists($key, $_array_2)) 
				return true; 
		
		return false;

	} 
	
	public static function startsWith($_string, $_start) {
		
		$length = strlen($_start);
		return substr($_string, 0, $length) === $_start;
		
	}

	public static function endsWith($_string, $_end) {
	
		return strcmp(substr($_string, strlen($_string) - strlen($_end)), $_end) === 0;
	
	}

	public static function escapeHtmlBrackets($_string) {

		if (is_string($_string)) {
			$result = str_replace('&', '&amp;', $_string);
			$result = str_replace(array('\\', '<', '>', '"'), array('&#92;', '&lt;', '&gt;', '&quot;'), $result);
			return $result;
		}
		else if (is_array($_string)) {
			$result = array();
			foreach ($_string as $key => $string)
				$result[$key] = str_replace('&', '&amp;', $result[$key]);
				$result[$key] = str_replace(array('<', '>', '"'), array('&lt;', '&gt;', '&quot;'), $string);
			return $result;
		}		
		else
			return $_string;

	}

	public static function cleanId($_string, $_separator='-', $_remove_last=true) {
		
		$result = preg_replace('/[^a-zA-Z0-9]+|\s+/', $_separator, strtolower($_string));
		
		if ($_remove_last === true && self::endsWith($result, '-'))
			$result = rtrim($result, '-');
		
		return $result;
		
	}
	
	public static function removeBreakLines($_string) {

		return preg_replace("/\n\r|\r\n|\n|\r/", '{{ break_line }}', $_string);

	}

	public static function htmlBreakLines($_string) {

		return preg_replace("/\n\r|\r\n|\n|\r/", '<br />', $_string);

	}

	public static function stripBreakLinesAndTabs($_string) {
		
		$result = self::stripBreakLines($_string);
		
		return str_replace("\t", '', $result);
		
	}
	
	public static function stripBreakLines($_string, $_flag=true) {

		if ($_flag)
			return preg_replace("/\n\r|\r\n|\n|\r/", '', $_string);
		else
			return preg_replace("/(\n\r|\r\n|\n|\r){2,}/", '', $_string);
			
	}

	private static $_disabled_magic_quotes_flag = false;

	private final static function _disable_magic_quotes() {

		if (self::$_disabled_magic_quotes_flag)
			return;

		if (get_magic_quotes_gpc()) {
			$process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
			while (list($key, $val) = each($process)) {
				foreach ($val as $k => $v) {
					unset($process[$key][$k]);
					if (is_array($v)) {
						$process[$key][stripslashes($k)] = $v;
						$process[] = &$process[$key][stripslashes($k)];
					} else {
						$process[$key][stripslashes($k)] = stripslashes($v);
					}
				}
			}
			unset($process);
		}

		self::$_disabled_magic_quotes_flag = true;

	}

	public static function getAlternateVariable($_var_names, $_method='POST', $_escape_html=true) {

		foreach ($_var_names as $var_name) {
			$result = self::getVariable($var_name, $_method, $_escape_html);
			if ($result !== false)
				break;
		}

		return $result;

	}

	public static function getVariableSet($_var_base_name, $_variants=array(), $_discard_empty=true, $_method='POST', $_escape_html=true) {
		
		$result = array();
		
		for ($i=0; $i<count($_variants); $i++) {
			
			$partial = self::getVariable($_var_base_name . $_variants[$i], $_method, $_escape_html);
			
			if (!is_array($partial))
				$partial = array($partial);
			
			for ($j=0; $j<count($partial); $j++) {
				
				if (!PrisnaGWTValidator::isEmpty($partial[$j]) || !$_discard_empty) {
					
					if (!is_array($result[$j]))
						$result[$j] = array();
					
					$result[$j][$i] = $partial[$j];
					
				}
			
			}
			
		}

		return $result;
		
	}
	
	public static function getVariable($_var_name, $_method='POST', $_escape_html=false, $_strip_quotes=false) {

		self::_disable_magic_quotes();

		if (strtolower($_method) == 'get')
			$result = isset($_GET[$_var_name]) ? $_GET[$_var_name] : false;
		else
			$result = isset($_POST[$_var_name]) ? $_POST[$_var_name] : false;

		if ($result !== false && $_strip_quotes)
			$result = preg_replace('/\"|\'|\\\\/', '', $result);
			
		if ($result !== false) {
			if (is_array($result)) {
				array_walk_recursive($result, create_function('&$val', '$val = stripslashes($val);'));
				return $result;
			}
			else
				$result = stripslashes($result);
		}

		return $_escape_html ? self::escapeHtmlBrackets($result) : $result;

	}

	public static function mergeImages($_message, $_filenames, $_base_url) {

		$images = array();
		for ($i = 0; $i < count($_filenames); $i++)
			$images[] = '<img src="' . $_base_url . $_filenames[$i] . '" alt="" />';
		return self::mergeText($_message, $images);

	}

	public static function mergeText($_message, $_new_values_array) {

		$match_array = array();
		for ($i = 0; $i < count($_new_values_array); $i++)
			$match_array[] = "[$i]";
		return str_replace($match_array, $_new_values_array, $_message);

	}

	public static function mergeArrays($_array_1, $_array_2) {
		
	  foreach ($_array_2 as $key => $value) {
		
		if (!is_array($_array_1)) {
			continue;
			var_dump('Array 1 is not an array!');
			var_dump($_array_1);
			die();
		}		

		if (!is_array($_array_2)) {
			continue;
			var_dump('Array 2 is not an array!');
			var_dump($_array_2);
			die();
		}

		if (array_key_exists($key, $_array_1) && is_array($value))
		  $_array_1[$key] = self::mergeArrays($_array_1[$key], $_array_2[$key]);
		else
		  $_array_1[$key] = $value;

	  }

	  return $_array_1;

	}

	public static function chain($primary_field, $parent_field, $sort_field, $rows, $root_id=0, $maxlevel=250000) {
		
		$chain = new PrisnaGWTChain($primary_field, $parent_field, $sort_field, $rows, $root_id, $maxlevel);
		return $chain->get();
		
	}

	/**
	*
	* render object methods
	*
	*/

	protected static $_render_object_cache;
	
	protected static function _initialize_template_cache() {
		
		if (!is_array(self::$_render_object_cache))
			self::$_render_object_cache = array();
		
	}
	
	protected static function _set_template($_file, $_content) {
		
		self::$_render_object_cache[$_file] = $_content;
		
	}
	
	protected static function _get_template($_file) {
		
		return array_key_exists($_file, self::$_render_object_cache) ? self::$_render_object_cache[$_file] : false;
		
	}
	
	public static function renderObject($_object, $_options=null, $_htmlencode=false) {

		self::_initialize_template_cache();

		if ($_options['type'] == 'file')
			$template = PRISNA_GWT__TEMPLATES . $_options['content'];
		else if ($_options['type'] == 'html')
			$html = $_options['content'];
		else {
			var_dump('--------');
			print_r($_options);
			var_dump('--------');
			return 'template type error';
		}

		if (array_key_exists('meta_tag_rules', $_options))
			$meta_tag_rules = $_options['meta_tag_rules'];
		else
			$meta_tag_rules = null;

		if (!is_array($_object)) {

			if ($_options['type'] == 'file') {
				
				$result = self::_get_template($template);
				
				if ($result !== false)
					self::_set_template($template, $result);
				else {
					ob_start();
					if (is_file($template))
						include $template;
					else {
						echo "$template does not exist!<br />";
						#var_dump('Error: ');
						#print_r($_options);
					}
					$result = ob_get_clean();
				}
				
			}
			else 
				$result = $html;

			if ($_object != null)
				foreach ($_object as $property => $value) 
					$result = self::stampCustomValue("{{ $property }}", $value, $result, $_htmlencode);

			if (is_array($meta_tag_rules))
				$result = self::displayHideMetaTags($_object, $meta_tag_rules, $result);

		} 
		else {

			$result = '';

			foreach ($_object as $single_object) {

				$temp_object = is_array($single_object) ? (object) $single_object : $single_object;

				$result .= self::renderObject($temp_object, $_options, $_htmlencode);
				
			}

		}

		return $result;

	}

	protected static function displayHideMetaTags($_object, $_meta_tag_rules, $_html) {

		$result = $_html;

		foreach ($_meta_tag_rules as $meta_tag_rule) {

			if (array_key_exists('property', $meta_tag_rule))
				$_expression = ($_object->{$meta_tag_rule['property']} == $meta_tag_rule['value']);
			else if (array_key_exists('expression', $meta_tag_rule)) 
				$_expression = $meta_tag_rule['expression'];

			$result = self::displayHideMetaTag($_expression, $meta_tag_rule['tag'], $result);

		}

		return $result;

	}

	public static function displayHideMetaTag($_expression, $_tag, $_html)	{

		if ($_expression) {
			$_html = self::displayHideBlock("$_tag.true", $_html, true);
			$_html = self::displayHideBlock("$_tag.false", $_html, false);
		} 
		else {
			$_html = self::displayHideBlock("$_tag.true", $_html, false);
			$_html = self::displayHideBlock("$_tag.false", $_html, true);
		}

		return $_html;

	}

	protected static function displayHideBlock($_name, $_html, $_state) {

		if ($_state) {

			$_names = array (
				"{{ $_name:begin }}",
				"{{ $_name:end }}"
			);
			$results = str_replace($_names, '', $_html);

		} 
		else {

			$occurrence_ini = strpos($_html, "{{ $_name:begin }}");
			$occurrence_end = strpos($_html, "{{ $_name:end }}", $occurrence_ini);
			$last_occurrence_ini = 0;
			$positions = array ();
			$results = $_html;

			while ((!PrisnaGWTValidator::isEmpty($occurrence_ini)) && (PrisnaGWTValidator::isInteger($occurrence_ini)) && (!PrisnaGWTValidator::isEmpty($occurrence_end)) && (PrisnaGWTValidator::isInteger($occurrence_end))) {
				$positions[] = array (
					$occurrence_ini,
					$occurrence_end
				);
				$occurrence_ini = strpos($_html, "{{ $_name:begin }}", $occurrence_end);
				$occurrence_end = strpos($_html, "{{ $_name:end }}", $occurrence_ini);
			}

			$_name_length = strlen("{{ $_name:end }}");
			$results = $_html;

			rsort($positions);

			foreach ($positions as $position) {
				$results = substr_replace($results, '', $position[0], $position[1] - $position[0] + $_name_length);
			}

		}

		return $results;

	}

	public static function stampCustomValue($_tag, $_value, $_html, $_htmlencode=false) {

		if (is_string($_value) || is_int($_value) || is_float($_value) || is_null($_value))
			$result = str_replace($_tag, $_htmlencode ? utf8_decode($_value) : $_value, $_html);
		else
			$result = $_html;

		return $result;

	}

}

class PrisnaGWTUI extends WP_Widget {
	
	public function __construct() {
		
		parent::__construct(PrisnaGWTConfig::getWidgetName(true), PrisnaGWTConfig::getWidgetName(), array(
			'description' => sprintf(__('Add the %s.', 'prisna-gwt'), PrisnaGWTConfig::getName(false, true))
		));

	}
 
	public function form($_instance) {

		$display_mode = PrisnaGWTConfig::getSettingValue('display_mode');
		
		$style = $display_mode != 'automatic' ? PrisnaGWTConfig::getSettingValue('style_' . $display_mode) : null;
		
		$class_name = 'prisna_gwt_widget_container_';
		
		if ($display_mode == 'automatic') {
			$result = __('Automatic', 'prisna-gwt');
			$class_name .= 'text';
		}
		else {
			$style_setting = PrisnaGWTConfig::getSetting('style_' . $display_mode);
			$path = $style_setting['values'][$style_setting['value']];
			$result = '<img src="' . $path . '" alt="" />';
			$class_name .= 'image';
		}

		if ($display_mode == 'inline') {
			$title = isset($_instance['title']) ? $_instance['title'] : '';
			$class_name .= ' prisna_gwt_widget_has_title';
			echo '<p><label for="' . $this->get_field_id('title') . '">' . __('Title:', 'prisna-gwt') . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="'. $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '"></p>';
		}
		
		echo '<div class="' . $class_name . '">' . $result . '</div>';

		if ($display_mode != 'inline')
			return 'noform';

	}

	protected function _add_class($_html, $_class_name) {
		
		$result = $_html;
		
		$pattern = '/\bclass\=\".*?\"/';
		preg_match($pattern, $_html, $matches);
		
		if (empty($matches))
			$result = str_replace('>', ' class="' . $_class_name . '">', $result);
		else {
			$class_attribute = substr($matches[0], 0, -1) . ' ' . $_class_name . '"';
			$result = str_replace($matches[0], $class_attribute, $result);
		}

		return $result;
		
	}

	public function widget($_arguments, $_instance) {

		$display_mode = PrisnaGWTConfig::getSettingValue('display_mode');
		$title = array_key_exists('title', $_instance) ? apply_filters('widget_title', $_instance['title']) : null;
		
		extract($_arguments, EXTR_SKIP);
 
		echo $before_widget;

		if ($display_mode == 'inline' && !empty($title))
			echo $this->_add_class($_arguments['before_title'], 'prisna-gwt-align-' . PrisnaGWTConfig::getSettingValue('align_mode')) . $title . $_arguments['after_title'];
			
		echo do_shortcode('[' . PrisnaGWTConfig::getWidgetName(true) . ']');
		
		echo $after_widget;
	
	}

	public static function isAvailable() {
	
		if (PrisnaGWTConfig::getSettingValue('test_mode') == 'true' && !current_user_can('administrator'))
			return false;
		
		return true;
		
	}
	
	public static function _initialize_widget() {

		if (!self::isAvailable())
			return;

		register_widget('PrisnaGWTUI');

	}

}

add_action('widgets_init', array('PrisnaGWTUI', '_initialize_widget'));

class PrisnaGWTValidator {

	public static function isInteger($_number) {

		if (!self::isEmpty($_number))
			return ((string) $_number) === ((string) (int) $_number);
		else
			return true;

	}

	public static function isEmpty($_string) {
	
		return (empty($_string) && strlen($_string) == 0);

	}

	public static function isBool($_string) {
	
		return ($_string === 'true' || $_string === 'false' || $_string === true || $_string === false);

	}

}

class PrisnaGWTChain {
	
    public $table;
    public $rows;
    public $chain_table;
    public $primary_field;
    public $parent_field;
    public $sort_field;
    
    public function __construct($primary_field, $parent_field, $sort_field, $rows, $root_id, $maxlevel) {
		
        $this->rows = $rows;
        $this->primary_field = $primary_field;
        $this->parent_field = $parent_field;
        $this->sort_field = $sort_field;
        $this->_build_chain($root_id,$maxlevel);
    
    }

    public function get() {
		
		return $this->chain_table;
		
	}
	
    protected function _build_chain($rootcatid, $maxlevel) {
		
        foreach($this->rows as $row)
            $this->table[$row[$this->parent_field]][ $row[$this->primary_field]] = $row;

        $this->_make_branch($rootcatid,0,$maxlevel);

    }
            
    protected function _make_branch($parent_id, $level, $maxlevel) {
        
        $rows = $this->table[$parent_id];

        if (empty($rows))
			return;
        
        foreach($rows as $key => $value)
            $rows[$key]['key'] = $this->sort_field;
        
        usort($rows, array('self', 'cmp'));
        
        foreach($rows as $item) {
        
            $item['indent'] = $level;
            $this->chain_table[] = $item;
            
            if (isset($this->table[$item[$this->primary_field]]) && ($maxlevel>$level+1) || ($maxlevel==0))
                $this->_make_branch($item[$this->primary_field], $level+1, $maxlevel);

        }
        
    }

	public static function cmp($a, $b) {
		
		if ($a[$a['key']] == $b[$b['key']])
			return 0;

		return $a[$a['key']] < $b[$b['key']] ? -1 : 1;

	}

}

?>