<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function registerAction()//$name)
    {
        //return $this->render('ReuzzeReuzzeBundle:Default:index.html.twig', array('name' => $name));

        return $this->render('ReuzzeReuzzeBundle:User:register.html.twig');
    }

    public function loginAction()
    {

        return $this->render('ReuzzeReuzzeBundle:User:login.html.twig');
    }
}
