<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Reuzze\ReuzzeBundle\Entity\Entities;
use Reuzze\ReuzzeBundle\Entity\Users;
use Reuzze\ReuzzeBundle\Entity\Persons;
use Reuzze\ReuzzeBundle\Entity\Addresses;

use Reuzze\ReuzzeBundle\Form\Type\EntityType;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Request;

class EntityController extends Controller
{
    public function indexAction()
    {
        return $this->render('ReuzzeReuzzeBundle:Entity:create.html.twig');
    }

    public function createAction(Request $request)
    {
        //return $this->render('ReuzzeReuzzeBundle:Default:index.html.twig', array('name' => $name));
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $entity = new Entities();

        $user = new Users();
        $person = new Persons();
        $address = new Addresses();

        $entity->setUser($this->get('security.context')->getToken()->getUser());

        \Doctrine\Common\Util\Debug::dump($entity->setRegion($user->getPerson()));//->getAddress()->getRegion());

        //$entity->setRegion($user->getPerson($person)->getAddress($address)->getRegion());

        //$entity->setRegion($address->getRegion());

        //$user = new Users();

        //$entity->setUserId($user);

        $form = $this->createForm(new EntityType(), $entity);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if($form->isValid())
            {
                $date = new \DateTime('NOW');
                $entity->setentityCreated($date);

                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->persist($entity);

                $entityManager->flush();

                return $this->redirect($this->generateUrl('reuzze_reuzze_homepage'));
            }
        }

        return $this->render('ReuzzeReuzzeBundle:Entity:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
