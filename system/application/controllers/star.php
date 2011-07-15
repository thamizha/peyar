<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('names.php');
class star extends names{

    function star()
    {
        parent::names();
    }

    function index($cur_gender = 'boy')
    {
        if (!in_array($cur_gender, array(GENDER_BOY, GENDER_GIRL)))
                $cur_gender = GENDER_BOY;
        
        $this->load->view('header', array(
            'title'     => lang('Choose by star'),
            'cur_folder'=> '/star/'.$cur_gender,
            'cur_gender'=> 'boy',
            'custom_sidebar' => lang('Choose the starting letters for the star')
        ));

        $this->load->view('star', array());
        $this->load->view('footer');
    }

}

?>
