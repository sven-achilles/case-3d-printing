<?php
namespace App\Controller;

use App\Repository\PrintOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prints")
 */
class UserPrintsController extends AbstractController
{
    private $orderRepository;

    public function __construct( PrintOrderRepository $orderRepository )
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @Route("/", name="user_prints_index")
     */
    public function index()
    {
        $orders = $this->orderRepository->findAll();

        return $this->render('user-prints/index.html.twig', [
            'orders' => $orders
        ]);
    }
}