<?php
namespace App\Controller;

use App\Entity\PrintOrder;
use App\Form\PrintOrderType;
use App\Repository\PrintOrderRepository;
use App\Service\DesignUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/prints")
 */
class PrintOrderController extends AbstractController
{
    /**
     * @var PrintOrderRepository
     */
    private $orderRepository;

    /**
     * @var EntityManagerInterface
     */
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
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->findBy( [], [ 'createDate' => 'DESC' ] );

        return $this->render('print-orders/index.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/create", name="print_order_create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create( Request $request, DesignUploader $designUploader )
    {
        $print = new PrintOrder();
        $form  = $this->createForm( PrintOrderType::class, $print, [ 'validation_groups' => 'creation'] );

        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() )
        {
            $print->setCreateDate( new \DateTime() );
            $print->setUser( $this->getUser() );
            $print->setDesign( $designUploader->upload( $print->getDesign(), 'stl' ) );

            $this->entityManager->persist( $print );
            $this->entityManager->flush();

            $this->addFlash('success', '3D Print was successfully created!');

            return $this->redirectToRoute( 'print_order_index' );
        }

        return $this->render( 'print-orders/add.html.twig', [
            'form' => $form->createView()
        ] );
    }

    /**
     * @Route("/edit/{id}", name="print_order_edit")
     *
     * @param PrintOrder $print
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit( PrintOrder $print, Request $request, DesignUploader $designUploader )
    {
        $this->denyAccessUnlessGranted( 'edit', $print );

        $old_design_filename = $print->getDesign();

        // convert design filename into File object to populate init value of Form
        $print->setDesign( new File( $this->getParameter('designs_directory') . '/' . $old_design_filename ) );

        $form = $this->createForm( PrintOrderType::class, $print );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() )
        {
            if( !is_null( $print->getDesign() ) )
            {
                $this->deletePrint3DFile( $old_design_filename );

                $print->setDesign( $designUploader->upload( $print->getDesign(), 'stl' ) );
            }
            else
            {
                $print->setDesign( $old_design_filename );
            }

            $this->entityManager->persist( $print );
            $this->entityManager->flush();

            $this->addFlash('success', 'Print was successfully changed');

            return $this->redirectToRoute( 'print_order_index' );
        }

        return $this->render( 'print-orders/edit.html.twig', [
            'form' => $form->createView()
        ] );
    }

    /**
     * @Route("/delete/{id}", name="print_order_delete")
     *
     * @param PrintOrder $print
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete( PrintOrder $print )
    {
        $this->denyAccessUnlessGranted( 'delete', $print );

        $this->deletePrint3DFile( $print->getDesign() );
        $this->entityManager->remove( $print );
        $this->entityManager->flush();

        $this->addFlash('notice', 'Print was successfully deleted');

        return $this->redirectToRoute('print_order_index' );
    }

    private function deletePrint3DFile( $file_name )
    {
        @unlink( $this->getParameter('designs_directory') . '/' . $file_name );
    }
}