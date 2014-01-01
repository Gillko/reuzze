<?php

namespace Reuzze\ReuzzeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\SecurityContext;

use Reuzze\ReuzzeBundle\Form\Type\LoginType;
use Reuzze\ReuzzeBundle\Form\Type\RegisterType;

use Reuzze\ReuzzeBundle\Entity\Users;
use Reuzze\ReuzzeBundle\Entity\Persons;
use Reuzze\ReuzzeBundle\Entity\Addresses;
use Reuzze\ReuzzeBundle\Entity\Regions;
use Reuzze\ReuzzeBundle\Entity\Roles;

class UserController extends Controller
{
    public function registerAction(Request $request){

        if ($this->get('security.context')->isGranted('ROLE_USER'))
        {
            return $this->redirect($this->generateUrl('reuzze_reuzze_homepage'));
        }

        $user = new Users();

        $person = new Persons();

        $address = new Addresses();

        $region = new Regions();

        $role = new Roles();

        //$region->setRegionName('Ghent');

        //$address->setAddressStreet('patijntjestraat');
        //$address->setAddressCity('Ghent');
        //$address->setAddressStreetnr('12');

        $address->setRegion($region);

        $user->setPerson($person);
        $user->setUserRating('1');
        $user->setRoles($role);

        $person->setAddress($address);

        $address->setRegion($region);

        $role->setRoleName('Student');

        $form = $this->createForm(new RegisterType(), $user);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if($form->isValid())
            {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getpassword(), $user->getsalt());
                $user->setpassword($password);

                /*$role = $this->getDoctrine()
                    ->getRepository('ReuzzeReuzzeBundle:Roles')
                    ->findOneBy(array ('roleId' => 1))
                ;*/

                $user->setRoles($role);

                $date = new \DateTime('NOW');
                //$user->setuserId('');
                $user->setuserCreated($date);

                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->persist($person);

                $entityManager->persist($user);
                $entityManager->persist($address);
                $entityManager->persist($region);

                $entityManager->persist($role);

                $entityManager->flush();

                return $this->redirect($this->generateUrl('reuzze_reuzze_homepage'));
            }
        }

            return $this->render('ReuzzeReuzzeBundle:User:register.html.twig', array(
                'form' => $form->createView()
            ));
    }

    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        //$user = new Users();

        //$form = $this->createForm(new LoginType(), $user);

        //if($form->isValid())
        //{
          //  return $this->redirect($this->generateUrl('reuzze_reuzze_homepage'));
        //}

        return $this->render('ReuzzeReuzzeBundle:User:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    public function loginCheckAction(){
        //return $this->render('ReuzzeReuzzeBundle:User:login_check.html.twig');
    }

    public function logoutAction(){

    }
}
