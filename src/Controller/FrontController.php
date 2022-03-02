<?php

namespace App\Controller;

use App\Repository\BouleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(BouleRepository $bouleRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'boules' => $bouleRepository->findAll()
        ]);
    }
    #[Route('produit/boule/{id}', name: 'produit_boule_id')]
    public function produit_boule_id($id, BouleRepository $bouleRepository )
    {
        return $this->render('front/produit.html.twig',[
            'boule' => $bouleRepository->find($id),
            'boules' => $bouleRepository->findAll()
        ]);
    }

}
