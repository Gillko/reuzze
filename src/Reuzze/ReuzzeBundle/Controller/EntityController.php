<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Proxies\__CG__\Reuzze\ReuzzeBundle\Entity\Favorites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Reuzze\ReuzzeBundle\Entity\Entities;
use Reuzze\ReuzzeBundle\Entity\Bids;
use Reuzze\ReuzzeBundle\Entity\Media;

use Reuzze\ReuzzeBundle\Form\Type\EntityType;
use Reuzze\ReuzzeBundle\Form\Type\BidType;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

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

        $entities = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities');


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

        $form = $this->createForm(new EntityType($this->getDoctrine()->getManager()), $entity);

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

                $entity->setUser($user);

                $date = new \DateTime('NOW');
                $entity->setentityCreated($date);

                $entityManager->persist($entity);

                $files = $request;
                $files = $files->request->get('myFiles');
                $parts = explode(',', $files);
                unset($parts[count($parts)-1]);
                for($i = 0; $i < count($parts); $i++){
                    if($i % 2 != 0){
                        $media = new Media();
                        $media->setEntity($entity);
                        $media->setMediumUrl($parts[$i-1]);
                        $media->setMediumType('i');
                        $media->setMediumMimetype($parts[$i]);
                        $entityManager->persist($media);
                    }
                }

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

        $favorite = $entityManager->getRepository('ReuzzeReuzzeBundle:Favorites');
        $query = $favorite->createQueryBuilder('f')
            ->where('f.user = :puser')
            ->andWhere('f.entity = :pentity')
            ->setParameter('puser', $user)
            ->setParameter('pentity', $entity)
            ->getQuery();

        $array = $query->getResult();

        $media = $entityManager->getRepository('ReuzzeReuzzeBundle:Media')->findByEntity($entity);

        if(sizeof($array) > 0){
            $favorite = "true";
        }
        else{
            $favorite = "false";
        }

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
            'categories'    => $category_choices,
            'favorite'      => $favorite,
            'media'         => $media
        ));
    }

    public function addtofavoritesAction($entity_id)
    {
        try{
            $entityManager = $this->getDoctrine()->getManager();

            $entity = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities')->find($entity_id);
            $user = $this->get('security.context')->getToken()->getUser();

            $favorite = new Favorites();
            $favorite->setEntity($entity);
            $favorite->setUser($user);

            $entityManager->persist($favorite);

            $entityManager->flush();

            $response = array("code" => 100, "success" => true);

            return new Response(json_encode($response));
        }
        catch(Exception $e){
            $response = array("code" => 500, "success" => false);
            return new Response(json_encode($response));

        }
    }

    public function removefromfavoritesAction($entity_id)
    {
        try{

            $entityManager = $this->getDoctrine()->getManager();

            $entity = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities')->find($entity_id);
            $user = $this->get('security.context')->getToken()->getUser();

            $repository = $entityManager->getRepository('ReuzzeReuzzeBundle:Favorites');

            $query = $repository->createQueryBuilder('f')
                ->where('f.user = :puser')
                ->andWhere('f.entity = :pentity')
                ->setParameter('puser', $user)
                ->setParameter('pentity', $entity)
                ->setMaxResults(1)
                ->getQuery();

            $favorite = $query->getResult()[0];

            $entityManager->remove($favorite);

            $entityManager->flush();

            $response = array("code" => 100, "success" => true);

            return new Response(json_encode($response));
        }
        catch(Exception $e){
            $response = array("code" => 500, "success" => false);
            return new Response(json_encode($response));

        }
    }
}
