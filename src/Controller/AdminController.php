<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function PHPUnit\Framework\isEmpty;


class AdminController extends AbstractController
{
    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/users', name: 'app_user')]
    public function index(): Response
    {
        $user = $this->em->getRepository(User::class)->findAll();
        return $this->render('users/index.html.twig', [
            'u' => $user
        ]);
    }

    #[Route('/addUser', name: 'app_User')]
    public function addUser(UserRepository $r, UserPasswordHasherInterface $password_encoder, EntityManagerInterface $em, Request $request)

    {
        $user = new user();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        $user->setRoles('ROLE_USER');

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $password_encoder->hashPassword($user,
                $request->request->get('user')['password']['first']);
            $user->setPassword($password);
            $user->setEnabled(true);
            $em->persist($user); //add
            $em->flush();
            return $this->redirectToRoute("app_user");
        }
        return $this->render('users/createUser.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/removeUser/{id}', name: 'supp_User')]
    public function suppressionUser($id, UserRepository $r, ManagerRegistry $doctrine): Response
    {
        $user = $r->find($id);
        if ($user != null){
            $this->em->remove($user);
            $this->em->flush();
        }

        return $this->redirectToRoute('app_user');

    }

    #[Route('/modifUser/{id}', name: 'modifUser')]
    public function modifUserr($id, UserRepository $r, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->em->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (empty($user->getPassword())){
                $us = $r->find($user->getId());
                $us->setPassword($user->getPassword());
            } else{
                $password = $passwordHasher->hashPassword($user,
                    $request->request->get('user')['password']['first']);
                $user->setPassword($password);
            }

            $this->em->flush();
            return $this->redirectToRoute("app_user");
        }
        return $this->render('users/updateUser.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/admin', name: 'app_admin')]
    public function indexAdmin(): Response
    {
        // $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        return $this->render('admin/dashboard.html.twig', [
            //'u'=>$user
        ]);
    }

    #[Route('/client', name: 'app_client')]
    public function indexClient(): Response
    {
        return $this->render('Client/index.html.twig', [

        ]);
    }

    #[Route('/ban/{id}', name: 'app_admin_banuser')]
    public function banUser(int $id,UserRepository $r){
        $user = $r->find($id);
        if ($user != null ){
            $user->setEnabled(!$user->isEnabled());
            $this->em->flush();
        }
        return $this->redirectToRoute("app_user");
    }

    #[Route('/detailUsr/{id}/{email}/{name}', name: 'app_detailUsr')]
    public function detailFormation($id, $email, $name): Response
    {
        return $this->render('/users/detailUsr.html.twig', [
            'i' => $id, 'e' => $email, 'n' => $name]);
    }

    #[Route('/profilAD', name: 'profilAD')]
    public function profilAD(UserRepository $r, ManagerRegistry $doctrine, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("profilAD");
        }
        return $this->render('admin/profilAD.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profilUS', name: 'app_profilUS')]
    public function profilUS(UserRepository $r, ManagerRegistry $doctrine, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("app_profilUS");
        }
        return $this->render('Client/profilUS.html.twig', [
            'f' => $form->createView(),
        ]);
    }

    #[Route('/categorie', name: 'app_categorie')]
    public function Client(): Response
    {
        return $this->render('users/index.html.twig', [

        ]);
    }

    #[Route('/post', name: 'app_post')]
    public function indeClient(): Response
    {
        return $this->render('Client/index.html.twig', [

        ]);
    }

    #[Route('/echanges', name: 'app_echanges')]
    public function indexClint(): Response
    {
        return $this->render('Client/index.html.twig', [

        ]);
    }

    #[Route('/forum', name: 'app_forum')]
    public function indxClient(): Response
    {
        return $this->render('Client/index.html.twig', [

        ]);
    }

    #[Route('/evenement', name: 'app_evenement')]
    public function ndexClient(): Response
    {
        return $this->render('Client/index.html.twig', [

        ]);
    }


}
