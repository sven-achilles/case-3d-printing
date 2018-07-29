<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prints")
 */
class UserPrintsController extends AbstractController
{
    /**
     * @Route("/", name="user-prints-index")
     */
    public function index()
    {
        return $this->render('user-prints/index.html.twig');
    }
}