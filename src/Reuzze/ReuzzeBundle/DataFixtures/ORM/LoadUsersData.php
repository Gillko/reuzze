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

class LoadUsersData implements FixtureInterface
{
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

        $language = new Languages();
        $language->setlanguageName('nederlands');

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


        $userAdmin = new Users();
        $userAdmin->setuserId('1');
        $userAdmin->setuserUsername('admin');
        $userAdmin->setuserEmail('gilles.vanpeteghem@gmail.com');
        $userAdmin->setuserRating('1');
        $userAdmin->setperson($person);
        $userAdmin->setlanguage($language);

        //$manager = $this->getDoctrine()->getManager();
        $manager->persist($language);
        $manager->persist($region);
        $manager->persist($address);
        $manager->persist($person);
        $manager->persist($userAdmin);
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
}