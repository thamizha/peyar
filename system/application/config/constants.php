<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('PAGE_SIZE', 100);

define('GENDER_BOY', 'boy');
define('GENDER_GIRL', 'girl');

//Only those which can be starting letters are included in this array
global $thunai_letters, $mei_letters, $uiyir_letters;
global $thunai_letters_utf, $mei_letters_utf, $uiyir_letters_utf;
$uiyir_letters = array(2949,2950,2951,2952,2953,2954,2958,2959,2960,2962,2963,2964);
$mei_letters =  array(2965,2970,2980,2984,2986,2990,2991,2992,2994,2997);
$thunai_letters = array(3006,3007,3008,3009,3010,3014,3015,3016,3018,3019,3020);

function from_code($u, $t=null)
{
    if (is_null($t))
        return html_entity_decode("&#" . $u . ";", ENT_NOQUOTES, 'UTF-8');

    return html_entity_decode("&#" . $u . ";"."&#" . $t . ";", ENT_NOQUOTES, 'UTF-8');

}

$uiyir_letters_utf = array();
foreach ($uiyir_letters as $l)
    $uiyir_letters_utf[$l] = from_code($l);

$thunai_letters_utf = array();
foreach ($thunai_letters as $l)
    $thunai_letters_utf[$l] = from_code($l);

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */