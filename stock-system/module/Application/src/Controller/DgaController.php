<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Application\Entity\Dga;
use User\Entity\User;
use Application\Controller\FunctionController as FC;
class DgaController extends AbstractActionController {

    /**
     * Dga manager
     * @var Application\ORM\EntityManager
     */
    public $entityManager;

    /**
     * Dga manager
     * @var Application\Service\DgaManager
     */
    private $dgaManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;

        $this->dgaManager = $dgaManager;
    }

    public function indexAction() {
        FC::init($this);
        $user = $this->entityManager->getRepository(User::class)
        ->findOneByEmail($this->identity());
        $page = (int) $this->params()->fromQuery('page', 1);
        if ($page <= 0) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        //Get dga domain
        $query = $this->entityManager->getRepository(Dga::class)->findDgaDomain();
        
        // print_r($user);
        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(20);
        $paginator->setCurrentPageNumber($page);
        return new ViewModel([
            'dgas' => $paginator,
        ]);
    }

    public function detectionAction() {
        $process = new Process('python tool/dgaDetectionSystem/dns_log.py 2>&1');
        $process . start();
        if ($process . status()) {
            echo 'The process is currently running';
        } else {
            echo 'The process is not running.';
        }
        //shell_exec('python tool/dgaDetectionSystem/dns_log.py 2>&1');
        return 0;
    }

    public function stopAction() {
        shell_exec('pkill -f tool/dgaDetectionSystem/dns_log.py 2>&1');
        return 0;
    }

    public function updateStatusAction() {
        $status = 1;
        if(intval($_POST['status']) == 1) $status = 0;
        $query = $this->entityManager->getRepository(Dga::class)
                ->UpdateStatusDga($_POST['id'],$status );

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        echo "UPDATE dga";
        exit;
    }
    public function deleteDgaAction() {
        $id = (int) $this->params()->fromQuery('id');
        $query = $this->entityManager->getRepository(Dga::class)->DeleteDgaByID($id);

        echo $id;
        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        exit;
    }

}
