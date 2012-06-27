<?php
class tables_priorities {

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