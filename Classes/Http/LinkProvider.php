<?php
namespace Vette\WebLink\Http;

use Fig\Link\LinkProviderTrait;
use Psr\Link\LinkInterface;
use Psr\Link\LinkProviderInterface;

/**
 * Class LinkProvider
 */
class LinkProvider implements LinkProviderInterface
{
    use LinkProviderTrait;

    /**
     * @param LinkInterface $link
     * @return $this
     */
    public function addLink(LinkInterface $link)
    {
        $splosh = spl_object_hash($link);
        if (!array_key_exists($splosh, $this->links)) {
            $this->links[$splosh] = $link;
        }
        return $this;
    }
}
