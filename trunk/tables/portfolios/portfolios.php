<?php
class tables_Portfolios {

	function getPermissions(&$record){
		 $user =Security::getLoggedInUser();
		 
		 if ( Security::hasPermission("table_administration") ){
			return Security::getPermissions();
		 }
		 return array();
	 }

}
?>