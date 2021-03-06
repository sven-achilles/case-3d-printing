<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct( EntityManagerInterface $entityManager )
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/register", name="user_register")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register( Request $request, UserPasswordEncoderInterface $passwordEncoder )
    {
        // TODO: this should be possible with route configuration..
        if( !is_null( $this->getUser() ) ) {
            return $this->redirectToRoute('print_order_index');
        }

        $user = new User();
        $form = $this->createForm( UserType::class, $user );

        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() )
        {
            $password = $passwordEncoder->encodePassword( $user, $user->getPlainPassword() );

            $user->setPassword($password);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}