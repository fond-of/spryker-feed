<?php

namespace FondOfSpryker\Client\Feed;

use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\Feed\FeedFactory getFactory()
 */
class FeedClient extends AbstractClient implements FeedClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(): FeedDataAvailabilityResponseTransfer
    {
        return $this->getFactory()->createFeedStub()->getAvailabilityFeedData();
    }
}
