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
use User\Entity\User;
use Application\Entity\Stockanalysis;
use Application\Entity\Stocknews;
use Application\Entity\Stock;
use Application\Controller\FunctionController as FC;
class NewsController extends AbstractActionController {

    /**
     * Dga manager
     * @var Application\ORM\EntityManager
     */
    public $entityManager;

    /**
     * Dga manager
     * @var Application\Service\DgaManager
     */

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;

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
        $query = $this->entityManager->getRepository(Stockanalysis::class)->getNewsList();
        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter); 
        return new ViewModel([
            'news' => $paginator,
        ]);
    }
    public function viewAction() {
        $id =  $this->params()->fromQuery('id');
        FC::init($this);
        $user = $this->entityManager->getRepository(User::class)
        ->findOneByEmail($this->identity());
        $page = (int) $this->params()->fromQuery('page', 1);
        if ($page <= 0) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $query = $this->entityManager->getRepository(Stockanalysis::class)->SelectNewsByID($id);
        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        foreach( $paginator as $news){
            $mynews = $news;
        }
         return new ViewModel([
            'news' => $mynews
        ]);
    }
    public function statisticsAction() {
      
        //shell_exec('python tool/dgaDetectionSystem/dns_log.py 2>&1');
        return 0;
    }

}
