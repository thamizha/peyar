<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * Note: Difference with original is the added $param and language
 *
 * @access    public
 * @param    string    the language line
 * @param    string    the id of the form element
 * @param    string
 * @return    string
 */
function lang($line, $id = '', $param = '', $language = '')
{
    $CI =& get_instance();
    
    $line1 = $CI->lang->line($line, $param, '', $language);
    if (empty($line1) || ($line1 == '['.$line.']')) $line1 = $line;
    if ($id != '')
    {
        $line1 = '<label for="'.$id.'">'.$line1."</label>";
    }

    return $line1;
}

// --------------------------------------------------------------------

/**
 * I18n
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * Note: Exact same as new lang(), just added for the name
 *
 * @access    public
 * @param    string    the language line
 * @param    string    the id of the form element
 * @param    string
 * @return    string
 */
function i18n($line, $id = '', $param = '', $language = '')
{
    return lang($line, $id, $param, $language);
}

/* End of file MY_language_helper.php */
/* Location: ./system/application/helpers/MY_language_helper.php */ 