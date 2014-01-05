<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Reuzze\ReuzzeBundle\Entity\Categories;
use Reuzze\ReuzzeBundle\Entity\Users;
use Reuzze\ReuzzeBundle\Entity\Persons;
use Reuzze\ReuzzeBundle\Entity\Addresses;
use Reuzze\ReuzzeBundle\Entity\Entities;
use Reuzze\ReuzzeBundle\Entity\Bids;

use Reuzze\ReuzzeBundle\Form\Type\EntityType;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories')
            ->findAll();

        return $this->render('ReuzzeReuzzeBundle:Category:index.html.twig', array(
            'categories' => $categories,
        ));
    }

    public function entitiesAction($category_id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $category = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories')->find($category_id);
        $entities = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities');

        $query = $entities->createQueryBuilder('e')
            ->where('e.category = :pcategory')
            ->setParameter('pcategory', $category)
            ->orderBy('e.entityId', 'DESC')
            ->getQuery();

        $entities = $query->getResult();

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

        $images = array();
        $im = array();

        foreach($entities as $entity){
            $media = $entityManager->getRepository('ReuzzeReuzzeBundle:Media')->findByEntity($entity);
            foreach($media as $image){
                $im[] = $image->getmediumUrl();
            }

            $images[$entity->getEntityId()] = $im;
            $im = array();
        }

        return $this->render('ReuzzeReuzzeBundle:Category:entities.html.twig', array(
            'entities'        => $entities,
            'categories'    => $category_choices,
            'images'     => $images
        ));
    }
}
