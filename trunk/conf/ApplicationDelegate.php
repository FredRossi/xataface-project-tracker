<?
class conf_ApplicationDelegate {

	 function getNavItem($key, $label){
		$user = Security::getLoggedInUser();
		if ( isset($user) ){
			switch ($key){
				case 'items':
				case 'employees':
					throw new Exception("Use default rendering");
			}
		}
			
		if (!Security::isUserRole('Administrator') ){					
			//pm items
			if (Security::isUserRole('Portfolio Manager')){
				switch ($key){
					case 'itemtasks':
					case 'principals':
					case 'iterations':
						throw new Exception("Use default rendering");
				}
			}			
			// Non-admin users can't see any other table.
			return null;
	 
		} else{
			//Admin users can see everything..
			throw new Exception("Use default rendering");
		}
	}
	
	function beforeHandleRequest(){
        $app = Dataface_Application::getInstance();
        $query =& $app->getQuery();
		
        if ( !Security::hasPermission("account_administration") and 
				$query['-table'] == 'employees' and
				$app->_conf['using_default_action'] 
		){
            $query['-action'] = 'view';
            $query['-cursor'] = 0;
        }		
    }
}

class Security{

	static $roles = null;
	static $employee = null;
	
	function getRoles(){
		 if ( Security::$roles == null ){
			 $roles = array();
			 $res = mysql_query("select id, name from roles", df_db());
			 while($row = mysql_fetch_assoc($res)) Security::$roles[$row['id']]=$row['name'];			 
		}
		return Security::$roles;
	 }
	 
	function hasPermission($permission){		
		$permissions = Security::getPermissions();
		return $permissions[$permission];
	}
		
	function isUserRole($roleCheck){
		$user = Security::getLoggedInUser();
		$roles=Security::getRoles(); 
		return ( $user and $roles[$user->val('role')] == $roleCheck );		
	}
	
	function getPermissions(){        
         $user = Security::getLoggedInUser();
	     if ( !isset($user) ) return Dataface_PermissionsTool::NO_ACCESS();	     
		 $roles = Security::getRoles();
         return Dataface_PermissionsTool::getRolePermissions($roles[$user->val('role')]);
    }
	
	function getLoggedInUser(){		
		$auth =& Dataface_AuthenticationTool::getInstance();
		$user =& $auth->getLoggedInUser();		
		return $user;
	}
	
	function getLoggedInEmployee(){		
		 $user = Security::getLoggedInUser();
		 if ( Security::$employee == null  || $user->val('employee')==Security::$employee['id'] ){
			 $res = mysql_query("select id, firstname, lastname, email, department from employees where id=".$user->val('employee'), df_db());
			 
			 while($row = mysql_fetch_assoc($res)) 
				Security::$employee = array(
					'id'=>$row['id'],
					'firstname'=>$row['firstname'],
					'lastname'=>$row['lastname'],
					'department'=>$row['department']
				);
			 ;	
				 
		 }
		return Security::$employee;
	}
	
}

?>