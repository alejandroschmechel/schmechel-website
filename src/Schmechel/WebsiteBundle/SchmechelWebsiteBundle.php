<?php

namespace Schmechel\WebsiteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SchmechelWebsiteBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
