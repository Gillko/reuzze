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


                $data = $form->getData();
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

    public function showAction($entity_id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories')
            ->findAll();

        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities')->find($entity_id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entity entity.');
        }

        return $this->render('ReuzzeReuzzeBundle:Entity:show.html.twig', array(
            'entity'      => $entity,
            'categories' => $categories,
        ));
    }
}
