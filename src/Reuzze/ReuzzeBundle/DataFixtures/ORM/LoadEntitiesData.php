<?php
/**
 * Created by PhpStorm.
 * User: gillesvanpeteghem
 * Date: 4/12/13
 * Time: 21:16
 */

// src/Reuzze/ReuzzeBundle/DataFixtures/ORM/LoadUserData.php

namespace Reuzze\ReuzzeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Reuzze\ReuzzeBundle\Entity\Entities;
use Reuzze\ReuzzeBundle\Entity\Users;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadEntitiesData implements FixtureInterface, ContainerAwareInterface
{
    private $container;
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $entity = new Entities();

        $user = new Users();

        $entity->setentityTitle('Iphone 5 16GB');
        $entity->setentityDescription('Nog in origineel doosje. Perfect werkend toestel. Gaat weg omdat we toestel teveel hadden.');
        $entity->setentityStarttime(new \DateTime('NOW'));
        $entity->setentityEndtime(new \DateTime('NOW + 7 day'));
        $entity->setentityInstantsellingprice('400');
        $entity->setentityCondition('Used');
        $entity->setentityCreated(new \DateTime('NOW'));

        $user->getUserId('1');
        $entity->setUser($user);

        $manager->persist($entity);

        $manager->flush();
    }

    /*
     * Sets the container
     *
     * @param ContainerInterface $container A ContainerInterface instance
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null){

        $this->container = $container;

    }
}