<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use Application\Entity\Dga;
use Application\Entity\Stock;
use Application\Controller\FunctionController as FC;

use User\Form\UserForm;
use User\Form\UserForm3;
use User\Form\PasswordChangeForm;
use User\Form\PasswordResetForm;

use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;


class IndexController extends AbstractActionController
{
       /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    public $entityManager;
    
    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager) 
    {
       $this->entityManager = $entityManager;
    }
    
    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction()
    {
        $this->layout()->setVariable('stack', 'overflow');
       
        FC::init($this);
        $query = $this->entityManager->getRepository(Stock::class)->getlist();
        
        // print_r($query);
        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(20);
        $paginator->setCurrentPageNumber($page);
        // print_r($paginator);
        return new ViewModel([
            'stocks' => $paginator,
        ]);
    }
    public function profileAction()
    {
         FC::init($this);
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($this->identity());
        
        if ($user==null) {
            throw new \Exception('Not found user with such email');
        }
        
        return new ViewModel([
            'user' => $user
        ]);
    }

    public function detectionDnsAction() {
        shell_exec('python tool/dgaDetectionSystem/dns_log.py >/dev/null 2>/dev/null &');
        echo "starting";
        exit;
    }

    public function stopDnsAction() {
        shell_exec('pkill -f tool/dgaDetectionSystem/dns_log.py >/dev/null 2>/dev/null &');
        echo "stop!";
        exit;
    }
    public function restartDnsAction() {
        shell_exec('pkill -f tool/dgaDetectionSystem/dns_log.py >/dev/null 2>/dev/null &');
        shell_exec('python tool/dgaDetectionSystem/dns_log.py >/dev/null 2>/dev/null &');
        echo "restart!";
        exit;
    }
     public function detectionDgaAction() {
        shell_exec('python tool/dgaDetectionSystem/dga_detection.py >/dev/null 2>/dev/null &');
        echo "starting";
        exit;
    }

    public function stopDgaAction() {
        shell_exec('pkill -f tool/dgaDetectionSystem/dga_detection.py >/dev/null 2>/dev/null &');
        echo "stop!";
        exit;
    }
    public function restartDgaAction() {
        shell_exec('pkill -f tool/dgaDetectionSystem/dga_detection.py >/dev/null 2>/dev/null &');
        shell_exec('python tool/dgaDetectionSystem/dga_detection.py >/dev/null 2>/dev/null &');
        echo "restart!";
        exit;
    }

     public function validatePassword($user, $password) 
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();
        
        if ($bcrypt->verify($password, $passwordHash)) {
            return true;
        }
        
        return false;
    }
    
    public function settingsAction()
    {
       
        
        FC::init($this);
        
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($this->identity());
        
        if ($user == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Create user form
        $form = new UserForm3('update', $this->entityManager, $user);
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            $request = $this->getRequest();
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $form->setData($data);
            
            if($form->isValid()) {
               $data = $form->getData();
            }
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            if($form->isValid()) {
                $data = $form->getData();
                // print_r($data);
                // Update the user.
                // $user->setEmail()
                if(strlen($data['file']['name']) >0){
                $user->setAvatar("/images/file?name=".$data['file']['name']);
                }
                 $this->entityManager->flush();
                           
            }               
        } else {
            $form->setData(array(
                    'full_name'=>$user->getFullName(),
                    'email'=>$user->getEmail(),                   
                ));
        }
        
        return new ViewModel(array(
            'user' => $user,
            'form' => $form
        ));
    }

     public function changePassword($user, $data)
    {
        $oldPassword = $data['old_password'];
        
        // Check that old password is correct
        if (!$this->validatePassword($user, $oldPassword)) {
            return false;
        }                
        
        $newPassword = $data['new_password'];
        
        // Check password length
        if (strlen($newPassword)<6 || strlen($newPassword)>64) {
            return false;
        }
        
        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);
        $user->setPassword($passwordHash);
        
        // Apply changes
        $this->entityManager->flush();

        return true;
    }

    public function changePasswordAction() 
    {
        FC::init($this);
        
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($this->identity());
        
        if ($user == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Create "change password" form
        $form = new PasswordChangeForm('change');
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Try to change password.
                if (!$this->changePassword($user, $data)) {
                    $this->flashMessenger()->addErrorMessage(
                            'Sorry, the old password is incorrect. Could not set the new password.');
                } else {
                    $this->flashMessenger()->addSuccessMessage(
                            'Changed the password successfully.');
                }
                 return $this->redirect()->toRoute('application', 
                        ['action'=>'change-password']);  
                           
            }               
        } 
        // Redirect to "view" page
                return new ViewModel(array(
                    'user' => $user,
                    'form' => $form
                ));   
    }
}
