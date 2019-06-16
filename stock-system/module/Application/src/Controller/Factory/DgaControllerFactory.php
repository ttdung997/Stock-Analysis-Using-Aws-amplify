<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\DgaManager;
use Application\Controller\DgaController;

 class DgaControllerFactory implements FactoryInterface
 {
 	public function __invoke(ContainerInterface $container, $requestedBName, array $options = null)
 	{
 		$entityManager = $container->get('doctrine.entitymanager.orm_default');
 		$dgaManager = $container->get(DgaManager::class);

 		return new DgaController($entityManager, $dgaManager);
 	}
 }