<?php

namespace FondOfSpryker\Yves\Feed\Response;

use FondOfSpryker\Yves\Feed\CSV\CsvContentInterface;
use Symfony\Component\HttpFoundation\Response;

class CsvResponse extends Response
{
    /**
     * @param \FondOfSpryker\Yves\Feed\CSV\CsvContentInterface $content
     * @param int $status
     * @param string[] $headers
     */
    public function __construct(CsvContentInterface $content, int $status = 200, array $headers = [])
    {
        parent::__construct($content->getContent(), $status, $headers);
        $this->headers->set('Content-Type', 'text/csv');
        $this->headers->set('Content-Disposition', 'attachment;filename=feed.csv');
    }
}
