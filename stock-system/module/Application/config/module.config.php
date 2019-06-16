<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c] 2005-2016 Zend Technologies USA Inc. (http://www.zend.com]
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\View\Helper\Navigation;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/[:action[/:page]]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller'    => Controller\IndexController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'images' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/images[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller'    => Controller\ImageController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'dga' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/dga[/:action[/:page]]',
                    'contraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\DgaController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'news' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/news[/:action[/:page]]',
                    'contraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\NewsController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'stock' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/stock[/:action[/:page]]',
                    'contraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\StockController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'stockpredict' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/stockpredict[/:action[/:page]]',
                    'contraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\StockpredictController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\DgaController::class => Controller\Factory\DgaControllerFactory::class,
            Controller\ImageController::class => Controller\Factory\ImageControllerFactory::class,
            Controller\NewsController::class => Controller\Factory\NewsControllerFactory::class,
            Controller\StockController::class => Controller\Factory\StockControllerFactory::class,
            Controller\StockpredictController::class => Controller\Factory\StockpredictControllerFactory::class,

        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\DgaManager::class => Service\Factory\DgaManagerFactory::class,
           Service\NavManager::class => Service\Factory\NavManagerFactory::class,
            Service\ImageManager::class => InvokableFactory::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\Menu::class => View\Helper\Factory\MenuFactory::class,
            View\Helper\Breadcrumbs::class => InvokableFactory::class,
        ],
        'aliases' => [
            'mainMenu' => View\Helper\Menu::class,
            'pageBreadcrumbs' => View\Helper\Breadcrumbs::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
     'navigation' => [
        'default' => [
            [
                'label' => 'Home',
                'route' => 'home'
            ],
            [
                'label' => 'DGA',
                'route' => 'dga'
            ],
             [
                'label' => 'news',
                'route' => 'news'
            ]
        ]
    ]
];
   
