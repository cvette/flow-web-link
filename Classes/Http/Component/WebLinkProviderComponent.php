<?php
namespace Vette\WebLink\Http\Component;

use Fig\Link\GenericLinkProvider;
use Neos\Flow\Http\Component\ComponentContext;
use Neos\Flow\Http\Component\ComponentInterface;
use Vette\WebLink\Http\LinkProvider;

/**
 * Class WebLinkOptionComponent
 */
class WebLinkProviderComponent implements ComponentInterface
{
    /**
     * Handle Http request
     *
     * @param ComponentContext $componentContext
     */
    public function handle(ComponentContext $componentContext)
    {
        $request = $componentContext->getHttpRequest()->withAttribute('linkProvider', new LinkProvider());
        $componentContext->replaceHttpRequest($request);
    }
}
