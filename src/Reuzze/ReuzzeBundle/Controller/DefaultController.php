<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homeAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories')
            ->findAll();

        $entities = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities')
            ->findAll();

        return $this->render('ReuzzeReuzzeBundle:Default:home.html.twig', array(
            'categories' => $categories,
            'entities' => $entities,
        ));
    }
}
