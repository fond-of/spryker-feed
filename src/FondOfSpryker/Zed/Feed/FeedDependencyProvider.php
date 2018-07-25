<?php

namespace FondOfSpryker\Zed\Feed;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class FeedDependencyProvider extends AbstractBundleDependencyProvider
{
    public const AVAILABILITY_QUERY_CONTAINER = 'AVAILABILITY_QUERY_CONTAINER';
    public const AVAILABILITY_ALERT_QUERY_CONTAINER = 'AVAILABILITY_ALERT_QUERY_CONTAINER';
    public const PRODUCT_FACADE = 'PRODUCT_FACADE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->provideAvailabilityQueryContainer($container);
        $container = $this->provideAvailabilityAlertQueryContainer($container);
        $container = $this->provideProductFacade($container);

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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideAvailabilityAlertQueryContainer(Container $container): Container
    {
        $container[static::AVAILABILITY_ALERT_QUERY_CONTAINER] = function (Container $container) {
            return $container->getLocator()->availabilityAlert()->queryContainer();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideProductFacade(Container $container): Container
    {
        $container[static::PRODUCT_FACADE] = function (Container $container) {
            return $container->getLocator()->product()->facade();
        };

        return $container;
    }
}
