<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('names.php');
class prefix extends names{

    function prefix()
    {
        parent::names();
    }

    function index($prefix = '', $gender = GENDER_BOY, $page = 'page', $cur_page = 1)
    {
        $this->cur_prefix = $prefix;
        $this->cur_gender = $gender;
        $this->cur_page = $cur_page;

        if (!$this->_parseInput())
            return;

        $this->names = $this->getNames($this->cur_page);
        if (empty($this->names))
        {
            $this->error_404(sprintf(lang("Couldn't find $gender names starting with %s"), $this->cur_prefix));
            return;
        }

        parent::index($page, $this->cur_page);
    }

    function getNames($cur_page = -1)
    {
        return $this->names_model->get_by_prefix($this->cur_prefix, $this->cur_gender, $cur_page);
    }
    
    function _parseInput()
    {
        global $uiyir_letters;
        $this->cur_prefix = urldecode($this->cur_prefix);
        if (empty($this->cur_prefix))
            $this->cur_prefix = from_code($uiyir_letters[0]); //default to first alphabet

        
        $this->title = sprintf(lang("{$this->cur_gender} names starting with %s"), $this->cur_prefix);
        $this->cur_folder = get_dir_url($this->cur_gender, $this->cur_prefix).'/page/'.$this->cur_page.'/';
        $this->cur_exportlink = get_dir_url($this->cur_gender, $this->cur_prefix, 'export/');
        
        return true;
    }

    function export($prefix = '', $gender = GENDER_BOY)
    {
        $this->cur_prefix = $prefix;
        $this->cur_gender = $gender;
        $this->cur_page = -1;

        if (!$this->_parseInput())
            return;

        $this->names = $this->getNames(-1);

        parent::export();
    }

    
}

?>
