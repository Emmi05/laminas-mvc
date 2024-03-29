<?php

declare(strict_types=1);

namespace Album;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
                'album' => [
                'type'    => Segment::class,
                'options' => [ //si quiero agregar la ruta con album aqui le agrego /album
                    'route' => '[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
                'home' => [
                'type'    => Literal::class,
                'options' => [ //si quiero agregar la ruta con album aqui le agrego /album
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories'   => [
            Model\AlbumTable::class => Model\AlbumTableFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AlbumController::class => Controller\AlbumControllerFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            Form\AlbumForm::class => Form\AlbumFormFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];
