<?php
namespace Softlogo\CMSBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Softlogo\CMSBundle\Entity\Language;
use Softlogo\CMSBundle\Entity\Page;
use Softlogo\CMSBundle\Entity\Article;
use Softlogo\CMSBundle\Entity\Section;
use Softlogo\CMSBundle\Entity\Site;
use Softlogo\CMSBundle\Entity\PageSection;
use FOS\UserBundle\Model\UserManagerInterface;


class PopulateDatabase implements FixtureInterface 
{


        private $userManager;

        public function __construct(UserManagerInterface $userManager)
        {
            $this->userManager = $userManager;
        }
	/*
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $manager)
	{
		$home=new Site();
		/*
		 *$home->setName('doskonali');
		 *$home->setHost('doskonali.localhost');
		 */
		$home->setName('site');
		$home->setHost('site.localhost');
		$home->setIsMain(true);
		$manager->persist($home);

		
		$homePl = new Page();
		$homePl->addSite($home);
		$homePl->setTitle("Strona główna");
		$homePl->setDescription("Strona główna");
		$homePl->setKeywords("start");
		$homePl->setType("home");
		$homePl->setName("Strona główna");
		$homePl->setAnchor("home");
		$homePl->setPriority(0.9);
		$manager->persist($homePl);
		
		
		$manager->flush();


		//USER
		$user = $this->userManager->createUser();
		$user->setUsername('borys');
		$user->setEmail('borysjank@gmail.com');
		$user->setPlainPassword('fmsoft583');
		$user->setEnabled(true);
		$user->setRoles(array('ROLE_SUPER_ADMIN'));

		// Update the user
		$this->userManager->updateUser($user, true);
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
