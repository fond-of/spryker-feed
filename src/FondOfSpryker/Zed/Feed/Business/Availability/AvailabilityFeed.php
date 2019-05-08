<?php

namespace FondOfSpryker\Zed\Feed\Business\Availability;

use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;
use Generated\Shared\Transfer\FeedDataAvailabilityTransfer;
use Generated\Shared\Transfer\FeedDataRequestTransfer;
use Pyz\Zed\Availability\Persistence\AvailabilityQueryContainerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\Feed\FeedConfig getConfig()
 * @method \FondOfSpryker\Zed\Feed\Business\FeedBusinessFactory getFactory()
 */
class AvailabilityFeed extends AbstractPlugin
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
        $data = $this->availabilityQueryContainer->queryAllAvailability()->filterByFkStore($this->getFactory()->getStoreId())->find();

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
