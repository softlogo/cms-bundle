<?php
namespace Softlogo\CMSBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Softlogo\CMSBundle\Entity\Language;
use Softlogo\CMSBundle\Entity\Page;
use Softlogo\CMSBundle\Entity\Article;
use Softlogo\CMSBundle\Entity\Section;
use Softlogo\CMSBundle\Entity\Site;
use Softlogo\CMSBundle\Entity\PageSection;

class PopulateDatabase implements FixtureInterface
{
	/*
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $manager)
	{
		$home=new Site();
		$home->setName('main');


		$langPl = new Language();
		$langPl->setName("polski");
		$langPl->setAbbr("pl");
		$manager->persist($langPl);
		
		$langEn = new Language();
		$langEn->setName("English");
		$langEn->setAbbr("en");
		$manager->persist($langEn);


		$intro=new Article();
		$intro->setLanguage($langPl);
		$intro->setContent("To jest automatycznie wygenerowany artykuł");
		$manager->persist($intro);

		
		
		$homePl = new Page();
		$homePL->setSite($home);
		$homePl->setTitle("Strona główna");
		$homePl->setDescription("Strona główna");
		$homePl->setKeywords("start");
		$homePl->setName("Strona główna");
		$homePl->setAnchor("home");
		$homePl->setPriority(0.9);
		$homePl->addArticle($intro);
		$manager->persist($homePl);
		
		/*
		 *$homeEn = new Page();
		 *$homeEn->setTitle("Home page");
		 *$homeEn->setAnchor("home");
		 *$homeEn->setLanguage($langEn);
		 *$manager->persist($homeEn);
		 */
		
		$manager->flush();
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
