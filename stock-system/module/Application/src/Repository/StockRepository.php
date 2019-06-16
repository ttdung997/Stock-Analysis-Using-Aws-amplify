<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Stock;
use Application\Entity\Stockanalysis;
use Application\Entity\Stocknews;

class StockRepository extends EntityRepository
{
	public function getlist()
	{
		$entityManager = $this->getEntityManager();

		$queryBuilder = $entityManager->createQueryBuilder();

		$queryBuilder->select('s')
					->from(Stock::class,'s');

		return $queryBuilder->getQuery();
	}
	public function SelectByID($id)
	{
		$entityManager = $this->getEntityManager();

		$queryBuilder = $entityManager->createQueryBuilder();

		$queryBuilder->select('s')
					->from(Stock::class,'s')
					->where('s.stockId = :sid')
					->setParameter(':sid', $id);

		return $queryBuilder->getQuery();
	}
	public function getNewsList()
	{
		$entityManager = $this->getEntityManager();

		$queryBuilder = $entityManager->createQueryBuilder();

		$queryBuilder->select('s')
					->from(Stocknews::class,'s');

		return $queryBuilder->getQuery();
	}
	public function SelectNewsByID($id)
	{
		$entityManager = $this->getEntityManager();

		$queryBuilder = $entityManager->createQueryBuilder();

		$queryBuilder->select('s')
					->from(Stocknews::class,'s')
					->where('s.id = :id')
					->setParameter(':id', $id);

		return $queryBuilder->getQuery();
	}
	public function getListAnalysis()
	{
		$entityManager = $this->getEntityManager();

		$queryBuilder = $entityManager->createQueryBuilder();

		$queryBuilder->select('s')
					->from(Stockanalysis::class,'s');

		return $queryBuilder->getQuery();
	}
	public function getAnalysis($id)
	{
		$entityManager = $this->getEntityManager();

		$queryBuilder = $entityManager->createQueryBuilder();

		$queryBuilder->select('s')
					->from(Stockanalysis::class,'s')
					->where('s.stockId = :sid')
					->setParameter(':sid', $id);

		return $queryBuilder->getQuery();
	}
}