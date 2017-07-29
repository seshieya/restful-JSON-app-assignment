<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\PicturesController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'pictures' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/get/pictures[/]',
                    'defaults' => [
                        'controller' => Controller\PicturesController::class,
                        'action'     => 'pictures',
                    ],
                ],
            ],
            'comments' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/get/comments[/]',
                    'defaults' => [
                        'controller' => Controller\CommentsController::class,
                        'action'     => 'comments',
                    ],
                ],
            ],
            'search' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/search[/]',
                    'defaults' => [
                        'controller' => Controller\PicturesController::class,
                        'action'     => 'search',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\PicturesController::class => InvokableFactory::class,
            Controller\CommentsController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/pictures',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/pictures/pictures' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/pictures'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
