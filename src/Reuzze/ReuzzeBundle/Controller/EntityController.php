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
        // AUTHORIZATION
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories')
            ->findAll();

        $entity = new Entities();

        $form = $this->createForm(new EntityType($this->getDoctrine()->getEntityManager()), $entity);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            $data = $form->getData();

            if($form->isValid())
            {
                $data = $form->getData();

                $categoryid = $data->getCategory()->getCategoryName();
                $category = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories')->findOneByCategoryId($categoryid);
                $entity->setCategory($category);

                $user = $this->get('security.context')->getToken()->getUser();
                $entity->setUser($user);

                $region = $entityManager->getRepository('ReuzzeReuzzeBundle:Regions')->findOneByRegionId($user->getPerson()->getAddress()->getRegion());
                $entity->setRegion($region);

                $starttime = $data->getentityStarttime();
                $endtime = $data->getentityEndtime();

                $entity->setEntityStarttime(new \DateTime($starttime));
                $entity->setEntityEndtime(new \DateTime($endtime));

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
