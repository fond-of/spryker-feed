<?php

namespace FondOfSpryker\Yves\Feed\Feed;

use FondOfSpryker\Yves\Feed\CSV\CsvContentInterface;

interface FeedInterface
{
    /**
     * @return \FondOfSpryker\Yves\Feed\CSV\CsvContentInterface
     */
    public function create(): CsvContentInterface;
}
