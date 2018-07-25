<?php

namespace FondOfSpryker\Yves\Feed\Plugin\Provider;

use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;
use Silex\Application;

class FeedControllerProvider extends AbstractYvesControllerProvider
{
    public const ROUTE_AVAILABILITY = 'feed-availability';
    public const ROUTE_AVAILABILITY_PATH = '/feed/availability';

    public const ROUTE_AVAILABILITY_ALERT = 'feed-availability-alert';
    public const ROUTE_AVAILABILITY_ALERT_PATH = '/feed/availability-alert';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app): void
    {
        $this->createGetController(static::ROUTE_AVAILABILITY_PATH, static::ROUTE_AVAILABILITY, 'Feed', 'Feed', 'availabilityFeed')
            ->method('GET');

        $this->createGetController(static::ROUTE_AVAILABILITY_ALERT_PATH, static::ROUTE_AVAILABILITY_ALERT, 'Feed', 'Feed', 'availabilityAlertFeed')
            ->method('GET');
    }
}
