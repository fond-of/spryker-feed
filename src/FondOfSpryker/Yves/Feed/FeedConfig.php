<?php

namespace FondOfSpryker\Yves\Feed;

use FondOfSpryker\Shared\Feed\FeedConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class FeedConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getFeedUser(): ?string
    {
        return $this->get(FeedConstants::FEED_USER);
    }

    /**
     * @return string|null
     */
    public function getFeedPassword(): ?string
    {
        return $this->get(FeedConstants::FEED_PASSWORD);
    }
}
