# fond-of-spryker/feed
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/feed)


### 1. Install
```
    composer require fond-of-spryker/feed
```

### 2. Extend Availability Query Container in PYZ like below

```
namespace Pyz\Zed\Availability\Persistence;

use Spryker\Zed\Availability\Persistence\AvailabilityQueryContainer as SprykerAvailabilityQueryContainer;

/**
 * @method \Spryker\Zed\Availability\Persistence\AvailabilityPersistenceFactory getFactory()
 */
class AvailabilityQueryContainer extends SprykerAvailabilityQueryContainer implements AvailabilityQueryContainerInterface
{
    /**
     * @api
     *
     * @return \Orm\Zed\Availability\Persistence\Base\SpyAvailabilityQuery
     */
    public function queryAllAvailability()
    {
        return $this->getFactory()->createSpyAvailabilityQuery();
    }
}

```

### 3. Console
```
    vendor/bin/console transfer:generate
```

### 4. Register Controller
#### Silex Routing (deprecated use Symfony Routing instead)
add in src/Pyz/Yves/ShopApplication/YvesBootstrap.php
```
    /**
     * @param bool|null $isSsl
     *
     * @return \SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider[]
     */
    protected function getControllerProviderStack($isSsl)
    {
        return [
            new FeedControllerProvider(),
        ];
    }
```

#### Symfony Routing
add in src/Pyz/Yves/Router/RouterDependencyProvider.php
```
    /**
     * @return \Spryker\Yves\RouterExtension\Dependency\Plugin\RouteProviderPluginInterface[]
     */
    protected function getRouteProvider(): array
    {
        return [
            ...
            new FeedRouteProviderPlugin(),
        ];
    }
```

### 5. Add basic auth password and user to config file for example in config_default.php
```
// ---------- Feed
$config[FeedConstants::FEED_USER] = 'foo';
$config[FeedConstants::FEED_PASSWORD] = 'bar';
```

### 6. Open https://[URL]/feed/availability
