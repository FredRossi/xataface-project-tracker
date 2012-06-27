<?php
class tables_ItemTasks {

	function item__permissions(&$record){
		 return array('edit'=>0);
		 return null;
	}
	
	function description__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function assigned_dev__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function assigned_qa__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function estimated_dev_hours__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function estimated_qa_hours__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function dev_status__permissions(&$record){
		 if (!Security::hasPermission('update_dev_status') ) return array('edit'=>0);
		 return null;
	}
	
	function qa_status__permissions(&$record){
		 if (!Security::hasPermission('update_qa_status') ) return array('edit'=>0);
		 return null;
	}
	
	function dev_hours_spent__permissions(&$record){
		 $employee = Security::getLoggedInEmployee();
		 if ($record && $record->val('assigned_dev')==$employee['id'] && Security::hasPermission('update_dev_status')) 
			return array('edit'=>1);	
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function qa_hours_spent__permissions(&$record){
		 $employee = Security::getLoggedInEmployee();
		 if ($record && $record->val('assigned_qa')==$employee['id'] && Security::hasPermission('update_qa_status')) 
			return array('edit'=>1);	
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
		
	function getPermissions(&$record){	 	
         return Security::getPermissions();
    }
	
}
?>