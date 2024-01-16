<?php

declare(strict_types=1);

namespace Album\Form;

use Album\Model\AlbumTable;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

//mi clase se llama igual que mi archivo
final class AlbumFormFactory implements FactoryInterface
{
    /** @inheritDoc*/
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return $requestedName($container->get(AlbumTable::class);
    }
}