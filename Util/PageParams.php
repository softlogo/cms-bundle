<?php
namespace Softlogo\CMSBundle\Util;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

class PageParams
{
	protected $request;
	protected $urlParams;
	protected $em;

	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct($em, RequestStack $request_stack)
	{
	    $this->request = $request_stack->getCurrentRequest();
	    $this->urlParams = $this->request->attributes->get('_route_params');
		$this->em = $em;

	}

	public function params()
	{
		$siteName=! isset($this->urlParams['site']) ? 'main':$this->urlParams['site'];
		$site = $this->em->getRepository('SoftlogoCMSBundle:Site')->findOneBy(array('name'=>$siteName));
		$locale=$this->urlParams['_locale'];
		return array(
			'site' => $site,
			'locale' => $locale,
		);

	}
}
