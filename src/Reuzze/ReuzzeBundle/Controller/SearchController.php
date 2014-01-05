<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Reuzze\ReuzzeBundle\Entity\Categories;
use Reuzze\ReuzzeBundle\Entity\Users;
use Reuzze\ReuzzeBundle\Entity\Persons;
use Reuzze\ReuzzeBundle\Entity\Addresses;
use Reuzze\ReuzzeBundle\Entity\Entities;
use Reuzze\ReuzzeBundle\Entity\Bids;

use Reuzze\ReuzzeBundle\Form\Type\SearchType;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function indexAction(Request $request)
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

        $entity = new Entities();

        $form = $this->createForm(new SearchType($this->getDoctrine()->getManager()), $entity);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            $data = $form->getData();

            if($form->isValid())
            {
                $data = $form->getData();

                $searchterm = $data->getEntityTitle();
                $regionid = $data->getRegion()->getRegionName()->getRegionId();
                $categoryid = $data->getCategory()->getCategoryName();


                return $this->redirect($this->generateUrl('reuzze_reuzze_entitiesfromsearchpage', array('entity_title' => $searchterm,
                    'category_id' => $categoryid, 'region_id' => $regionid)));
            }
        }

        return $this->render('ReuzzeReuzzeBundle:Search:index.html.twig', array(
            'form' => $form->createView(),
            'categories' => $category_choices,
        ));
    }

    public function entitiesfromsearchAction($entity_title, $category_id, $region_id)
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

        $repository = $entityManager->getRepository('ReuzzeReuzzeBundle:Entities');
        $category = $entityManager->getRepository('ReuzzeReuzzeBundle:Categories')->findOneByCategoryId($category_id);
        $region = $entityManager->getRepository('ReuzzeReuzzeBundle:Regions')->findOneByRegionId($region_id);

        $query = $repository->createQueryBuilder('e')
            ->where('e.category = :pcategory')
            ->andWhere('e.region = :pregion')
            ->andWhere('e.entityTitle LIKE :ptitle')
            ->setParameter('pcategory', $category)
            ->setParameter('pregion', $region)
            ->setParameter('ptitle', '%' . $entity_title . '%')
            ->orderBy('e.entityId', 'DESC')
            ->getQuery();

        $entities = $query->getResult();


        return $this->render('ReuzzeReuzzeBundle:Search:entitiesfromsearch.html.twig', array(
            'categories' => $category_choices,
            'entities'   => $entities
        ));
    }

}
