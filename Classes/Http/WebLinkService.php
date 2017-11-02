<?php
namespace Vette\WebLink\Http;

use Fig\Link\Link;
use Neos\Flow\Core\Bootstrap;
use Neos\Flow\Http\HttpRequestHandlerInterface;
use Neos\Flow\Annotations as Flow;

/**
 * Class WebLinkService
 *
 * @Flow\Scope("singleton")
 */
class WebLinkService
{
    /**
     * @Flow\Inject
     * @var Bootstrap
     */
    protected $bootstrap;


    /**
     * Adds a "Link" HTTP header.
     *
     * @param string $uri A public path
     * @param string $rel The relation type (e.g. "preload", "prefetch", "prerender" or "dns-prefetch")
     * @param array $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     * @return string
     */
    public function link(string $uri, string $rel, array $attributes = array())
    {
        $link = new Link($rel, $uri);
        foreach ($attributes as $key => $value) {
            $link = $link->withAttribute($key, $value);
        }

        $requestHandler = $this->bootstrap->getActiveRequestHandler();

        if ($requestHandler instanceof HttpRequestHandlerInterface) {
            $request = $requestHandler->getHttpRequest();
            $linkProvider = $request->getAttribute('linkProvider');
            if ($linkProvider instanceof LinkProvider) {
                $linkProvider->addLink($link);
            }
        }

        return $uri;
    }
}
