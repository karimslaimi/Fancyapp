<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotPasswordType;
use App\Form\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


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
    public function forgotPassword(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ForgotPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();

            $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
                $token = md5(uniqid());
                $user->setToken($token);

                $this->em->persist($user);
                $this->em->flush();

                $email = (new Email())
                    ->from('trizouni1@gmail.com')
                    ->to($email)
                    //->cc('cc@example.com')
                    //->bcc('bcc@example.com')
                    //->replyTo('fabien@example.com')
                    //->priority(Email::PRIORITY_HIGH)
                    ->subject('Reset your password')
                    ->text("localhost:8000/reset-password/" . $token);

                try {
                    $transport = Transport::fromDsn("smtp://trizouni1@gmail.com:bnhtqhxtnvjfhcdx@smtp.gmail.com:587");
                    $mail=new Mailer($transport);
                    $mail->send($email);
                } catch (TransportExceptionInterface $e) {
                    echo $e;
                }


                $this->addFlash('success', 'Check your email for a reset password link.');

                return $this->redirectToRoute('forgot_password');
            } else {
                $this->addFlash('error', 'Invalid email address.');
            }
        }

        return $this->render('security/forgot_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/reset-password/{token}', name: 'reset_password')]
    public function resetPassword(Request $request, UserPasswordHasherInterface $passwordEncoder, $token)
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['token' => $token]);

        if (!$user) {
            throw $this->createNotFoundException('Invalid token.');
        }

        $form = $this->createForm(ResetPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordEncoder->hashPassword($user, $form->get('password')->getData()));
            $user->setToken(null);
            $this->em->flush();
            $this->addFlash('success', 'Your password has been reset.');

            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/reset_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
