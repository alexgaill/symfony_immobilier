<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\PropertyRepository;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repo): Response
    {
        $properties = $repo->findLatest();

        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
    }

}


 ?>
