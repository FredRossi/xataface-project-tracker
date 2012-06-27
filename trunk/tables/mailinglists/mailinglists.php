<?php
class tables_MailingLists {
	function getPermissions(&$record){		 
		 $user =Security::getLoggedInUser();
		 $permissions=array();
		 if ( Security::hasPermission("account_administration") ){
			$permissions = Security::getPermissions();
		 }
		 return $permissions;
	 }
}
?>