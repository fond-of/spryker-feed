<?php

namespace FondOfSpryker\Client\Feed;

use FondOfSpryker\Client\Contact\ContactDependencyProvider;
use FondOfSpryker\Client\Feed\Zed\FeedStub;
use FondOfSpryker\Client\Feed\Zed\FeedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClient;

class FeedFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\Feed\Zed\FeedStubInterface
     */
    public function createFeedStub(): FeedStubInterface
    {
        return new FeedStub($this->getZedRequestClient());
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\ZedRequest\ZedRequestClient
     */
    protected function getZedRequestClient(): ZedRequestClient
    {
        return $this->getProvidedDependency(ContactDependencyProvider::ZED_CLIENT);
    }
}
