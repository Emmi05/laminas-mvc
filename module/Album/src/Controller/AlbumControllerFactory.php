<?php

declare(strict_types=1);

namespace Album\Controller;

use Album\Form\AlbumForm;
use Album\Model\AlbumTable;
use Laminas\Form\FormElementManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

final class AlbumControllerFactory implements FactoryInterface
{
    /** @inheritDoc*/
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $formManager = $container->get(FormElementManager::class);
        return new $requestedName(
            $container->get(AlbumTable::class),
            $formManager->get(AlbumForm::class)
        );
    }
}