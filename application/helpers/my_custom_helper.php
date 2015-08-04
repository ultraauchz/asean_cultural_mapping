<?php
function ordering_data($mode=FALSE,$table_name,$id,$ext_condition,$step=1){
		$CI =& get_instance();
		//$CI->db->debug = true;		
		switch($mode){
			case 'top':
					$update['id']= $id;
					$update['show_no'] = $CI->db->getone("SELECT (max(show_no)+1) from ".$table_name);
					$CI->db->execute("UPDATE ".$table_name." SET show_no=".$update['show_no']." WHERE id=".$update['id']);					
				break;
			case 'bottom':
					$CI->db->execute("UPDATE ".$table_name." SET show_no=show_no+1 where id <> ".$id);
					$CI->db->execute("UPDATE ".$table_name." SET show_no=1 where id=".$id);
				break;
			case 'up':				
				for($i=1;$i<=$step;$i++):
					$current_data = $CI->db->query("SELECT * FROM ".$table_name." where id=".$id)->result();
					$current_data = @$current_data[0];					
					$sql= " SELECT * FROM ".$table_name." WHERE 1=1 ".$ext_condition." AND show_no > ".$current_data->show_no." ORDER BY show_no LIMIT 0,1 ";
					$up_data = $CI->db->query($sql)->result();
					$up_data = @$up_data[0];
					if(@$up_data->id>0){
					$data['id'] = $up_data->id;
					$data['show_no'] = $current_data->show_no;
					$CI->db->query("UPDATE ".$table_name." SET show_no=".$data['show_no']." where id=".$data['id']);					
					
					$data['id'] = $current_data->id;
					$data['show_no'] = $up_data->show_no;
					$CI->db->query("UPDATE ".$table_name." SET show_no=".$data['show_no']." where id=".$data['id']);
					}
				endfor;
				break;
			case 'down':
				for($i=1;$i<=$step;$i++):
				$current_data = $CI->db->query("SELECT * FROM ".$table_name." where id=".$id)->result();
				$current_data = @$current_data[0];	
				$sql= " SELECT * FROM ".$table_name." WHERE 1=1 ".$ext_condition." AND show_no < ".$current_data->show_no." ORDER BY show_no DESC LIMIT 0,1 ";
				$up_data = $CI->db->query($sql)->result();
				$up_data = @$up_data[0];
					if(@$up_data->id > 0){
					$data['id'] = $up_data->id;
					$data['show_no'] = $current_data->show_no;					
					$CI->db->query("UPDATE ".$table_name." SET show_no=".$data['show_no']." where id=".$data['id']);
					
					$data['id'] = $current_data->id;
					$data['show_no'] = $up_data->show_no;
					$CI->db->query("UPDATE ".$table_name." SET show_no=".$data['show_no']." where id=".$data['id']);
					}
				endfor;
				break;
		}
}