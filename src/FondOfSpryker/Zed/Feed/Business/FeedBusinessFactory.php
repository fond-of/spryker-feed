<?php

namespace FondOfSpryker\Zed\Feed\Business;

use FondOfSpryker\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface;
use FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityAlertFeed;
use FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityFeed;
use FondOfSpryker\Zed\Feed\FeedDependencyProvider;
use Orm\Zed\Store\Persistence\Base\SpyStoreQuery;
use Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface;
use Spryker\Shared\Kernel\Store;
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
     * @return \Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface
     */
    protected function getAvailabilityQueryContainer(): AvailabilityQueryContainerInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::AVAILABILITY_QUERY_CONTAINER);
    }

    /**
     * @return \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected function getProductFacade(): ProductFacadeInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::PRODUCT_FACADE);
    }

    /**
     * @return \FondOfSpryker\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface
     */
    protected function getAvailabilityAlertQueryContainer(): AvailabilityAlertQueryContainerInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::AVAILABILITY_ALERT_QUERY_CONTAINER);
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        /** @var \Orm\Zed\Store\Persistence\Base\SpyStoreQuery $storeQuery */
        $storeQuery = SpyStoreQuery::create()
            ->findOneBy('name', $this->getStore()->getStoreName());

        return $storeQuery->getPrimaryKey();
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    protected function getStore(): Store
    {
        return Store::getInstance();
    }
}
