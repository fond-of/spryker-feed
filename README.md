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

### 4. Add ControllerProvider FeedControllerProvider.php to YvesBootstrap

### 5. Add basic auth password and user to config file for example in config_default.php
```
// ---------- Feed
$config[FeedConstants::FEED_USER] = 'foo';
$config[FeedConstants::FEED_PASSWORD] = 'bar';
```

### 6. Open https://[URL]/feed/availability