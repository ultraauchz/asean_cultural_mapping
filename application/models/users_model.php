<?php 

class users_model extends MY_Model
{
	public $table = 'system_users';
	public $select = 'system_users.*';
	function __construct()
    {
        parent::Model();
    }
        
	
}

?>