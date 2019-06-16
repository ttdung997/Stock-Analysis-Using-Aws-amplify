<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\NewsController;
use Application\Service\DgaManager;

 class NewsControllerFactory implements FactoryInterface
 {
 	public function __invoke(ContainerInterface $container, $requestedBName, array $options = null)
 	{
 		$entityManager = $container->get('doctrine.entitymanager.orm_default');

 		$dgaManager = $container->get(DgaManager::class);

 		return new NewsController($entityManager, $dgaManager);
 	}
 }