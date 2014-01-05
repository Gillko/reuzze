<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function homeAction()//$name)
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
        $query = $entities->createQueryBuilder('p')
            ->orderBy('p.entityId', 'DESC')
            ->setMaxResults(5)
            ->getQuery();

        $entities = $query->getResult();

        return $this->render('ReuzzeReuzzeBundle:Default:home.html.twig', array(
            'entities'  => $entities,
            'categories' => $category_choices,
        ));
    }
}
