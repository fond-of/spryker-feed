<?php

namespace FondOfSpryker\Yves\Feed\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \FondOfSpryker\Yves\Feed\FeedFactory getFactory()
 * @method \FondOfSpryker\Client\Feed\FeedClientInterface getClient()
 */
class FeedController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function availabilityAction(Request $request): Response
    {
        $data = $this->getClient()->getAvailabilityFeedData();

        $content = '"SKU";"Quantity"' . "\r\n";
        foreach ($data->getFeedDataArray() as $feedDataAvailabilityTransfer) {
            $content .= '"' . $feedDataAvailabilityTransfer->getSku() . '";"' . $feedDataAvailabilityTransfer->getQuantity() . '"' . "\r\n";
        }

        return new Response($content, 200, ['Content-Disposition' => 'attachment;filename=feed.csv']);
    }
}
