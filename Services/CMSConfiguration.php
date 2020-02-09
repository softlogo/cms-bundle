<?php
namespace Softlogo\CMSBundle\Services;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;
use Softlogo\CMSBundle\DependencyInjection\Configuration;

class CMSConfiguration 
{
	protected $confArray;
	protected $siteRepository;
	protected $branchArray;
	protected $host="";
	protected $site;
	public function __construct($rootDir, $router, $em, $cmsConfigPath, $customConfigPath=false){

		$this->siteRepository= $em->getRepository('SoftlogoCMSBundle:Site');
		$this->branchArray["section_types"]="CMS";
		$this->branchArray["page_types"]="Page";
		$this->branchArray["block_types"]="Block";
		$this->branchArray["menu_types"]="Menu";

		/*
		 *Łączę trzy pliki konfiguracyjne. Robię merge iteracyjnie.
		 */
		$cmsConfig = Yaml::parseFile($cmsConfigPath);

		if(true){
			$this->host=$router->getContext()->getHost();

			if($this->host !='localhost'){
				$this->site=$this->siteRepository->findOneBy(array('host'=>$this->host))->getName();
			}
			//$this->site="praxis34.localhost";
			//echo $this->site;
			//echo $this->siteRepository->findOneBy(array('host'=>$this->host))->getId();
			$siteConfigPath=$rootDir."/../sites/".$this->site."/config/config.yml";

			$root="softlogo_cms";
			if($customConfigPath){
				$customConfig = Yaml::parseFile($customConfigPath);
				$config1 = array_merge($cmsConfig[$root], $customConfig[$root]);
				$config2 = array_merge($customConfig[$root], $cmsConfig[$root]);
				foreach($config1 as $key=>$value){
					$config[$root][$key]=array_merge($config2[$key], $config1[$key]);
				}
			}
			else $config=$cmsConfig;

			$cmsConfig=$config;

			if($siteConfigPath){
				$siteConfig = Yaml::parseFile($siteConfigPath);
				//print_r($siteConfig);
				$config1 = array_merge($cmsConfig[$root], $siteConfig[$root]);
				$config2 = array_merge($siteConfig[$root], $cmsConfig[$root]);
				foreach($config1 as $key=>$value){
					$config[$root][$key]=array_merge($config2[$key], $config1[$key]);
				}
			}
			else $config=$cmsConfig;

			$this->confArray=$config["softlogo_cms"];
			$this->siteConfArray=$siteConfig["softlogo_cms"];



			//print_r($this->siteConfArray);
		}

	}
	public function getBranchDir($branch){
		return $this->branchArray[$branch];
	}
	public function getView($branch, $type){
		$dir=$this->getBranchDir($branch);
		$view=$this->confArray[$branch][$type];
		if(array_key_exists($branch, $this->siteConfArray)){
			if(array_key_exists($type, $this->siteConfArray[$branch])){
				return "@sites/$this->site/views/$dir/$view";
			}else return "SoftlogoCMSBundle:$dir:$view";
		}else return "SoftlogoCMSBundle:$dir:$view";
	}
	public function getSectionView($type)
	{
		return $view=$this->getView('section_types',$type);
	}
	public function getPageView($type)
	{
		return $view=$this->getView('page_types',$type);
	}
	public function getBlockView($type)
	{
		return $view=$this->getView('block_types',$type);
	}
	public function getMenuView($type)
	{
		return $view=$this->getView('menu_types',$type);
	}
	public function getArticleValue($type)
	{
		return $view=$this->confArray['article_types'][$type];
	}
	public function getWrapperValue($type)
	{
		return $view=$this->confArray['wrapper_types'][$type];
	}
	public function getOffsetValue($type)
	{
		return $view=$this->confArray['offset_types'][$type];
	}
	public function getKeys($dictionary)
	{
		$lista=$this->confArray[$dictionary];
		foreach( $lista as $key=>$value){
			$lista[$key]=$key;
		}
		return $lista;

	}
	public function isCustomView($view){
		return in_array($view, $this->siteConfArray['custom_views']);
	}

}
