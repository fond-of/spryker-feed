<?php

namespace FondOfSpryker\Yves\Feed\Feed;

use FondOfSpryker\Client\Feed\FeedClientInterface;
use FondOfSpryker\Yves\Feed\CSV\CsvContent;
use FondOfSpryker\Yves\Feed\CSV\CsvContentInterface;

class AvailabilityFeed implements FeedInterface
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
        $content = new CsvContent(['SKU', 'Quantity']);
        foreach ($this->client->getAvailabilityFeedData()->getFeedDataArray() as $feedData) {
            $content->addRow([$feedData->getSku(), $feedData->getQuantity()]);
        }

        return $content;
    }
}
