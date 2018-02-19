<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserTypeAdmin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class StudentController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function showAction(Request $request)
    {
        $characters = [
            'Uganda Knuckles' => 'Warrior',
            'This boi'         => 'Boii'
        ];

        return $this->render('index.html.twig', array('character' => $characters));
    }

    /**
     * @Route("/test_admin", name="none")
     */
    public function testadminAction(Request $request)
    {
        $characters = [
            'admin' => 'Uganda',
            'admin '=> 'Uganda'
        ];

        return $this->render('index.html.twig', array('character' => $characters));
    }

    /**
     * @Route("/dashboard")
     *
     */
    public function dashboardAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('App:User')->findAll();
        return $this->render('info.html.twig',
            ['users' => $users]);
    }

    /**
     * @Route("/edituser/{id}", name="user.edit")
     */
    public function editUserAction(Request $request,User $user){
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserTypeAdmin::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($user);
            $em->flush();
        }

        return $this->render('editUser.html.twig',[
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
