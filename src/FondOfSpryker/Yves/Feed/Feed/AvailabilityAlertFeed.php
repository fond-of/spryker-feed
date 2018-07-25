<?php

namespace FondOfSpryker\Yves\Feed\Feed;

use FondOfSpryker\Client\Feed\FeedClientInterface;
use FondOfSpryker\Yves\Feed\CSV\CsvContent;
use FondOfSpryker\Yves\Feed\CSV\CsvContentInterface;
use FondOfSpryker\Yves\Feed\Feed\FeedInterface;

class AvailabilityAlertFeed implements FeedInterface
{
    /**
     * @var \FondOfSpryker\Client\Feed\FeedClientInterface
     */
    private $client;

    /**
     * @param \FondOfSpryker\Client\Feed\FeedClientInterface $client
     */
    public function __construct(FeedClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return \FondOfSpryker\Yves\Feed\CSV\CsvContentInterface
     */
    public function create(): CsvContentInterface
    {
        $content = new CsvContent(['SKU', 'Subscriber']);
        foreach ($this->client->getAvailabilityAlertFeedData()->getFeedDataArray() as $feedData) {
            $content->addRow([str_replace('Abstract-','', $feedData->getSku()), $feedData->getSubscriberCount()]);
        }

        return $content;
    }
}
