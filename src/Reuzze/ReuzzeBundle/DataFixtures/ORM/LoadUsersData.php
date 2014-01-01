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
use Reuzze\ReuzzeBundle\Entity\Languages;
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

        /*$category = new Category();
        $category->setName('Main Products');

        $product = new Product();
        $product->setName('Foo');
        $product->setPrice(19.99);
        // relate this product to the category
        $product->setCategory($category);*/

        /*$em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();*/

        //$language = new Languages();
        //$language->setlanguageName('nederlands');

        $region = new Regions();
        //$region->setregionId('1');
        $region->setregionName('East Flanders');

        $address = new Addresses();
        //$adress->setadressId('1');
        $address->setaddressStreet('Patijntjestraat');
        $address->setaddressCity('Ghent');
        $address->setaddressLat('51.040009');
        $address->setaddressLon('3.708362');
        $address->setaddressStreetNr('33');
        $address->setregion($region);

        $person = new Persons();
        //$person->setperson('1');
        $person->setpersonFirstname('Gilles');
        $person->setpersonSurname('Vanpeteghem');
        $person->setpersonProfile('admin');
        $person->setaddress($address);

        $role = new Roles();
        //$role->setroleId('1');
        $role->setroleName('Student');

        $user = new Users();
        $user->setuserId('1');
        $user->setusername('admin');
        $user->setpassword($this->encodePassword($user, 'user'));
        //$user->setsalt('admin');
        $user->setuserEmail('gilles.vanpeteghem@gmail.com');
        $user->setuserRating('1');
        $user->setperson($person);
        $user->setroles($role);
        //$userAdmin->setlanguage($language);

        //$manager = $this->getDoctrine()->getManager();
        //$manager->persist($language);
        $manager->persist($user);
        $manager->persist($region);
        $manager->persist($address);
        $manager->persist($person);
        $manager->persist($role);

        $manager->flush();



        //$userAdmin->setuserCreated('');
        //$userAdmin->setuserModified('');
        //$userAdmin->setuserDeleted('');
        //$userAdmin->setuserLastlogin('');
        //$userAdmin->setuserLocked('');




        //$manager->persist($person);
        //$manager->persist($userAdmin);
        //$userAdmin->setlanguage('');
        //$userAdmin->setrole('');
        //$userAdmin->setuserPassword('test');


        //$manager->flush();
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