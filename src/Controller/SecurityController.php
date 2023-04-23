<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/security', name: 'app_security')]
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout()
    {
        return $this->redirectToRoute('app_login');
    }

    #[Route(path: '/forgot-password', name: 'forgot_password')]

    public function forgotPassword(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ForgotPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();

            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
                $token = md5(uniqid());
                $user->setResetPasswordToken($token);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $message = (new \Swift_Message('Reset your password'))
                    ->setFrom('noreply@example.com')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                            'emails/reset_password.html.twig',
                            ['token' => $token]
                        ),
                        'text/html'
                    );

                $mailer->send($message);

                $this->addFlash('success', 'Check your email for a reset password link.');

                return $this->redirectToRoute('forgot_password');
            } else {
                $this->addFlash('error', 'Invalid email address.');
            }
        }

        return $this->render('forgot_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
