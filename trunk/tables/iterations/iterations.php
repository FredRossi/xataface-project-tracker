<?php
class tables_Iterations {

	function getPermissions(&$record){
		 $auth =& Dataface_AuthenticationTool::getInstance();
		 $user =& $auth->getLoggedInUser();
		 
		 if ( Security::hasPermission("iteration_administration") ){
			return Security::getPermissions();
		 }
		 return array();
	 }

}
?>