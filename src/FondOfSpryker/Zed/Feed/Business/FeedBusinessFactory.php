<?php

namespace FondOfSpryker\Zed\Feed\Business;

use FondOfSpryker\Zed\Feed\Business\Availability\AvailabilityFeed;
use FondOfSpryker\Zed\Feed\FeedDependencyProvider;
use Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

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
     * @return \Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface
     */
    protected function getAvailabilityQueryContainer(): AvailabilityQueryContainerInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::AVAILABILITY_QUERY_CONTAINER);
    }
}
