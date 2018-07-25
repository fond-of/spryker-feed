<?php

namespace FondOfSpryker\Yves\Feed;

use FondOfSpryker\Yves\Feed\Feed\AvailabilityAlertFeed;
use FondOfSpryker\Yves\Feed\Feed\AvailabilityFeed;
use FondOfSpryker\Yves\Feed\Feed\FeedInterface;
use Spryker\Yves\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\Feed\FeedClientInterface getClient()
 */
class FeedFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Yves\Feed\Feed\FeedInterface
     */
    public function createAvailabilityAlertFeed(): FeedInterface
    {
        return new AvailabilityAlertFeed($this->getClient());
    }

    /**
     * @return \FondOfSpryker\Yves\Feed\Feed\FeedInterface
     */
    public function createAvailabilityFeed(): FeedInterface
    {
        return new AvailabilityFeed($this->getClient());
    }
}
