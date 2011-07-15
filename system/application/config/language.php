<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// instead "dutch" you can also use "nl_NL" ("english" > "en_UK") etc.
// don't forget to change the folder names in languages also
// if you want to use this also as http://domain.com/nl_NL/...
// don't forget to change the router (\w{2}) to (\w{2}_\w{2})
// of course if you change, make your change in this config file also

// default language

#$config['language'] = 'dutch';

$domains = array(
    'peyar.in' => 'tamil'
);

$host = implode('.', array_slice(explode('.', $_SERVER['HTTP_HOST']), -2));

if (key_exists($host, $domains))
{
    $config['language'] = $domains[$host];
}
else
{
    $config['language'] = 'tamil';
}

// available languages (key: language code, value: language name)

$config['languages'] = array('ta' => 'tamil', 'en' => 'english');

// available countries (key: country code, value: language code)

$config['country_languages'] = array('in' => 'ta');

// debug if line is not found as [line]

$config['language_debug'] = TRUE;

/* End of file language.php */
/* Location: ./system/application/config/language.php */ 