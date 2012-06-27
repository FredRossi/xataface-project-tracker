<?php
class tables_Principals {

	 function init(&$table){
		 $auth =& Dataface_AuthenticationTool::getInstance();
		 $user =& $auth->getLoggedInUser();
         $table->setSecurityFilter(array('Id'=>5));
    }

	function Role__permissions(&$record){
		 if (!Security::hasPermission('account_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function Employee__permissions(&$record){
		 if (!Security::hasPermission('account_administration') ) return array('edit'=>0);
		 return null;
	}
	
	function getPermissions(&$record){
		 $auth =& Dataface_AuthenticationTool::getInstance();
		 $user =& $auth->getLoggedInUser();
		 
		 $employee_id = $user->val('id');
		 if ($record!=null) $record_id = $record->val('id');
		 if ( Security::hasPermission("account_administration") 
			  || $record_id == $employee_id
		 ){
			return Security::getPermissions();
		 }
		 return array();
	 }
	
}
?>