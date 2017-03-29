<?php


namespace NAOSecurityBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use NAOSecurityBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');

        $plainPassword = 'admin';
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($userAdmin, $plainPassword);

        $userAdmin->setPassword($encoded);

        $userAdmin->setEmail('admin@nao.fr');
        $userAdmin->setIsActive(true);
        $userAdmin->setRoles('ROLE_ADMIN');

        $manager->persist($userAdmin);
        $manager->flush();
    }
}