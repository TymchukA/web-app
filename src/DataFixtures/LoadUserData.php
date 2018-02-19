<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements  FixtureInterface, ContainerAwareInterface
{
    private $container;
    /**
     * @param ObjectManager $manager
     */

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin1');
        $user->setFullName('admin1');
        $user->setEmail('admin1@admin.com');
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, '0000');
        $user->setPassword($password);
        $user->setRoles('{"0"}:{"ROLE_ADMIN"}');

        $manager->persist($user);
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}