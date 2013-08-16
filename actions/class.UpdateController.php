<?php
/**
 * Subjects Controller provide actions performed from url resolution
 * 
 * @author Bertrand Chevrier, <taosupport@tudor.lu>
 * @package taoMigration
 * @subpackage actions
 * @license GPLv2  http://www.opensource.org/licenses/gpl-2.0.php
 * 
 */

class taoUpdate24_actions_UpdateController extends tao_actions_CommonModule {
    
    private  $allowedRole ='http://www.tao.lu/Ontologies/TAO.rdf#SysAdminRole';
    private $userService;
    private $notificationService;
    
    /**
     * initialize the services
     */
    public function __construct(){
        parent::__construct();
        $this->userService = tao_models_classes_UserService::singleton();
        $this->notificationService = taoUpdate24_models_classes_NotificationService::singleton();
        $this->notificationService->setReleaseManifestUrl( BASE_URL . '/test/sample/releases.xml');
    }

	/**
	 * the say  action 
	 * @return 
	 */
	public function maintenance(){

        $this->setView('maintenance.tpl');
	}
	

	
	public function index(){
	   
	   
	   $currentUser = $this->userService->getCurrentUser(); 
	   $roles = $this->userService->getUserRoles($currentUser);
	   var_dump(array_key_exists($this->allowedRole, $roles));
	   
	   $availabeUpdate = $this->notificationService->getAvailableUpdates();
	   var_dump($availabeUpdate);
	   $this->setData('availabeUpdate', $availabeUpdate);
	   $this->setView('index.tpl');
	}
	

}
?>