<?php 

class contents_model extends MY_Model
{
	public $table = "system_contents";
	
	function __construct()
    {
        parent::Model();
    }
    
    function get($id)
    {
    	$sql = 'select * from system_contents where id = ?';
    	return $this->db->GetRow($sql,$id);
    }
    
    function get_content($page)
    {
    	$sql = 'select system_contents.*,cr.name create_name, up.name update_name 
    			from system_contents 
    			left join system_users cr on system_contents.create_by = cr.id 
    			left join system_users up on system_contents.update_by = up.id 
    			where page = ?';
    	return $this->db->GetRow($sql,$page);
    }
	
	
    
}

?>