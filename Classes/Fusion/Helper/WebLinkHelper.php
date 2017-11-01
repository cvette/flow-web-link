<?php
namespace Vette\WebLink\Fusion\Helper;

use Fig\Link\GenericLinkProvider;
use Fig\Link\Link;
use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Flow\Core\Bootstrap;
use Neos\Flow\Http\HttpRequestHandlerInterface;
use Neos\Flow\Annotations as Flow;
use Vette\WebLink\Http\LinkProvider;

/**
 * Class WebLinkHelper
 *
 */
class WebLinkHelper implements ProtectedContextAwareInterface
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

    /**
     * Preloads a resource.
     *
     * @param string $uri A public path
     * @param array $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     * @return string
     */
    public function preload(string $uri, array $attributes = array())
    {
        return $this->link($uri, 'preload', $attributes);
    }

    /**
     * Resolves a resource origin as early as possible.
     *
     * @param string $uri A public path
     * @param array $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     * @return string
     */
    public function dnsPrefetch(string $uri, array $attributes = array())
    {
        return $this->link($uri, 'dns-prefetch', $attributes);
    }

    /**
     * Initiates a early connection to a resource (DNS resolution, TCP handshake, TLS negotiation).
     *
     * @param string $uri A public path
     * @param array $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     * @return string
     */
    public function preconnect(string $uri, array $attributes = array())
    {
        return $this->link($uri, 'preconnect', $attributes);
    }

    /**
     * Indicates to the client that it should prefetch this resource.
     *
     * @param string $uri A public path
     * @param array $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     * @return string
     */
    public function prefetch(string $uri, array $attributes = array())
    {
        return $this->link($uri, 'prefetch', $attributes);
    }

    /**
     * Indicates to the client that it should prerender this resource.
     *
     * @param string $uri A public path
     * @param array $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     * @return string
     */
    public function prerender(string $uri, array $attributes = array())
    {
        return $this->link($uri, 'prerender', $attributes);
    }

    /**
     * @param string $methodName
     * @return bool
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
