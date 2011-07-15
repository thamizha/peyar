<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!class_exists("names"))
{
include_once('basecontroller.php');
class names extends BaseController{

    function names()
    {
        parent::BaseController();
    }

    function index($page = 'page', $cur_page = 1)
    {
        $more_exists = count($this->names) > PAGE_SIZE;

        if (!in_array($this->cur_gender, array(GENDER_BOY, GENDER_GIRL)))
                $this->cur_gender = GENDER_BOY;

        $this->load->view('header', array(
            'cur_prefix'=> $this->cur_prefix,
            'cur_gender'=> $this->cur_gender,
            'title'     => $this->title,
            'cur_folder'=> $this->cur_folder
        ));

        $this->load->view('browse', array(
            'cur_prefix'=> $this->cur_prefix,
            'cur_gender'=> $this->cur_gender,
            'names'     => $this->names,
            'pagination' => $this->load->view('pagination', array(
                'cur_page'  => $cur_page,
                'cur_folder'  => $this->cur_folder,
                'cur_exportlink'  => @$this->cur_exportlink,
                'more_exists' => $more_exists
            ), true)
        ));
        $this->load->view('footer');
    }

    function _parseInput()
    {
        return true;
    }

    function export()
    {
        if (!$this->_parseInput())
            return;

        $this->names = $this->getNames(-1);

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"peyar-in.csv\"");

        $outstream = fopen("php://output", 'w');

        fputcsv($outstream, array(lang('Starting with'), lang('name'), lang('meaning')), ',', '"');

        function __outputCSV(&$vals, $key, $filehandler) {
            fputcsv($filehandler, array($vals['prefix'], $vals['name'], $vals['meaning']), ',', '"');
        }
        array_walk($this->names, '__outputCSV', $outstream);

        fclose($outstream);
    }

    
}
}
?>
