<?php

namespace FondOfSpryker\Yves\Feed\Plugin\Provider;

use Pyz\Yves\Application\Plugin\Provider\AbstractYvesControllerProvider;
use Silex\Application;

class FeedControllerProvider extends AbstractYvesControllerProvider
{
    const FEED_INDEX = 'feed-index';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $this->createGetController('/feed/availability', static::FEED_INDEX, 'Feed', 'Feed', 'availability')
            ->method('GET');
    }
}
