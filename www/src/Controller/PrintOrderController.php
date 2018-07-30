<?php
namespace App\Controller;

use App\Entity\PrintOrder;
use App\Form\PrintOrderType;
use App\Repository\PrintOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prints")
 */
class PrintOrderController extends AbstractController
{
    private $orderRepository;

    public function __construct( PrintOrderRepository $orderRepository )
    {
        $this->orderRepository = $orderRepository;
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
     */
    public function create()
    {
        $print = new PrintOrder();

        $form = $this->createForm( PrintOrderType::class, $print );

        return $this->render( 'print-orders/add.html.twig', [
            'form' => $form->createView()
        ] );
    }
}