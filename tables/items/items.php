<?php
class tables_Items {

	function landesk_number__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function portfolio__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function client_name__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function system_name__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function iteration__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function csr__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function sme__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function complexity__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function priority__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function item_status__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function acc_status__permissions(&$record){
		 if (!Security::hasPermission('update_acc_status') ) return array('edit'=>0);
		 return null;
	}
	
	function target_date__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function created_date__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function landesk_created_date__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function completion_date__permissions(&$record){
		 if (!Security::hasPermission('item_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function getPermissions(&$record){		
		 $permissions = Security::getPermissions();
		 if ( $record 
			&& $record->val('item_status')==7 
			&&  !Security::hasPermission('item_administration'))  
			$permissions['edit']=0;
         return $permissions;
    }
	
}
?>