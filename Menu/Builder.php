<?php
// src/Acme/DemoBundle/Menu/Builder.php
namespace Softlogo\CMSBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'home'));
        $menu->addChild('Jak pożyczyć', array(
            'route' => 'cms_page',
            'routeParameters' => array('anchor' => 'jak-pozyczyc')
        ));
        $menu->addChild('Jak spłacać', array(
            'route' => 'cms_page',
            'routeParameters' => array('anchor' => 'jak-splacac')
        ));
        $menu->addChild('Warunki umowy', array(
            'route' => 'cms_page',
            'routeParameters' => array('anchor' => 'warunki-umowy')
        ));
        $menu->addChild('Promocje', array(
            'route' => 'cms_page',
            'routeParameters' => array('anchor' => 'promocje')
        ));
        $menu->addChild('FAQ', array(
            'route' => 'cms_page',
            'routeParameters' => array('anchor' => 'faq')
        ));
        $menu->addChild('Kontakt', array(
            'route' => 'cms_page',
            'routeParameters' => array('anchor' => 'kontakt')
        ));
        // ... add more children

        return $menu;
    }
}
