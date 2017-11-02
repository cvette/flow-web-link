<?php
namespace Vette\WebLink\Fusion\Helper;

use Neos\Eel\ProtectedContextAwareInterface;
use Vette\WebLink\Http\WebLinkService;
use Neos\Flow\Annotations as Flow;

/**
 * Class WebLinkHelper
 *
 */
class WebLinkHelper implements ProtectedContextAwareInterface
{

    /**
     * @Flow\Inject
     * @var WebLinkService
     */
    protected $webLinkService;


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
        return $this->webLinkService->link($uri, $rel, $attributes);
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
