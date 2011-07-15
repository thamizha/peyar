<?php

if (!class_exists("BaseController"))
{
class BaseController extends Controller{

    function BaseController() 
    {
        // this is for printing the characters in tamil
        header( 'Content-Type: text/html; charset=UTF-8' );
        mb_internal_encoding( 'UTF-8' );
        ini_set('mbstring.substitute_character', "none");
        
        parent::Controller();
        $this->load->model('names_model');
        $this->load->helper(array('url', 'language_helper', 'view'));
        $this->load->library(array('language'));

        $this->lang->load('common');
        //if (error_reporting()==E_ALL)
            //$this->output->enable_profiler(TRUE); //@todo

        $this->cur_folder = get_dir_url_code();
        $this->cur_gender = GENDER_BOY;
        
    }

    function error_404($message = '404 - not found')
    {
        $message = lang($message);

        $this->output->set_status_header('404');

        $this->load->view('header', array(
            'title'     => $message,
            'cur_folder'=> $this->cur_folder,
            'cur_gender'=> $this->cur_gender
        ));

        $this->load->view('blank', array(
            'message'=> $message
        ));
        $this->load->view('footer');
    }

    

    function prefix_of($name)
    {
        global $thunai_letters_utf, $mei_letters_utf, $uiyir_letters_utf;

        $first = mb_substr($name, 0, 1);
        $second = mb_substr($name, 1, 1);

        if (in_array($first, $uiyir_letters_utf))
            return $first;

        if (in_array($second, $thunai_letters_utf))
            return $first.$second;

        return $first;
    }

    function assign_prefix()
    {
        $recs = $this->names_model->db->query('SELECT id,name FROM names WHERE prefix IS NULL')->result_array();
        foreach($recs as $key => $rec)
        {
            $prefix = $this->prefix_of($rec['name']);
            $this->names_model->db->query('UPDATE names SET prefix = ? WHERE id = ?', array($prefix, $rec['id']));
            echo ('<br/>'.$rec['name'].': '.$prefix);
        }
    }

    function get_contents($name)
    {
        return sprintf("%s %s %s", $name['name'], $name['meaning'], $name['prefix']);
    }

    function assign_contents()
    {
        ini_set('memory_limit', '128M');
        $recs = $this->names_model->db->query(' SELECT names.* FROM names
                                                LEFT OUTER JOIN name_contents ON name_id = names.id
                                                WHERE name_id IS NULL
                                                LIMIT 100000')->result_array();
        foreach($recs as $key => $rec)
        {
            $c = $this->get_contents($rec);
            $this->names_model->db->query('INSERT IGNORE INTO name_contents(name_id, contents) VALUES(?, ?)
                                            ON DUPLICATE KEY UPDATE contents = VALUES(contents)', array($rec['id'], $c));
            echo ('<br/>'.$rec['name'].': '.$c);
            //exit;
        }
    }

}
}
?>
