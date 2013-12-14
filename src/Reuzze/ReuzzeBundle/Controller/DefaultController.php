<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homeAction()//$name)
    {
        //return $this->render('ReuzzeReuzzeBundle:Default:index.html.twig', array('name' => $name));

        return $this->render('ReuzzeReuzzeBundle:Default:home.html.twig');
    }
}
