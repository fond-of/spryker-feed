<?php

namespace FondOfSpryker\Yves\Feed\Controller;

use FondOfSpryker\Shared\Feed\FeedConstants;
use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;
use Spryker\Shared\Config\Config;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        if ($request->getUser() != Config::get(FeedConstants::FEED_USER) || $request->getPassword() != Config::get(FeedConstants::FEED_PASSWORD)) {
            return new RedirectResponse('/error/404');
        }

        return new Response(
            $this->getAvailabilityFeedContent($this->getClient()->getAvailabilityFeedData()),
            Response::HTTP_OK,
            ['Content-Disposition' => 'attachment;filename=feed.csv']
        );
    }

    /**
     * @param \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer $feedDataAvailabilityResponseTransfer
     *
     * @return string
     */
    protected function getAvailabilityFeedContent(FeedDataAvailabilityResponseTransfer $feedDataAvailabilityResponseTransfer): string
    {
        $content = '"SKU";"Quantity"' . "\r\n";
        foreach ($feedDataAvailabilityResponseTransfer->getFeedDataArray() as $feedDataAvailabilityTransfer) {
            $content .= '"' . $feedDataAvailabilityTransfer->getSku() . '";"' . $feedDataAvailabilityTransfer->getQuantity() . '"' . "\r\n";
        }

        return $content;
    }
}
