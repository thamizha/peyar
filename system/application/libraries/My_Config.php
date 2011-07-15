<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Config extends CI_Config {

    /**
     * Constructor
     *
     * @access    public
     */
    function MY_Config()
    {
        parent::CI_Config();

        log_message('debug', "MY Config Class Initialized");

        $this->load('language');
    }

    // --------------------------------------------------------------------

    /**
     * I18n URL
     *
     * Note: There is only one difference with (the original) site_url()
     * Each segment is first checked if it exists in the language files
     * with an "url_" prefix, if not then the given segment is used. A
     * second param is added to change the url language.
     *
     * @access    public
     * @param    string    the URI string
     * @param    string
     * @return    string
     */
    function i18n_url($uri = '', $language = '')
    {
        global $LANG;

        $uri = $LANG->i18n($uri, $language);

        return parent::site_url($uri);
    }
}

// END MY_Config Class

/* End of file MY_Config.php */
/* Location: ./system/application/libraries/MY_Config.php */