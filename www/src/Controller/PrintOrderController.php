<?php
namespace App\Controller;

use App\Entity\PrintOrder;
use App\Form\PrintOrderType;
use App\Repository\PrintOrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/prints")
 */
class PrintOrderController extends AbstractController
{
    private $orderRepository;
    private $entityManager;

    /**
     * @param PrintOrderRepository   $orderRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        PrintOrderRepository $orderRepository,
        EntityManagerInterface $entityManager )
    {
        $this->orderRepository = $orderRepository;
        $this->entityManager   = $entityManager;
    }

    /**
     * @Route("/", name="print_order_index")
     */
    public function index()
    {
        $orders = $this->orderRepository->findAll();

        return $this->render('print-orders/index.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/create", name="print_order_create")
     * @param Request $request
     * @return mixed
     */
    public function create( Request $request )
    {
        $print = new PrintOrder();

        $form = $this->createForm( PrintOrderType::class, $print );

        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() )
        {
            $print->setCreateDate( new \DateTime() );
            $print->setUser( $this->getUser() );

            $this->entityManager->persist( $print );
            $this->entityManager->flush();

            return $this->redirectToRoute( 'print_order_index' );
        }

        return $this->render( 'print-orders/add.html.twig', [
            'form' => $form->createView()
        ] );
    }
}