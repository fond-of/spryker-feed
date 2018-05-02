<?php
namespace FondOfSpryker\Client\Feed;

use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;

interface FeedClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(): FeedDataAvailabilityResponseTransfer;
}
