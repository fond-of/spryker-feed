<?php

namespace FondOfSpryker\Zed\Feed\Business\Availability;

use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;
use Generated\Shared\Transfer\FeedDataAvailabilityTransfer;
use Generated\Shared\Transfer\FeedDataRequestTransfer;
use Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface;

/**
 * @method \FondOfSpryker\Zed\Feed\FeedConfig getConfig()
 */
class AvailabilityFeed
{
    /**
     * @var \Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface
     */
    private $availabilityQueryContainer;

    /**
     * @param \Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface $availabilityQueryContainer
     */
    public function __construct(AvailabilityQueryContainerInterface $availabilityQueryContainer)
    {
        $this->availabilityQueryContainer = $availabilityQueryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\FeedDataRequestTransfer $feedDataRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(FeedDataRequestTransfer $feedDataRequestTransfer): FeedDataAvailabilityResponseTransfer
    {
        $data = $this->availabilityQueryContainer->queryAllAvailability()->find();

        $feedDataAvailabilityResponse = new FeedDataAvailabilityResponseTransfer();
        foreach ($data->getData() as $spyAvailability) {
            /** @var \Orm\Zed\Availability\Persistence\SpyAvailability $spyAvailability */

            $feedData = new FeedDataAvailabilityTransfer();
            $feedData->setQuantity($spyAvailability->getQuantity());
            $feedData->setSku($spyAvailability->getSku());

            $feedDataAvailabilityResponse->addFeedData($feedData);
        }

        return $feedDataAvailabilityResponse;
    }
}
