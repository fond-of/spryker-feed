<?php

namespace FondOfSpryker\Zed\Feed\Business\Availability;

use FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface;
use FondOfSpryker\Zed\Feed\Persistence\FeedRepositoryInterface;
use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;
use Generated\Shared\Transfer\FeedDataAvailabilityTransfer;
use Generated\Shared\Transfer\FeedDataRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\Feed\FeedConfig getConfig()
 * @method \FondOfSpryker\Zed\Feed\Business\FeedBusinessFactory getFactory()
 */
class AvailabilityFeed extends AbstractPlugin
{
    /**
     * @var \FondOfSpryker\Zed\Feed\Persistence\FeedRepositoryInterface
     */
    protected $feedRepository;

    /**
     * @var \FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \FondOfSpryker\Zed\Feed\Persistence\FeedRepositoryInterface $feedRepository
     * @param \FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface $storeFacade
     */
    public function __construct(FeedRepositoryInterface $feedRepository, FeedToStoreFacadeInterface $storeFacade)
    {
        $this->feedRepository = $feedRepository;
        $this->storeFacade = $storeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\FeedDataRequestTransfer $feedDataRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(FeedDataRequestTransfer $feedDataRequestTransfer): FeedDataAvailabilityResponseTransfer
    {
        $data = $this->feedRepository->getAllAvailabilityByStore($this->storeFacade->getCurrentStore()->getIdStore());

        $feedDataAvailabilityResponse = new FeedDataAvailabilityResponseTransfer();
        foreach ($data as $spyAvailability) {
            /** @var \Orm\Zed\Availability\Persistence\SpyAvailability $spyAvailability */

            $feedData = new FeedDataAvailabilityTransfer();
            $feedData->setQuantity($spyAvailability->getQuantity());
            $feedData->setSku($spyAvailability->getSku());

            $feedDataAvailabilityResponse->addFeedData($feedData);
        }

        return $feedDataAvailabilityResponse;
    }
}
