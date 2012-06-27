<?php
class tables_Employees {

	function getPermissions(&$record){
		 $auth =& Dataface_AuthenticationTool::getInstance();
		 $user =& $auth->getLoggedInUser();
		 
		 $employee_id = $user->val('employee');
		 if ($record!=null) $record_id = $record->val('id');
		 $permissions=array();
		 		 
		 if ( Security::hasPermission("account_administration") 
			  || $record_id == $employee_id ){
			$permissions = Security::getPermissions();
		 }		 
		 
		 if ($record_id == $employee_id && !Security::hasPermission("account_administration")  ){			 
			 $permissions['list']=0;
			 $permissions['find']=0;
			 $permissions['find_list']=0;
			 $permissions['find_multi_table']=0;
			 $permissions['show all']=0;
		 }
		 return $permissions;
	 }

}
?>