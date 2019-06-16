<?php
namespace Application\Service;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Application\Entity\Dga;

class DgaManager
{
	private $entityManager;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
	}

	// public function getPanigator($offset = 0, $limit = 20){

 //        $qb = $this->entityManager->createQueryBuilder();
 //        $qb->select('d')
 //        	->from(Dga::class,'d')
 //        	->orderBy('d.id','DESC')
 //        	->setMaxResults(20)
 //        	->setFirstResult($offset);
 //        $paginator = new Paginator($qb);
 //        return $paginator;
	// }

}