<?php
namespace Softlogo\CMSBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
/*
 *use Softlogo\CMSBundle\Entity\PageType;
 *use Softlogo\CMSBundle\Entity\SubpageType;
 *use Softlogo\CMSBundle\Entity\ArticleType;
 *use Softlogo\CMSBundle\Entity\Language;
 *use Softlogo\CMSBundle\Entity\User;
 */
use Softlogo\CMSBundle\Entity\Page;
use Softlogo\CMSBundle\Entity\Section;
use Softlogo\CMSBundle\Entity\PageSection;

class PopulateDatabase implements FixtureInterface
{
	/*
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $em)
	{

		$pss=$em->getRepository('SoftlogoCMSBundle:PageSection')->findAll();
		foreach($pss as $ps){
			echo $ps->getSection()->getType();
		}

		//$menu = $this->getRepository()->findBy(array('isMenu'=>true), array('itemorder' => 'ASC'));

		/*
		 *$standardPage = new PageType();
		 *$standardPage->setName("Standard");
         *$manager->persist($standardPage);
		 *
		 *$standardSubpage = new SubpageType();
		 *$standardSubpage->setName("Standard");
         *$manager->persist($standardSubpage);
		 *
		 *$standardArticle = new ArticleType();
		 *$standardArticle->setName("Standard");
         *$manager->persist($standardArticle);
		 *
		 *$langPl = new Language();
		 *$langPl->setName("polski");
		 *$langPl->setAbbr("pl");
		 *$manager->persist($langPl);
		 *
		 *$langEn = new Language();
		 *$langEn->setName("English");
		 *$langEn->setAbbr("en");
		 *$manager->persist($langEn);
		 *
		 *$homePl = new Page();
		 *$homePl->setTitle("Strona główna");
		 *$homePl->setAnchor("home");
		 *$homePl->setLanguage($langPl);
		 *$manager->persist($homePl);
		 *
		 *$homeEn = new Page();
		 *$homeEn->setTitle("Home page");
		 *$homeEn->setAnchor("home");
		 *$homeEn->setLanguage($langEn);
		 *$manager->persist($homeEn);
		 */
		
		$em->flush();
	}

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
?>
