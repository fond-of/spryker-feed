<?php

namespace FondOfSpryker\Zed\Feed\Business\Availability;

use FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToProductFacadeInterface;
use FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface;
use FondOfSpryker\Zed\Feed\Persistence\FeedRepositoryInterface;
use Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer;
use Generated\Shared\Transfer\FeedDataAvailabilityAlertTransfer;
use Generated\Shared\Transfer\FeedDataRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\Feed\FeedConfig getConfig()
 * @method \FondOfSpryker\Zed\Feed\Business\FeedBusinessFactory getFactory()
 */
class AvailabilityAlertFeed extends AbstractPlugin
{
    private const STATUS_WAITING = 0;

    /**
     * @var \FondOfSpryker\Zed\Feed\Persistence\FeedRepositoryInterface
     */
    protected $feedRepository;

    /**
     * @var \FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @var \FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \FondOfSpryker\Zed\Feed\Persistence\FeedRepositoryInterface $feedRepository
     * @param \FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToProductFacadeInterface $productFacade
     * @param \FondOfSpryker\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface $storeFacade
     */
    public function __construct(
        FeedRepositoryInterface $feedRepository,
        FeedToProductFacadeInterface $productFacade,
        FeedToStoreFacadeInterface $storeFacade
    ) {
        $this->feedRepository = $feedRepository;
        $this->productFacade = $productFacade;
        $this->storeFacade = $storeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\FeedDataRequestTransfer $feedDataRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer
     */
    public function getAvailabilityAlertFeedData(FeedDataRequestTransfer $feedDataRequestTransfer): FeedDataAvailabilityAlertResponseTransfer
    {
        $data = [];
        $subscribers = $this->feedRepository->findSubscriptionsByIdStoreAndStatus(
            $this->storeFacade->getCurrentStore()->getIdStore(),
            static::STATUS_WAITING
        );

        foreach ($subscribers as $subscriber) {
            if (!array_key_exists($subscriber->getFkProductAbstract(), $data)) {
                $data[$subscriber->getFkProductAbstract()] = 0;
            }

            $data[$subscriber->getFkProductAbstract()]++;
        }

        $response = new FeedDataAvailabilityAlertResponseTransfer();
        foreach ($data as $productAbstractId => $subscriberCount) {
            $productAbstract = $this->productFacade->findProductAbstractById($productAbstractId);
            $alert = new FeedDataAvailabilityAlertTransfer();
            $alert->setSubscriberCount($subscriberCount);
            $alert->setSku($productAbstract->getSku());
            $response->addFeedData($alert);
        }

        return $response;
    }
}
