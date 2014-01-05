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
use Reuzze\ReuzzeBundle\Entity\Categories;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadCategoriesData implements FixtureInterface, ContainerAwareInterface
{
    private $container;
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /* CATEGORIES Auto - Accessoires */
        $category = new Categories();
        $category1 = new Categories();
        $category2 = new Categories();
        $category3 = new Categories();

        $category->setCategoryName('Auto - Accessoires');
        $category->setCategoryDescription('Voertuigen');
        $category1->setCategoryName('Auto - Onderdelen & Wisselstuk')->setCategoryParentid($category);
        $category1->setCategoryDescription('Voertuigen');
        $category2->setCategoryName('Auto - Hifi & Navigatie')->setCategoryParentid($category);
        $category2->setCategoryDescription('Voertuigen');
        $category3->setCategoryName('Auto - Tuning & Styling')->setCategoryParentid($category);
        $category3->setCategoryDescription('Voertuigen');

        $manager->persist($category);
        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        /* END CATEGORIES Auto - Accessoires */

        /* CATEGORIES Beauty */
        $category4 = new Categories();
        $category5 = new Categories();
        $category6 = new Categories();
        $category7 = new Categories();
        $category8 = new Categories();

        $category4->setCategoryName('Beauty');
        $category4->setCategoryDescription('Beauty');
        $category5->setCategoryName('Make-up')->setCategoryParentid($category4);
        $category5->setCategoryDescription('Beauty');
        $category6->setCategoryName('Parfum')->setCategoryParentid($category4);
        $category6->setCategoryDescription('Beauty');
        $category7->setCategoryName('Gezondheid & Welzijn')->setCategoryParentid($category4);
        $category7->setCategoryDescription('Beauty');
        $category8->setCategoryName('Sieraden & Horloges')->setCategoryParentid($category4);
        $category8->setCategoryDescription('Beauty');

        $manager->persist($category4);
        $manager->persist($category5);
        $manager->persist($category6);
        $manager->persist($category7);
        $manager->persist($category8);
        /* END CATEGORIES Beauty */

        /* CATEGORIES Boeken, Films & Muziek */
        $category9 = new Categories();
        $category10 = new Categories();
        $category11 = new Categories();
        $category12  = new Categories();

        $category9->setCategoryName('Boeken, Films & Muziek');
        $category9->setCategoryDescription('Boeken, Films & Muziek');
        $category10->setCategoryName('Boeken & Strips')->setCategoryParentid($category9);
        $category10->setCategoryDescription('Boeken, Films & Muziek');
        $category11->setCategoryName('Dvd, Video & Films')->setCategoryParentid($category9);
        $category11->setCategoryDescription('Boeken, Films & Muziek');
        $category12->setCategoryName('Muziek & Instrumenten')->setCategoryParentid($category9);
        $category12->setCategoryDescription('Boeken, Films & Muziek');
        /* END CATEGORIES Boeken, Films & Muziek */

        /* CATEGORIES Elektronica */
        $category13  = new Categories();
        $category14  = new Categories();
        $category15  = new Categories();
        $category16  = new Categories();
        $category17  = new Categories();

        $category13->setCategoryName('Elektronica');
        $category13->setCategoryDescription('Elektronica');
        $category14->setCategoryName('Computers & Tablets')->setCategoryParentid($category13);
        $category14->setCategoryDescription('Elektronica');
        $category15->setCategoryName('Smartphones & Mobiele telefonie')->setCategoryParentid($category13);
        $category15->setCategoryDescription('Elektronica');
        $category16->setCategoryName('Tv, Audio & Video')->setCategoryParentid($category13);
        $category16->setCategoryDescription('Elektronica');
        $category17->setCategoryName('Fotografie & Cameras')->setCategoryParentid($category13);
        $category17->setCategoryDescription('Elektronica');

        $manager->persist($category9);
        $manager->persist($category10);
        $manager->persist($category11);
        $manager->persist($category12);
        $manager->persist($category13);
        $manager->persist($category14);
        $manager->persist($category15);
        $manager->persist($category16);
        $manager->persist($category17);
        /* END CATEGORIES Elektronica */

        /* CATEGORIES Huis & Tuin */
        $category18  = new Categories();
        $category19  = new Categories();
        $category20  = new Categories();
        $category21  = new Categories();

        $category18->setCategoryName('Huis & Tuin');
        $category18->setCategoryDescription('Huis & Tuin');
        $category19->setCategoryName('Meubels')->setCategoryParentid($category18);
        $category19->setCategoryDescription('Huis & Tuin');
        $category20->setCategoryName('Tuin & Terras')->setCategoryParentid($category18);
        $category20->setCategoryDescription('Huis & Tuin');
        $category21->setCategoryName('Woondecoratie & Design')->setCategoryParentid($category18);
        $category21->setCategoryDescription('Huis & Tuin');

        $manager->persist($category18);
        $manager->persist($category19);
        $manager->persist($category20);
        $manager->persist($category21);
        /* END CATEGORIES Huis & Tuin */

        /* CATEGORIES Mode */
        $category22  = new Categories();
        $category23  = new Categories();
        $category24  = new Categories();
        $category25  = new Categories();
        $category26  = new Categories();

        $category22->setCategoryName('Mode');
        $category22->setCategoryDescription('Mode');
        $category23->setCategoryName('Dameskleding')->setCategoryParentid($category22);
        $category23->setCategoryDescription('Mode');
        $category24->setCategoryName('Damesschoenen')->setCategoryParentid($category22);
        $category24->setCategoryDescription('Mode');
        $category25->setCategoryName('Herenkleding')->setCategoryParentid($category22);
        $category25->setCategoryDescription('Mode');
        $category26->setCategoryName('Kinderkleding meisjes')->setCategoryParentid($category22);
        $category26->setCategoryDescription('Mode');

        $manager->persist($category22);
        $manager->persist($category23);
        $manager->persist($category24);
        $manager->persist($category25);
        $manager->persist($category26);
        /* END CATEGORIES Mode */

        /* CATEGORIES Overige */
        $category27  = new Categories();
        $category28  = new Categories();
        $category29  = new Categories();

        $category27->setCategoryName('Overige');
        $category27->setCategoryDescription('Overige');
        $category28->setCategoryName('Bussiness')->setCategoryParentid($category27);
        $category28->setCategoryDescription('Overige');
        $category29->setCategoryName('Immobiliën')->setCategoryParentid($category27);
        $category29->setCategoryDescription('Overige');

        $manager->persist($category27);
        $manager->persist($category28);
        $manager->persist($category29);
        /* END CATEGORIES Overige */

        /* CATEGORIES Verzamelen */
        $category30  = new Categories();
        $category31  = new Categories();
        $category32  = new Categories();
        $category33  = new Categories();
        $category34  = new Categories();

        $category30->setCategoryName('Verzamelen');
        $category30->setCategoryDescription('Verzamelen');
        $category31->setCategoryName('Kunst & Antiek')->setCategoryParentid($category30);
        $category31->setCategoryDescription('Verzamelen');
        $category32->setCategoryName('Munten & Bankbiljetten')->setCategoryParentid($category30);
        $category32->setCategoryDescription('Verzamelen');
        $category33->setCategoryName('Postzegels')->setCategoryParentid($category30);
        $category33->setCategoryDescription('Verzamelen');
        $category34->setCategoryName('Verzamelen')->setCategoryParentid($category30);
        $category34->setCategoryDescription('Verzamelen');

        $manager->persist($category30);
        $manager->persist($category31);
        $manager->persist($category32);
        $manager->persist($category33);
        $manager->persist($category34);
        /* END CATEGORIES Verzamelen */

        /* CATEGORIES Vrije Tijd */
        $category35  = new Categories();
        $category36  = new Categories();
        $category37  = new Categories();
        $category38  = new Categories();
        $category39  = new Categories();

        $category35->setCategoryName('Vrije Tijd');
        $category35->setCategoryDescription('Vrije Tijd');
        $category36->setCategoryName('Doe-Het-Zelf & Hobby')->setCategoryParentid($category35);
        $category36->setCategoryDescription('Vrije Tijd');
        $category37->setCategoryName('Games & Consoles')->setCategoryParentid($category35);
        $category37->setCategoryDescription('Vrije Tijd');
        $category38->setCategoryName('Sport & Fietsen')->setCategoryParentid($category35);
        $category38->setCategoryDescription('Vrije Tijd');
        $category39->setCategoryName('Tickets & Reizen')->setCategoryParentid($category35);
        $category39->setCategoryDescription('Vrije Tijd');

        $manager->persist($category35);
        $manager->persist($category36);
        $manager->persist($category37);
        $manager->persist($category38);
        $manager->persist($category39);
        /* END CATEGORIES Vrije Tijd */

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