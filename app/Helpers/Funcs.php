<?php

/**
 * print out url
 * @method string  print_link
 * @param string  path
 * @return void
 */
function print_link($path = "")
{
	echo url($path);
}

/**
 * print out url
 * @method string  print_link
 * @param string  path
 * @return void
 */
function getImgSizePath($src, $size="medium")
{
	if($src){
		//currently Radsystems does not save different sizes of images in s3 bucket
		//rough implementation of detecting s3 bucket file
		$isawsS3File = stripos($src, ".amazonaws.com") > 5; 
		if($size &&  !$isawsS3File){
			$paths = explode("/", $src);
			$lastpath = count($paths) - 1;
			array_splice($paths, $lastpath, 0, $size);
			$src = implode("/", $paths);
		}
	}
	else{
		$src = "/images/no-image-available.png";
	}
	return url($src);
}



/**
 * Return the GET value from the request or a default value
 * @method string  get_value
 * @param string  $fieldname
 * @param string  $default
 * @return string
 */
function get_value($fieldname, $default = "")
{
	return request()->get($fieldname, $default);
}

/**
 * replace non alphabetical letters with hyphen and convert to lower case
 * @method string slugify
 * @param string $text
 * @return string
 */
function slugify($text)
{
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, '-');

	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);

	// lowercase
	$text = strtolower($text);
	return $text;
}

/**
 * Generates RFC 4122 compliant Version 4 UUIDs.
 * @param  string $data
 * @return string
 */
function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

/**
 * Convert a multi-dimensional, associative array to CSV data
 * @param  array $data the array of data
 * @return string
 */
function arr_to_csv($data)
{
	# Generate CSV data from array
	$fh = fopen('php://temp', 'rw'); # don't create a file, attempt # to use memory instead
	# write out the headers
	fputcsv($fh, array_keys(current($data)));
	# write out the data
	foreach ($data as $row) {
		fputcsv($fh, $row);
	}
	rewind($fh);
	$csv = stream_get_contents($fh);
	fclose($fh);
	return $csv;
}

/**
 * Recursively implodes an array with optional key inclusion
 * 
 * Example of $include_keys output: key, value, key, value, key, value
 * 
 * @access  public
 * @param   array   $array         multi-dimensional array to recursively implode
 * @param   string  $glue          value that glues elements together	
 * @param   bool    $include_keys  include keys before their values
 * @param   bool    $trim_all      trim ALL whitespace from string
 * @return  string  imploded array
 */
function recursive_implode(array $array, $glue = ',', $include_keys = false, $trim_all = false)
{
	$glued_string = '';
	// Recursively iterates array and adds key/value to glued string
	array_walk_recursive($array, function ($value, $key) use ($glue, $include_keys, &$glued_string) {
		$include_keys and $glued_string .= $key . $glue;
		$glued_string .= $value . $glue;
	});
	// Removes last $glue from string
	strlen($glue) > 0 and $glued_string = substr($glued_string, 0, -strlen($glue));
	// Trim ALL whitespace
	$trim_all and $glued_string = preg_replace("/(\s)/ixsm", '', $glued_string);
	return (string) $glued_string;
}


/**
 * Convert laravel validation error message bag to string
 * @access  public
 * @param   array   $errArray
 * @return  string  imploded array
 */
function validationErrorsToString($errArray)
{
	$valArr = array();
	foreach ($errArray->toArray() as $key => $value) {
		$errStr = $key . ' ' . $value[0];
		array_push($valArr, $errStr);
	}
	if (!empty($valArr)) {
		$errStrFinal = implode(',', $valArr);
	}
	return $errStrFinal;
}

/**
 * Build new url with additional query params
 * @param array $params
 * @example URL before:
 * https://example.com/orders/123?order=ABC009
 *
 * 1. add_query_params(['status' => 'shipped'])
 * 2. add_query_params(['status' => 'shipped', 'coupon' => 'CCC2019'])
 *
 * URL after:
 * 1. https://example.com/orders/123?order=ABC009&status=shipped
 * 2. https://example.com/orders/123?order=ABC009&status=shipped&coupon=CCC2019
 * 
 * @return string
 */
function add_query_params(array $params = [])
{
	$query = array_merge(
		request()->query(),
		$params
	); // merge the existing query parameters with the ones we want to add

	return url()->current() . '?' . http_build_query($query); // rebuild the URL with the new parameters array
}

/**
 * Build new url by removing specified query params
 * @param array $params
 * @example URL before:
 * https://example.com/orders/123?order=ABC009&status=shipped
 *
 * 1. remove_query_params(['status'])
 * 2. remove_query_params(['status', 'order'])
 *
 * URL after:
 * 1. https://example.com/orders/123?order=ABC009
 * 2. https://example.com/orders/123
 * 
 * @return string
 */
