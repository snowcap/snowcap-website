<?php

namespace Snowcap\SiteAdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SnowcapSiteAdminBundle extends Bundle
{
    public function getParent()
    {
        return 'SnowcapAdminBundle';
    }

}
