<?php

namespace FondOfSpryker\Zed\Feed\Business\Availability;

use FondOfSpryker\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface;
use Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer;
use Generated\Shared\Transfer\FeedDataAvailabilityAlertTransfer;
use Generated\Shared\Transfer\FeedDataRequestTransfer;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use Spryker\Zed\Product\Persistence\ProductQueryContainerInterface;
use Spryker\Zed\ProductAbstractDataFeed\Persistence\ProductAbstractDataFeedQueryContainer;

/**
 * @method \FondOfSpryker\Zed\Feed\FeedConfig getConfig()
 */
class AvailabilityAlertFeed
{
    private const STATUS_WAITING = 0;

    /**
     * @var \FondOfSpryker\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainer
     */
    private $availabilityAlertQueryContainer;

    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    private $productFacade;

    /**
     * @param \FondOfSpryker\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface $availabilityAlertQueryContainer
     * @param \Spryker\Zed\Product\Persistence\ProductQueryContainerInterface $productQueryContainer
     */
    public function __construct(AvailabilityAlertQueryContainerInterface $availabilityAlertQueryContainer, ProductFacadeInterface $productFacade)
    {
        $this->availabilityAlertQueryContainer = $availabilityAlertQueryContainer;
        $this->productFacade = $productFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\FeedDataRequestTransfer $feedDataRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer
     */
    public function getAvailabilityAlertFeedData(FeedDataRequestTransfer $feedDataRequestTransfer): FeedDataAvailabilityAlertResponseTransfer
    {
        $data = [];
        $subscribers = $this->availabilityAlertQueryContainer->querySubscriptionsByStatus(static::STATUS_WAITING)->find();
        foreach ($subscribers as $subscriber) {
            if (! array_key_exists($subscriber->getFkProductAbstract(), $data)) {
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
