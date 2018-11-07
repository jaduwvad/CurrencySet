<?php

namespace CurrencySet;

use Shopware\Components\Plugin;

class CurrencySet extends Plugin{
    public static function getSubscribedEvents(){
        return [
            'Enlight_Controller_Action_PostDispatch_Fronted' => 'onPostDispatch',
            'Enlight_Controller_Action_PreDispatch' => 'oPreDispatch'
        ];
    }

    public function onPostDispatch(\Enlight_Event_EventArgs $args)
    {
        $controller = $args->getSubject();
        $controller->View()->addTemplateDir(__DIR__ . '/Resources/views');
    }

    public function onPreDispatch(\Enlight_EventEventArgs $args)
    {
        $controller = $args->getSubject();
        $controller->View()->addTemplateDir(__DIR__ . '/Resources/views');
    }
}
