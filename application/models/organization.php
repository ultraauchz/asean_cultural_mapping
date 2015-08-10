<?php
class Organization extends ORM {

	var $table = "acm_organization";
	
	var $has_one = array('country');
	
	var $has_many = array(
			'network_org' => array(			// in the code, we will refer to this relation by using the object name 'book'
            'class' => 'network_org',			// This relationship is with the model class 'book'
            'other_field' => 'org',		// in the Book model, this defines the array key used to identify this relationship
            'join_self_as' => 'org',		// foreign key in the (relationship)table identifying this models table. The column name would be 'author_id'
            'join_other_as' => 'id',		// foreign key in the (relationship)table identifying the other models table as defined by 'class'. The column name would be 'book_id'
            'join_table' => 'acm_network_org')	,
            'user' => array(			// in the code, we will refer to this relation by using the object name 'book'
            'class' => 'user',			// This relationship is with the model class 'book'
            'other_field' => 'org',		// in the Book model, this defines the array key used to identify this relationship
            'join_self_as' => 'org',		// foreign key in the (relationship)table identifying this models table. The column name would be 'author_id'
            'join_other_as' => 'id',		// foreign key in the (relationship)table identifying the other models table as defined by 'class'. The column name would be 'book_id'
            'join_table' => 'acm_user')	 ,
            'heritage_organization' => array(			// in the code, we will refer to this relation by using the object name 'book'
            'class' => 'heritage_organization',			// This relationship is with the model class 'book'
            'other_field' => 'org',		// in the Book model, this defines the array key used to identify this relationship
            'join_self_as' => 'org',		// foreign key in the (relationship)table identifying this models table. The column name would be 'author_id'
            'join_other_as' => 'id',		// foreign key in the (relationship)table identifying the other models table as defined by 'class'. The column name would be 'book_id'
            'join_table' => 'acm_heritage_organization')	                  
	);
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}