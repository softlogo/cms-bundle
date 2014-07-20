<?php

namespace Softlogo\CMSBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('softlogo_cms');
		$rootNode->
			children()
				->booleanNode('enabled')->end()
				->scalarNode('wersja')->end()
				->arrayNode('section_types')
					->prototype('scalar')->end()
				->end()
				->arrayNode('page_types')
					->prototype('scalar')->end()
				->end()
				->arrayNode('block_types')
					->prototype('scalar')->end()
				->end()
				->arrayNode('menu_types')
					->prototype('scalar')->end()
				->end()
				->arrayNode('article_types')
					->prototype('scalar')->end()
				->end()
				->arrayNode('wrapper_types')
					->prototype('scalar')->end()
				->end()
				->arrayNode('offset_types')
					->prototype('scalar')->end()
				->end()
			->end()
		->end()
		;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
