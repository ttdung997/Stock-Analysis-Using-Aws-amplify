<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use Application\Entity\Dga;
use Application\Controller\FunctionController as FC;
class FunctionController extends AbstractActionController
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
    public static function init($key){
        $user = $key->entityManager->getRepository(User::class)
                ->findOneByEmail($key->identity());
        $key->layout()->setVariable('username',$user->getFullName() );
        $key->layout()->setVariable('email', $user->getEmail());
        $key->layout()->setVariable('avatar', $user->getAvatar());
        $key->layout()->setVariable('role', $user->getRole());
    }
}
