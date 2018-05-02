<?php

namespace FondOfSpryker\Client\Feed\Zed;

use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;

interface FeedStubInterface
{
    /**
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(): FeedDataAvailabilityResponseTransfer;
}
