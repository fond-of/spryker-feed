<?php

namespace FondOfSpryker\Zed\Feed\Persistence;

use FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface;
use FondOfSpryker\Zed\Feed\FeedDependencyProvider;
use Orm\Zed\Availability\Persistence\SpyAvailabilityQuery;
use Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery;
use Orm\Zed\Store\Persistence\Base\SpyStoreQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\Feed\FeedConfig getConfig()
 * @method \FondOfSpryker\Zed\Feed\Persistence\FeedRepository getRepository()
 */
class FeedPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery
     */
    public function createStoreQuery(): SpyStoreQuery
    {
        return SpyStoreQuery::create();
    }

    /**
     * @return \FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface
     */
    public function getStoreFacade(): FeedToStoreFacadeInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function getAvailabilityAlertSubscriptionQuery(): FosAvailabilityAlertSubscriptionQuery
    {
        return $this->getProvidedDependency(FeedDependencyProvider::PROPEL_AVAILABILITY_ALERT_SUBSCRIPTION_QUERY);
    }

    /**
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery
     */
    public function getAvailabilityQuery(): SpyAvailabilityQuery
    {
        return $this->getProvidedDependency(FeedDependencyProvider::PROPEL_AVAILABILITY_QUERY);
    }
}
