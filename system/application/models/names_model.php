<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Class names_model extends Model
{

    function names_model()
    {
        parent::Model();
        $this->load->database();
    }
    
    function get_by_id($id)
    {
        $query = $this->db->get_where('names', array('id' => $id));
        $recs = $query->result_array();
        if (empty($recs))
            return false;
        return $recs[0];
    }

    function get_by_prefix($prefix, $gender, $page = 1)
    {
        $this->db->from('names')
                ->where(array('gender' => $gender, 'prefix' => $prefix))
                ->order_by('name');

        if ($page >= 1)
            $this->db->limit(PAGE_SIZE+1, ($page-1) * PAGE_SIZE);

        return $this->db->get()->result_array();
    }

    function search($q, $gender, $page = 1)
    {
        $match = $this->get_search_condn('name_contents.contents', $q);

        $this->db->select('names.*')
                ->from('names')
                ->join('name_contents', 'names.id = name_contents.name_id')
                ->where(array('gender' => $gender))
                ->where($match, NULL, FALSE);
                //->order_by($match, 'desc')
        if ($page >= 1)
            $this->db->limit(PAGE_SIZE+1, ($page-1) * PAGE_SIZE);

        return $this->db->get()->result_array();
    }

    function get_search_condn($field, $search)
    {
        $terms = array_filter(explode(' ', trim($search)));
        $regexp = false;
	foreach($terms as $key => $term)
	{
	    if (mb_strlen($term)<4)
		$regexp = true;
	}

	if ($regexp)
	{
	    //Mysql doesn't support FULLTEXT index searching less than 4 characters
	    return "{$field} REGEXP '(".$this->db->escape_str(implode(' ', $terms)).")'";
	}
	else
	{
	    foreach($terms as $key => $term)
	    {
		$terms[$key] = '*'.$term.'*';
	    }
	}
        $term = $this->db->escape(implode(' ', $terms));

        return "MATCH({$field}) AGAINST ($term IN BOOLEAN MODE) > 0";
    }


}

?>
