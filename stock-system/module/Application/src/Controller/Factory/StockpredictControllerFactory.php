<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\StockpredictController;

 class StockpredictControllerFactory implements FactoryInterface
 {
 	public function __invoke(ContainerInterface $container, $requestedBName, array $options = null)
 	{
 		$entityManager = $container->get('doctrine.entitymanager.orm_default');

 		return new StockpredictController($entityManager);
 	}
 }