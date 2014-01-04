<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Reuzze\ReuzzeBundle\Entity\Entities;

use Reuzze\ReuzzeBundle\Form\Type\EntityType;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Request;

class EntityController extends Controller
{
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entities = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities')
            ->findAll();

        return $this->render('ReuzzeReuzzeBundle:Entity:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function createAction(Request $request)
    {
        // AUTHORIZATION
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories')
            ->findAll();

        $entity = new Entities();

        $form = $this->createForm(new EntityType(), $entity);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if($form->isValid())
            {
                //$data = $form->getData();
                $entity->setUser($this->get('security.context')->getToken()->getUser());
                $date = new \DateTime('NOW');
                $entity->setentityCreated($date);

                $entityManager->persist($entity);

                $entityManager->flush();

                return $this->redirect($this->generateUrl('reuzze_reuzze_homepage'));
            }
        }

        return $this->render('ReuzzeReuzzeBundle:Entity:create.html.twig', array(
            'form' => $form->createView(),
            'categories' => $categories,
        ));
    }
}
