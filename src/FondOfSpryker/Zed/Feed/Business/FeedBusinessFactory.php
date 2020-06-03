<?php

namespace FondOfSpryker\Zed\Feed\Business;

use FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityAlertFeed;
use FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityFeed;
use FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToProductFacadeInterface;
use FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface;
use FondOfSpryker\Zed\Feed\FeedDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\Feed\FeedConfig getConfig()
 * @method \FondOfSpryker\Zed\Feed\Persistence\FeedRepositoryInterface getRepository()
 */
class FeedBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityFeed
     */
    public function createAvailabilityFeed(): AvailabilityFeed
    {
        return new AvailabilityFeed($this->getRepository(), $this->getStoreFacade());
    }

    /**
     * @return \FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityAlertFeed
     */
    public function createAvailabilityAlertFeed(): AvailabilityAlertFeed
    {
        return new AvailabilityAlertFeed($this->getRepository(), $this->getProductFacade(), $this->getStoreFacade());
    }

    /**
     * @return \FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToProductFacadeInterface
     */
    protected function getProductFacade(): FeedToProductFacadeInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::PRODUCT_FACADE);
    }

    /**
     * @return \FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface
     */
    protected function getStoreFacade(): FeedToStoreFacadeInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::FACADE_STORE);
    }
}