function remove_query_params(array $params = [])
{
	$url = url()->current(); // get the base URL - everything to the left of the "?"
	$query = request()->query(); // get the query parameters (what follows the "?")

	foreach ($params as $param) {
		unset($query[$param]); // loop through the array of parameters we wish to remove and unset the parameter from the query array
	}
	return $query ? $url . '?' . http_build_query($query) : $url; // rebuild the URL with the remaining parameters, don't append the "?" if there aren't any query parameters left
}


/**
 * Parse csv file into multidimensional array
 * @param string $file_path
 * @param array $options
 * @return array
 */
function parse_csv_file($file_path, $options)
{
	$arr_data = array();
	if (($csv_handle = fopen($file_path, "r")) === FALSE)
		throw new Exception('Cannot open CSV file');

	extract($options);

	if (empty($fields)) {
		$columns = array_map(function ($field) {
			return strtolower(preg_replace("/[^a-zA-Z0-9_]/i", '', $field));
		}, fgetcsv($csv_handle, 0, $delimiter, $quote));
	} else {
		$columns = (is_array($fields) ? $fields : explode(",", $fields));
	}

	if (empty($delimiter))
		$delimiter = ',';

	if (empty($quote))
		$quote = '"';

	while (($row = fgetcsv($csv_handle, 0, $delimiter, $quote)) !== FALSE) {
		$arr_data[] = array_combine($columns, $row);
	}
	return $arr_data;
}


/**
 * Sometimes REMOTE_ADDR does not returns the correct IP address of the user. 
 * The reason behind this is to use Proxy. In that situation, use the following code to get real IP address of user in PHP.
 * @return string
 */
function get_user_ip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		//ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		//ip pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

/**
 * encode data to json and convert special characters to unicode 
 * for display in HTMl attribute
 * @param string $data
 * @return  string
 */
function json_encode_quote($data)
{
	return json_encode($data, JSON_HEX_APOS | JSON_HEX_QUOT);
}

/**
 * Merge array of paths to a url
 * 
 * @method string saveFile
 * @param array $arr_paths
 * @param string $separator
 * @return string
 */
function path_combine($arr_paths, $separator = "/")
{
	$paths = [];
	foreach ($arr_paths as $path) {
		$path = str_replace('/', $separator, $path);
		$path = str_replace('\\', $separator, $path);
		$paths[] = trim($path, $separator);
	}
	$paths = array_filter($paths);
	return join($separator, $paths);
}



/**
 * will return current DateTime in Mysql Default Date Time Format
 * @return  string
 */
function datetime_now()
{
	return date("Y-m-d H:i:s");
}

/**
 * will return current Time in Mysql Default Date Time Format
 * @return  string
 */
function time_now()
{
	return date("H:i:s");
}

/**
 * will return current Date in Mysql Default Date Time Format
 * @return  string
 */
function date_now()
{
	return date("Y-m-d");
}

/**
 * will return a date in specified format
 * @param string $date_str
 * @param string $format
 * @return  string
 */
function format_date($date_str, $format = 'Y-m-d H:i:s')
{
	if (!empty($date_str)) {
		return date($format, strtotime($date_str));
	}
	return date($format);
}

/**
 * Parse Date Or Timestamp Object into Relative Time (e.g. 2 days Ago, 2 days from now)
 * @param string $date
 * @return  string
 */
function relative_date($date)
{
	if (empty($date)) {
		return "";
	}

	$periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

	$now = time();

	//check if supplied Date is in unix date form
	if (is_numeric($date)) {
		$unix_date        = $date;
	} else {
		$unix_date         = strtotime($date);
	}
	// check validity of date
	if (empty($unix_date)) {
		return "Bad date";
	}

	// is it future date or past date
	if ($now > $unix_date) {
		$difference     = $now - $unix_date;
		$tense         = "ago";
	} else {
		$difference     = $unix_date - $now;
		$tense         = "from now";
	}

	for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
		$difference /= $lengths[$j];
	}

	$difference = round($difference);

	if ($difference != 1) {
		$periods[$j] .= "s";
	}

	return "$difference $periods[$j] {$tense}";
}


/**
 * Parse Date Or Timestamp Object into Human Readable Date (e.g. 26th of March 2016)
 * @param string $date
 * @return  string
 */
function human_date($date)
{
	if (empty($date)) {
		return "Null date";
	}
	if (is_numeric($date)) {
		$unix_date        = $date;
	} else {
		$unix_date         = strtotime($date);
	}
	// check validity of date
	if (empty($unix_date)) {
		return "Bad date";
	}
	return date("jS F, Y", $unix_date);
}

/**
 * Parse Date Or Timestamp Object into Human Readable time (e.g. 04:30 PM)
 * @param string $date
 * @return  string
 */
