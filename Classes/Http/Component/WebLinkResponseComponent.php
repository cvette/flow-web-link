<?php
namespace Vette\WebLink\Http\Component;

use Neos\Flow\Http\Component\ComponentContext;
use Neos\Flow\Http\Component\ComponentInterface;
use Vette\WebLink\Http\HttpHeaderSerializer;

/**
 * Class WebLinkComponent
 */
class WebLinkResponseComponent implements ComponentInterface
{

    /**
     * Handle Http request
     *
     * @param ComponentContext $componentContext
     */
    public function handle(ComponentContext $componentContext)
    {
        $serializer = new HttpHeaderSerializer();
        $provider = $componentContext->getHttpRequest()->getAttribute('linkProvider');
        $links = $provider->getLinks();

        if (empty($links)) {
            return;
        }

        $response = $componentContext->getHttpResponse();
        $response->setHeader('Link', $serializer->serialize($links), false);
    }
}
