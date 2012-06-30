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
	
	static public $reportMenu = array(
		  array(
			'href'=>'index.php?-action=list&-table=items&-edit=1&itemtasks/dev_status=17',
			'label'=>'Development Complete Items'
		),array(
			'href'=>'index.php?-action=list&-table=items&-edit=1&itemtasks/qa_status=24',
			'label'=>'QA Complete Items'
		),array(
			'href'=>'index.php?-action=list&-table=items&-edit=1&itemtasks/assigned_dev==',
			'label'=>'Unassigned Dev Items'
		),array(
			'href'=>'index.php?-action=list&-table=items&-edit=1&item_status=2',
			'label'=>'Items in Progress'
		),array(
			'href'=>'index.php?-action=list&-table=items&-edit=1&item_status=7',
			'label'=>'Completed Items'
		),array(
			'href'=>'index.php?-action=list&-table=EfficiencyByDeveloperAndIteration',
			'label'=>'Efficiency By Developer And Iteration'
		),array(
			'href'=>'index.php?-action=list&-table=gmcmigrationjobstatus',
			'label'=>'GMC Migration Job Status'
		),array(
			'href'=>'index.php?-action=list&-table=PortfolioJobAllocation',
			'label'=>'Portfolio-Job Allocation'
		),array(
			'href'=>'index.php?-action=list&-table=CompletedItemsCountByClient',
			'label'=>'Client Composition of Jobs Completed'
		)
	);
	
	function block__after_nav_menu()
    {
		if (Security::isUserRole('Portfolio Manager') || Security::isUserRole('Administrator')){
			conf_ApplicationDelegate::printPortlet('reports', conf_ApplicationDelegate::$reportMenu);
		}		
    }
	
	function printPortlet($portletName, $portletItems){		 
		 printf('<div class="portlet"><div><h5>'.$portletName.'</h5><div class="portletBody">');		 
		 foreach ($portletItems as $item){
			 printf( "<div class='portletContent'><a href='"
						.$item['href']
						."' class='navItem'><img src='"
						.$ENV.DATAFACE_URL
						."/images/document_icon.gif' class='navIconRoot'/>"
						.'<span class="navItemText">'
						.$item['label']
						."</span></a></div>" );
		 }
         printf('</div>');
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