<?php

declare(strict_types=1);

namespace Album\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Resultset\Resultset;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

final class AlbumTableFactory implements FactoryInterface
{
    /** @inheritDoc*/
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new $requestedName(
                  new TableGateway(
                      'album',
        $container->get(AdapterInterface::class),
        null,
        new ResultSet(new Album()),
        null
                  )
        );
    }
}
