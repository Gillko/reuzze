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
use Reuzze\ReuzzeBundle\Entity\Users;
use Reuzze\ReuzzeBundle\Entity\Persons;
use Reuzze\ReuzzeBundle\Entity\Addresses;
use Reuzze\ReuzzeBundle\Entity\Regions;
use Reuzze\ReuzzeBundle\Entity\Roles;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsersData implements FixtureInterface, ContainerAwareInterface
{
    private $container;
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $region = new Regions();
        $region->setregionName('Oost-Vlaanderen');

        $address = new Addresses();
        $address->setaddressStreet('Patijntjestraat');
        $address->setaddressCity('Gent');
        $address->setaddressLat('51.040009');
        $address->setaddressLon('3.708362');
        $address->setaddressStreetNr('33');
        $address->setregion($region);

        $person = new Persons();
        $person->setpersonFirstname('Gilles');
        $person->setpersonSurname('Vanpeteghem');
        $person->setpersonProfile('Gilles Vanpeteghem...');
        $person->setaddress($address);

        $role = new Roles();
        $role->setroleName('Member');

        $user = new Users();
        $user->setusername('Gilko');
        $user->setpassword($this->encodePassword($user, 'gilko'));
        $user->setuserEmail('gilles.vanpeteghem@gmail.com');
        $user->setuserRating('1');
        $user->setperson($person);
        $user->setroles($role);

        $manager->persist($user);
        $manager->persist($region);
        $manager->persist($address);
        $manager->persist($person);
        $manager->persist($role);

        $manager->flush();
    }

    private function encodePassword($user, $plainPassword){
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());

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