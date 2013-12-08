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
        $language->setlanguageName('test');

        $region = new Regions();
        //$region->setregionId('1');
        $region->setregionName('test');

        $adress = new Addresses();
        //$adress->setadressId('1');
        $adress->setaddressStreet('test');
        $adress->setaddressCity('test');
        $adress->setaddressLat('1');
        $adress->setaddressLon('1');
        $adress->setaddressStreetNr('1');
        $adress->setregion($region, 1);

        $person = new Persons();
        //$person->setperson('1');
        $person->setpersonFirstname('test');
        $person->setpersonSurname('test');
        $person->setpersonProfile('test');
        $person->setaddress($adress, 1);


        $userAdmin = new Users();
        $userAdmin->setuserId('1');
        $userAdmin->setuserUsername('admin');
        $userAdmin->setuserEmail('admin@gmail.com');
        $userAdmin->setuserRating('1');
        $userAdmin->setperson($person, 1);
        $userAdmin->setlanguage($language, 1);

        //$manager = $this->getDoctrine()->getManager();
        $manager->persist($language);
        $manager->persist($region);
        $manager->persist($adress);
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