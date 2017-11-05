# WebLink Package for Neo Flow

This Neos Flow package provides methods to manage links between resources and advise clients to preload and prefetch resources through HTTP and HTTP/2 pushes.

## Usage

You can add a link header in three different ways:

### Using the Fusion Prototype
This will output a Html link tag with the given "rel" attribute and set the Http link header for the response.

     link = Vette.WebLink:Link {
          href = 'http://foo.bar/x.y'
          rel = 'preload'
     }

### Using the EEL Helper
If you use this EEL helper, make sure the containing Fusion prototype is uncached.

     $href = ${Vette.WebLink.link('http://foo.bar/x.y', 'preload')}
     
### Adding a Link Header via the WebLink Service
     
     /**
      * @Flow\Inject
      * @var WebLinkService
      **/
     protected $webLinkService;
     
     ...
     
     $this->webLinkService->link('http:foo.bar/x.y', 'preload');
