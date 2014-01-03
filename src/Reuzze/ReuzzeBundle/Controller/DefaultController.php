<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function homeAction()//$name)
    {
        //return $this->render('ReuzzeReuzzeBundle:Default:index.html.twig', array('name' => $name));

        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories')
            ->findAll();

        return $this->render('ReuzzeReuzzeBundle:Default:home.html.twig', array(
            'categories' => $categories,
        ));
    }
}
