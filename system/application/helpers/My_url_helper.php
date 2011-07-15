<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * I18n URL
 *
 * Note: Almost the same as site_url() but each segment is first checked
 * if it exists in the language files with an "url_" prefix, if not then
 * the given segment is used. A second parameter is added to change the
 * language in the url.
 *
 * @access    public
 * @param    string
 * @param    string
 * @return    string
 */
function i18n_url($uri = '', $language = '')
{
    $CI =& get_instance();
    return $CI->config->i18n_url($uri, $language);
}

// ------------------------------------------------------------------------

/**
 * Current URL
 *
 * Note: Same as original but param added to change url to specified language
 *
 * @access    public
 * @param    string
 * @return    string
 */
function current_url($language = '')
{
    $CI =& get_instance();

    if ($language == '')
    {
        return $CI->config->site_url($CI->uri->uri_string());
    }
    else
    {
        return $CI->config->i18n_url($CI->uri->uri_string(), $language);
    }
}

/* End of file MY_url_helper.php */
/* Location: ./system/application/helpers/MY_url_helper.php */ 