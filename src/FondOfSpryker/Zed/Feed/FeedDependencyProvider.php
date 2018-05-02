<?php

namespace FondOfSpryker\Zed\Feed;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class FeedDependencyProvider extends AbstractBundleDependencyProvider
{
    public const AVAILABILITY_QUERY_CONTAINER = 'AVAILABILITY_QUERY_CONTAINER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->provideAvailabilityQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideAvailabilityQueryContainer(Container $container): Container
    {
        $container[static::AVAILABILITY_QUERY_CONTAINER] = function (Container $container) {
            return $container->getLocator()->availability()->queryContainer();
        };

        return $container;
    }
}
