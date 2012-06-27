<?php
class tables_Complexities {

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