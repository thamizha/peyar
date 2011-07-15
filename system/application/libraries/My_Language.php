<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Language extends CI_Language {

    /**
     * Constructor
     *
     * @access    public
     */
    function MY_Language()
    {
        parent::CI_Language();

        log_message('debug', "MY Language Class Initialized");

        global $CFG;
        global $RTR;

        $languages = $CFG->item('languages');

        $language_url = '';
        $language_default = array_search($CFG->item('language'), $languages);
        $language_current = $language_default;

        // check if language code exists
        // if yes and scaffolding remove
        // if yes and is default remove
        // if yes change language
        if (isset($RTR->uri->segments[1]))
        {
            $segment1 = $RTR->uri->segments[1];

            // first segment in languages
            if (isset($languages[$segment1]))
            {
                $language_url = $segment1;

                if ($RTR->scaffolding_request === TRUE)
                {
                    $RTR->uri->segments = $RTR->uri->rsegments;
                }
                // if url language is default remove first segment
                else if ($language_url == $language_default)
                {
                    $uri = $RTR->uri->segments;

                    array_shift($uri);

                    $uri = implode('/', $uri);

                    header("Location: /" . $uri, TRUE, 302);
                    exit;
                }

                $CFG->set_item('language', $languages[$language_url]);

                $language_current = $language_url;
            }
        }

        $CFG->set_item('language_url', $language_url);
        $CFG->set_item('language_default', $language_default);
        $CFG->set_item('language_current', $language_current);
    }

    // --------------------------------------------------------------------

    /**
     * Load a language file
     *
     * Note: Same as original but if a language file needs to be loaded and
     * returned and the files is already loaded nothing gets returned. This
     * is fixed with remove from loaded lsit first. This way you can load
     * (other) language files while one stays active.
     * If you use HMVC and want this also in the modules the Controller.php
     * from around line 162 needs to be edited. See HMVC differences:
     *
     * language($langfile, $lang = '')
     * language($langfile, $lang = '', $return = FALSE)
     *
     * if (in_array($langfile.'_lang'...
     * if ($return == FALSE && in_array($langfile.'_lang'...
     *
     * parent::language($langfile, $lang);
     * parent::language($langfile, $lang, $return);
     *
     * CI::$APP->lang->language...
     * if ($return == TRUE) return $lang; CI::$APP->lang->language...
     *
     * @access    public
     * @param    mixed    the name of the language file to be loaded. Can be an array
     * @param    string    the language (english, etc.)
     * @return    mixed
     */
    function load($langfile = '', $idiom = '', $return = FALSE)
    {
        if ($return == TRUE)
        {
            $langfile_name = str_replace(EXT, '', str_replace('_lang.', '', $langfile)).'_lang'.EXT;

            if ($key = array_search($langfile_name, $this->is_loaded, TRUE))
            {
                unset($this->is_loaded[$key]);
            }
        }

        return parent::load($langfile, $idiom, $return);
    }


    // --------------------------------------------------------------------

    /**
     * Fetch a single line of text from the language array
     *
     * Note: CI returns nothing if line for given language is not found.
     * This function does exactly the same as the original one but two
     * params are added. First param to add sub-segments to the line.
     * Second to override the debug_language set in config. With debug
     * TRUE the line returns [line] instead of nothing when no match in
     * the language files is found. Debug is FALSE for i18n_url().
     *
     * @access    public
     * @param    string    $line     the language line
     * @param    string
     * @param    string
     * @param    bool    override config debug setting
     * @return    string
     */
    function line($line = '', $param = '', $debug = NULL)
    {
        if ($line == '') return FALSE;

        global $CFG;

        $language_debug = ($CFG->item('language_debug') == NULL) ? FALSE : $CFG->item('language_debug');

        if (isset($this->language[$line]))
        {
            $line = $this->language[$line];

            if ($param != '')
            {
                if (is_array($param))
                {
                    $line = vsprintf($line, $param);
                }
                else
                {
                    $line = sprintf($line, $param);
                }
            }
        }
        else if (($language_debug == TRUE && $debug !== FALSE) || $debug == TRUE)
        {
            log_message('error', 'Language: unknown line [' . $line . '] in ' . $_SERVER['REQUEST_URI']);

            $line = "[" . $line . "]";
        }
        else
        {
            return FALSE;
        }

        return $line;
    }

    // --------------------------------------------------------------------

    /**
     * I18n, change, add or remove language code in front of the url
     * depanding on the second param "language" and the current language
     * Also change the uri segments to the right language if exists
     *
     * @access    public
     * @param    string    the URI string
     * @return    string
     */
    function i18n($uri = '', $language = '')
    {
        if ($uri == '') return FALSE;

        if ( ! is_array($uri))
        {
            $uri = explode('/', trim($uri, '/'));
        }

        global $CFG;

        $languages = $CFG->item('languages');

        $language_url = $CFG->item('language_url');
        $language_default = $CFG->item('language_default');
        $language_current = $CFG->item('language_current');

        if ($language != '')
        {
            // language not in languages (as key)
            if ( ! isset($languages[$language]))
            {
                // language in languages (as value)
                if ($key = array_search($language, $languages))
                {
                    $language = $key;
                }
                // language not in languages (at all)
                else
                {
                    $language = '';
                }
            }
        }

        if (isset($uri[0]))
        {
            // first segment in languages
            if (isset($languages[$uri[0]]))
            {
                if ($language == '')
                {
                    $language = $uri[0];
                }

                array_shift($uri);
            }
        }

        // only if language is set and is not same as current
        if ($language != '' && $language != $language_current)
        {
            $language_new = $this->load('urls', $languages[$language], TRUE);

            foreach ($uri as $key => $segment)
            {
                // get line form current language
                if ($line = array_search($segment, $this->language))
                {
                    $segment = substr($line, 4);
                }

                // get value form new line language
                if (isset($language_new['url_' . $segment]))
                {
                    $uri[$key] = $language_new['url_' . $segment];
                }
            }
        }
        else
        {
            foreach ($uri as $key => $segment)
            {
                $line = $this->line('url_' . $segment, '', FALSE);

                $uri[$key] = ($line == NULL) ? $segment : $line;
            }
        }

        if ($language != '' && $language != $language_default)
        {
            array_unshift($uri, $language);
        }
        else if ($language == '' && $language_current != $language_default)
        {
            array_unshift($uri, $language_current);
        }

        return implode('/', $uri);
    }
}

// END MY_Language class

/* End of file MY_Language.php */
/* Location: ./system/application/libraries/MY_Language.php */