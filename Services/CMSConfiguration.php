<?php
namespace Softlogo\CMSBundle\Services;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;
use Softlogo\CMSBundle\DependencyInjection\Configuration;

class CMSConfiguration 
{
	protected $confArray;
	public function __construct($cmsConfigPath, $customConfigPath=false){

		/*
		 *Łączę dwa pliki konfiguracyjne. Robię merge iteracyjnie.
		 */
		$cmsConfig = Yaml::parse($cmsConfigPath);
		$root="softlogo_cms";
		if($customConfigPath){
			$customConfig = Yaml::parse($customConfigPath);
			$config1 = array_merge($cmsConfig[$root], $customConfig[$root]);
			$config2 = array_merge($customConfig[$root], $cmsConfig[$root]);
			foreach($config1 as $key=>$value){
				$config[$root][$key]=array_merge($config2[$key], $config1[$key]);
			}
		}
		else $config=$cmsConfig;
		//print_r($config);
		$processor = new Processor;
		$configuration = new Configuration;
		$this->confArray = $processor->processConfiguration($configuration, $config);
	}
	public function getSectionView($type)
	{
		return $view=$this->confArray['section_types'][$type];
	}
	public function getPageView($type)
	{
		return $view=$this->confArray['page_types'][$type];
	}
	public function getBlockView($type)
	{
		return $view=$this->confArray['block_types'][$type];
	}
	public function getMenuView($type)
	{
		return $view=$this->confArray['menu_types'][$type];
	}
	public function getKeys($dictionary)
	{
		$lista=$this->confArray[$dictionary];
		foreach( $lista as $key=>$value){
			$lista[$key]=$key;
		}
		return $lista;

		//return array_keys($lista);
	}

}
