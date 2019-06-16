<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Dga;

class DgaRepository extends EntityRepository
{
	public function findDgaDomain()
	{
		$entityManager = $this->getEntityManager();

		$queryBuilder = $entityManager->createQueryBuilder();

		$queryBuilder->select('d')
					->from(Dga::class,'d')
					->orderBy('d.id','DESC');

		return $queryBuilder->getQuery();
	}
        public function UpdateStatusDga($id,$status){
            echo $id;
            echo $status;
            $entityManager = $this->getEntityManager();

		$queryBuilder = $entityManager->createQueryBuilder();

		$queryBuilder->update(Dga::class, 'd')
                ->set('d.status ', ':dstatus')
                ->where('d.id = :did')
                ->setParameter(':did', $id)
                ->setParameter(':dstatus', $status);

		return $queryBuilder->getQuery()->execute();
        }
         public function DeleteDgaByID($id) {
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->delete(Dga::class, 'd')
                 ->where('d.id = :did')
                ->setParameter(':did', $id);

        return $queryBuilder->getQuery()->execute();
    }
}