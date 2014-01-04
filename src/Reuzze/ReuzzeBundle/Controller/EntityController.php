<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Proxies\__CG__\Reuzze\ReuzzeBundle\Entity\Favorites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Reuzze\ReuzzeBundle\Entity\Entities;
use Reuzze\ReuzzeBundle\Entity\Bids;

use Reuzze\ReuzzeBundle\Form\Type\EntityType;
use Reuzze\ReuzzeBundle\Form\Type\BidType;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Request;

class EntityController extends Controller
{
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories');

        $query = $repository->createQueryBuilder('c')
            ->where('c.categoryParentid IS NULL')
            ->orderBy('c.categoryId', 'ASC')
            ->getQuery();

        $parentcategories = $query->getResult();
        foreach($parentcategories as $pcategory)
        {
            $cname = $pcategory->getcategoryName();

            $query = $repository->createQueryBuilder('c')
                ->where('c.categoryParentid = :pcategory')
                ->setParameter('pcategory', $pcategory->getcategoryId())
                ->orderBy('c.categoryId', 'ASC')
                ->getQuery();

            $childcategories = $query->getResult();
            foreach($childcategories as $ccategory){
                $category_choices[$cname][$ccategory->getcategoryId()] = $ccategory->getcategoryName();
            }
        }

        $entities = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities')
            ->findAll();

        return $this->render('ReuzzeReuzzeBundle:Entity:index.html.twig', array(
            'entities' => $entities,
            'categories' => $category_choices,
        ));
    }

    public function createAction(Request $request)
    {
        // AUTHORIZATION
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories');

        $query = $repository->createQueryBuilder('c')
            ->where('c.categoryParentid IS NULL')
            ->orderBy('c.categoryId', 'ASC')
            ->getQuery();

        $parentcategories = $query->getResult();
        foreach($parentcategories as $pcategory)
        {
            $cname = $pcategory->getcategoryName();

            $query = $repository->createQueryBuilder('c')
                ->where('c.categoryParentid = :pcategory')
                ->setParameter('pcategory', $pcategory->getcategoryId())
                ->orderBy('c.categoryId', 'ASC')
                ->getQuery();

            $childcategories = $query->getResult();
            foreach($childcategories as $ccategory){
                $category_choices[$cname][$ccategory->getcategoryId()] = $ccategory->getcategoryName();
            }
        }

        $entity = new Entities();

        $form = $this->createForm(new EntityType($this->getDoctrine()->getEntityManager()), $entity);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            $data = $form->getData();


            if($form->isValid())
            {
                $data = $form->getData();

                $files = $request->files->get('files');
                var_dump($files);
                die();

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

                $entity->setUser($user);

                $date = new \DateTime('NOW');
                $entity->setentityCreated($date);

                $entityManager->persist($entity);

                $entityManager->flush();

                return $this->redirect($this->generateUrl('reuzze_reuzze_homepage'));
            }
        }

        return $this->render('ReuzzeReuzzeBundle:Entity:create.html.twig', array(
            'form' => $form->createView(),
            'categories' => $category_choices,
        ));
    }

    public function showAction($entity_id, Request $request)
    {
        // AUTHORIZATION
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();

        $repository = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories');

        $query = $repository->createQueryBuilder('c')
            ->where('c.categoryParentid IS NULL')
            ->orderBy('c.categoryId', 'ASC')
            ->getQuery();

        $parentcategories = $query->getResult();
        foreach($parentcategories as $pcategory)
        {
            $cname = $pcategory->getcategoryName();

            $query = $repository->createQueryBuilder('c')
                ->where('c.categoryParentid = :pcategory')
                ->setParameter('pcategory', $pcategory->getcategoryId())
                ->orderBy('c.categoryId', 'ASC')
                ->getQuery();

            $childcategories = $query->getResult();
            foreach($childcategories as $ccategory){
                $category_choices[$cname][$ccategory->getcategoryId()] = $ccategory->getcategoryName();
            }
        }

        $entity = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities')->find($entity_id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entity entity.');
        }

        $bids = $entityManager->getRepository('ReuzzeReuzzeBundle:Bids')->findByEntity($entity);

        $user = $this->get('security.context')->getToken()->getUser();

        $bid = new Bids();
        $bid->setEntity($entity);
        $bid->setUser($user);

        $form = $this->createForm(new BidType($this->getDoctrine()->getEntityManager()), $bid);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if($form->isValid())
            {
                $data = $form->getData();

                $date = new \DateTime('now');
                $bid->setBidDate($date);

                $entityManager->persist($bid);

                $entityManager->flush();

                return $this->redirect($this->generateUrl('reuzze_reuzze_homepage'));
            }
        }

        return $this->render('ReuzzeReuzzeBundle:Entity:show.html.twig', array(
            'form'          => $form->createView(),
            'entity'        => $entity,
            'bids'          => $bids,
            'categories'    => $category_choices
        ));
    }
}
