<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\SecurityContext;

use Reuzze\ReuzzeBundle\Form\Type\LoginType;
use Reuzze\ReuzzeBundle\Form\Type\RegisterType;
use Reuzze\ReuzzeBundle\Form\Type\AccountType;

use Reuzze\ReuzzeBundle\Entity\Users;
use Reuzze\ReuzzeBundle\Entity\Persons;
use Reuzze\ReuzzeBundle\Entity\Addresses;
use Reuzze\ReuzzeBundle\Entity\Regions;
use Reuzze\ReuzzeBundle\Entity\Roles;

class UserController extends Controller
{
    public function registerAction(Request $request)
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

        $user = new Users();

        $form = $this->createForm(new RegisterType(), $user);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if($form->isValid())
            {
                $data = $form->getData();

                $region = $entityManager->getRepository('ReuzzeReuzzeBundle:Regions')->find($data->getPerson()->getAddress()->getRegion()->getRegionName()->getRegionId());
                $address = $data->getPerson()->getAddress();
                $address->setAddressLat(floatval($data->getPerson()->getAddress()->getAddressLat()));
                $address->setAddressLon(floatval($data->getPerson()->getAddress()->getAddressLon()));
                $address->setRegion($region);
                $person = $data->getPerson();
                $person->setAddress($data->getPerson()->getAddress());
                $user->setPerson($data->getPerson());
                $user->setUserRating('10');

                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getpassword(), $user->getSalt());
                $user->setpassword($password);

                $role = $entityManager->getRepository('ReuzzeReuzzeBundle:Roles')->findOneBy(array('roleName' => 'Member'));
                $user->setRoles($role);

                $date = new \DateTime('NOW');
                $user->setuserCreated($date);

                $entityManager->persist($address);
                $entityManager->persist($person);
                $entityManager->persist($user);

                $entityManager->flush();

                return $this->redirect($this->generateUrl('reuzze_reuzze_homepage'));
            }
        }
        return $this->render('ReuzzeReuzzeBundle:User:register.html.twig', array(
            'form' => $form->createView(),
            'categories' => $category_choices,
        ));
    }

    public function loginAction(Request $request)
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

        $user = new Users();

        $form = $this->createForm(new LoginType(), $user);

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $session = $request->getSession();
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('ReuzzeReuzzeBundle:User:login.html.twig', array(
         'form' => $form->createView(),
         'error' => $error,
         'categories' => $category_choices,
        ));
    }

    public function loginCheckAction()
    {
        //
    }

    public function logoutAction()
    {
        //
    }

    public function editAction($user_id)
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

        $user = new Users();

        $user = $entityManager->getRepository('ReuzzeReuzzeBundle:Users')->find($user_id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $form = $this->createForm(new AccountType(), $user);

        return $this->render('ReuzzeReuzzeBundle:User:edit.html.twig', array(
            'form'   => $form->createView(),
            'categories' => $category_choices,
            'user'      => $user,
        ));
    }

    public function updateAction(Request $request, $user_id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository('ReuzzeReuzzeBundle:Users')->find($user_id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $form = $this->createForm(new AccountType(), $user);
        $form->bind($request);

        if ($form->isValid()) {

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getpassword(), $user->getsalt());
            $user->setpassword($password);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('reuzze_reuzze_homepage'));
        }

        return $this->render('ReuzzeReuzzeBundle:User:edit.html.twig', array(
            'form'   => $form->createView(),

        ));
    }

}