function human_time($date)
{
	if (empty($date)) {
		return "Null date";
	}
	if (is_numeric($date)) {
		$unix_date        = $date;
	} else {
		$unix_date         = strtotime($date);
	}
	// check validity of date
	if (empty($unix_date)) {
		return "Bad date";
	}
	return date("h:i:s", $unix_date);
}

/**
 * Parse Date Or Timestamp Object into Human Readable Date (e.g. 26th of March, 2016 02:30)
 * @param string $date
 * @return  string
 */
function human_datetime($date)
{
	if (empty($date)) {
		return "Null date";
	}
	if (is_numeric($date)) {
		$unix_date = $date;
	} else {
		$unix_date = strtotime($date);
	}
	// check validity of date
	if (empty($unix_date)) {
		return "Bad date";
	}
	return date("jS F, Y h:i", $unix_date);
}

/**
 * Approximate to nearest decimal points
 * @param string $val
 * @param int $decimal_points
 * @return  int|float
 */
function approximate($val, $decimal_points = 2)
{
	return number_format($val, $decimal_points);
}

/**
 * Return String formatted in currency mode
 * @param string $val
 * @param string $lang
 * @return  string
 */
function to_currency($val, $lang = 'en-US')
{
	$f = new NumberFormatter($lang, \NumberFormatter::CURRENCY);
	return $f->format($val);
}

/**
 * return a numerical representation of the string in a readable format
 * @param string $val
 * @param string $lang
 * @return  string
 */
function to_number($val, $lang = 'en')
{
	$f = new NumberFormatter($lang, NumberFormatter::SPELLOUT);
	return $f->format($val);
}

/**
 * Trucate string
 * @return  string
 */
function str_truncate($string, $length = 50, $ellipse = '...')
{
	if (strlen($string) > $length) {
		$string = substr($string, 0, $length) . $ellipse;
	}
	return $string;
}

/**
 * Convert Number to words
 * @param string $val
 * @param string $lang
 * @return  string
 */
function number_to_words($val, $lang = "en")
{
	$f = new NumberFormatter($lang, NumberFormatter::SPELLOUT);
	return $f->format($val);
}

function array_change_key_name($array, $newkey, $oldkey)
{
	foreach ($array as $key => $value) {
		if (is_array($value)) {
			$array[$key] = array_change_key_name($value, $newkey, $oldkey);
		} else {
			$array[$newkey] =  $array[$oldkey];
		}
	}
	unset($array[$oldkey]);
	return $array;
}
/**
 * Generate a random string and characters from set of supplied data context
 * @param int $limit
 * @param string $context
 * @return  string
 */
function random_chars($limit = 12, $context = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*_+-=')
{
	$l = ($limit <= strlen($context) ? $limit : strlen($context));
	return substr(str_shuffle($context), 0, $l);
}

/**
 * Generate a Random String From Set Of supplied data context
 * @param int $limit
 * @param string $context
 * @return  string
 */
function random_str($limit = 12, $context = 'abcdefghijklmnopqrstuvwxyz1234567890')
{
	$l = ($limit <= strlen($context) ? $limit : strlen($context));
	return substr(str_shuffle($context), 0, $l);
}

/**
 * Generate a Random String From Set Of supplied data context
 * @param int $limit
 * @param string $context
 * @return  string
 */
function random_num($limit = 10, $context = '1234567890')
{
	$l = ($limit <= strlen($context) ? $limit : strlen($context));
	return substr(str_shuffle($context), 0, $l);
}

/**
 * Generate a Random color String 
 * @param int $alpha
 * @return  string
 */
function random_color($alpha = 1)
{
	$red = rand(0, 255);
	$green = rand(0, 255);
	$blue = rand(0, 255);
	return "rgba($red,$blue,$green,$alpha)";
}

/**
 * Generate array Random color 
 * @param int $num
 * @param float $alpha
 * @return  array
 */
function arr_random_color($num, $alpha = 1)
{
	$colors = [];
	for($i=0; $i<$num; $i++){
		$colors[] = random_color($alpha);
	}
	return $colors;
}

/**
 * return active if current GET request contains field value
 * @param string $field
 * @param string $value
 * @return  string
 */
function is_active_link($field, $value)
{
	$get =  filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
	if (!empty($get[$field]) && $get[$field] == $value) {
		return "active";
	}
	return null;
}

/**
 * Get number of files in a directory
 * @param string $dirpath
 * @return  int
 */
function get_dir_file_count($dirpath)
{
	$filecount = 0;
	$files = glob($dirpath . "*");
	if ($files) {
		$filecount = count($files);
	}
	return $filecount;
}

/**
 * Format text by removing non letters characters with space.
 * @param string $string
 * @return  string
 */
function make_readable($string = '')
{
	if (!empty($string)) {
		$string = preg_replace("/[^a-zA-Z0-9]/", ' ', $string);
		$string = trim($string);
		$string = ucwords($string);
		$string = preg_replace('/\s+/', ' ', $string);
	}
	return $string;
}
