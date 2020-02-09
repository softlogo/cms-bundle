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
use Symfony\Component\DependencyInjection\ContainerAware;

class PopulateDatabase extends ContainerAware implements FixtureInterface 
{
	/*
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $manager)
	{
		$home=new Site();
		$home->setName('main');
		$home->setIsMain(true);
		$manager->persist($home);


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
		$homePl->setSite($home);
		$homePl->setTitle("Strona główna");
		$homePl->setDescription("Strona główna");
		$homePl->setKeywords("start");
		$homePl->setType("home");
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


		//USER
		$userManager = $this->container->get('fos_user.user_manager');
        // Create our user and set details
        $user = $userManager->createUser();
        $user->setUsername('borys');
        $user->setEmail('borysjank@gmail.com');
        $user->setPlainPassword('fmsoft583');
        //$user->setPassword('3NCRYPT3D-V3R51ON');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_SUPER_ADMIN'));
        //$user->setRoles(array('ROLE_SONATA_ADMIN'));

        // Update the user
        $userManager->updateUser($user, true);
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
