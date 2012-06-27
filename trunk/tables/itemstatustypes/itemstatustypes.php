<?php
class tables_ItemStatusTypes {

	function getPermissions(&$record){
		 $auth =& Dataface_AuthenticationTool::getInstance();
		 $user =& $auth->getLoggedInUser();
		 
		 if ( Security::hasPermission("table_administration") ){
			return Security::getPermissions();
		 }
		 return array();
	 }

}
?>