<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('names.php');
class search extends names{

    function search()
    {
        parent::names();
    }

    function names($gender = GENDER_BOY, $page = 'page', $cur_page = 1)
    {
        $this->cur_q = urldecode(@$_REQUEST['q']);
        $this->cur_gender = $gender;
        $this->cur_page = $cur_page;

        if (!$this->_parseInput())
            return;

        $this->names = $this->getNames($this->cur_page);

        if (empty($this->names))
        {
            $this->error_404(sprintf(lang("No names were found for \"%s\""), $this->cur_q));
            return;
        }
        parent::index($page, $this->cur_page);
    }

    function getNames($cur_page = -1)
    {
        return $this->names_model->search($this->cur_q, $this->cur_gender, $cur_page);
    }

    function _parseInput()
    {
        $this->cur_prefix = '';

        $this->title = sprintf(lang('Search results of '.$this->cur_gender.' names containing "%s"'), $this->cur_q);
        $this->cur_folder = site_url('search/names/'.$this->cur_gender.'/page/'.$this->cur_page.'/?q='.$this->cur_q);
        $this->cur_exportlink = site_url('search/export/'.$this->cur_gender.'/?q='.$this->cur_q);

        return true;
    }

    function export($gender = GENDER_BOY)
    {
        $this->cur_q = urldecode(@$_REQUEST['q']);
        $this->cur_gender = $gender;
        $this->cur_page = -1;

        parent::export();
    }

    
}

?>
