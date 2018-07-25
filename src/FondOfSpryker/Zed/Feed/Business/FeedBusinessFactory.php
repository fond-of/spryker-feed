<?php

namespace FondOfSpryker\Zed\Feed\Business;

use FondOfSpryker\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface;
use FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityAlertFeed;
use FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityFeed;
use FondOfSpryker\Zed\Feed\FeedDependencyProvider;
use Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

/**
 * @method \FondOfSpryker\Zed\Feed\FeedConfig getConfig()
 */
class FeedBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityFeed
     */
    public function createAvailabilityFeed(): AvailabilityFeed
    {
        return new AvailabilityFeed($this->getAvailabilityQueryContainer());
    }

    /**
     * @return \FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityAlertFeed
     */
    public function createAvailabilityAlertFeed(): AvailabilityAlertFeed
    {
        return new AvailabilityAlertFeed($this->getAvailabilityAlertQueryContainer(), $this->getProductFacade());
    }

    /**
     * @throws
     *
     * @return \Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface
     */
    protected function getAvailabilityQueryContainer(): AvailabilityQueryContainerInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::AVAILABILITY_QUERY_CONTAINER);
    }

    /**
     * @throws
     *
     * @return \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected function getProductFacade(): ProductFacadeInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::PRODUCT_FACADE);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface
     */
    protected function getAvailabilityAlertQueryContainer(): AvailabilityAlertQueryContainerInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::AVAILABILITY_ALERT_QUERY_CONTAINER);
    }
}
