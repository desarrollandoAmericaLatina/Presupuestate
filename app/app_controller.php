<?php
class AppController extends Controller {
    var $helpers = array(
        'Html',
        'Javascript',
        'Session',
        'Form',
        'Asset' => array(
            'md5FileName'   => true,
            'checkTs'       => true,
            'cssCompression'=> 'default',
            'debug'         => true
        )
    );
   
    var $components = array(
        'Auth'=>array(                        
            'userScope'			=> array('User.active' => '1'),
            'loginAction' 		=> array('controller' => 'users', 'action' => 'login'),
            'logoutRedirect' 	=> array('controller' => 'users', 'action' => 'login'),
            'autoRedirect'		=> false,
			'fields'			=> array('username' => 'email', 'password' => 'password')
        ),
        'Session',
        'RequestHandler'
    );
	
	var $permissions = array();
	
    function beforeFilter(){
		//FORCING LANGUAGE TO SPA
		Configure::write('Config.language', 'spa');
		
		$this->customAuth();
		
		if($this->Auth->user()){
			//SET USER PERMISSIONS
			$user = $this->Auth->user();
			$this->User = ClassRegistry::init('User');
			$this->permissions = $this->User->getPermissions($user);
			$this->set('facilities_permissions', $this->permissions);

			if (sizeof($this->uses) && $this->{$this->modelClass}->Behaviors->attached('Logable')) {
				$this->{$this->modelClass}->setUserData($user);
			}
        }
    }
	
	function beforeRender() {
		if ($this->RequestHandler->isAjax()) {
			Configure::write('debug', 0);
			$this->header('Pragma: no-cache');
			$this->header('Cache-control: no-cache');
			$this->header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			$this->layout = 'ajax';
		}
		
		if($this->Auth->user()){
			$user = $this->Auth->user();
            $this->set('loggedUser',$this->Session->read('Auth'));
        }
	}	
	
	function customAuth(){
		$this->Auth->loginError = __("User or password not valid",true);
		$this->Auth->authError 	= __("You do not have permission to view this page",true);
	}
	
	function checkPermissions($role_slug = array(), $company_slug = '', $facility_slug = '') {
		$role 		= $this->Session->read('Auth.Role');
		$company 	= $this->Session->read('Auth.Company');
		
		if (in_array($role,$role_slug)) {
			if (!empty($company_slug)) {
				if ($company_slug != $company['slug']) {
					$this->Session->setFlash(__("You do not have permission to view this page",true), 'alert-message-error');
					$this->redirect('/');
				}
				else if ($company_slug == $company['slug']) {
					if (!empty($facility_slug)) {
						$facilities_slug = Set::extract('Facility.{n}.slug',$this->permissions);
						if (!in_array($facility_slug, $facilities_slug)) {
							$this->Session->setFlash(__("You do not have permission to view this page",true), 'alert-message-error');
							$this->redirect('/');
						}					
					}
				}
			}
		}
		else {
			$this->Session->setFlash(__("You do not have permission to view this page",true), 'alert-message-error');
			$this->redirect('/');
		}
	}
}