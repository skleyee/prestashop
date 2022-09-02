<?php


namespace ps_adaptationmodule\Controller;

use Doctrine\Common\Cache\CacheProvider;
use http\Env\Response;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class AdaptationController extends FrameworkBundleAdminController
{
    private $cache;

    public function __construct()
    {
    }

    public function AdaptationAction()
    {
        return $this->render('@Modules/ps_adaptationmodule/templates/admin/start.twig');
    }

}