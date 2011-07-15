<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('basecontroller.php');
class name extends BaseController{

    function name()
    {
        parent::BaseController();
    }

    function index($id){
        
        $name = $this->names_model->get_by_id($id);
        if (!$name)
        {
            $this->error_404(sprintf(lang("Couldn't find any such name")));
            return;
        }
        $cur_prefix = $this->prefix_of($name['name']);
        $this->load->view('header', array(
            'cur_prefix'=> $cur_prefix,
            'cur_gender'=> $name['gender'],
            'title'     => $name['name'],
            'cur_folder'=> get_dir_url($gender, $cur_prefix),
        ));
        $this->load->view('name', array(
            'cur_prefix'=> $this->prefix_of($name['name']),
            'cur_gender'=> $name['gender'],
            'name'      => $name
        ));
        $this->load->view('footer');
    }

    
}

?>
