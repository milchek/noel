<?php

namespace App\Controller;

use App\Entity\Boule;
use App\Form\BouleType;
use App\Repository\BouleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/boule')]
class BouleController extends AbstractController
{
    #[Route('/', name: 'app_boule_index', methods: ['GET'])]
    public function index(BouleRepository $bouleRepository): Response
    {
        return $this->render('boule/index.html.twig', [
            'boules' => $bouleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_boule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BouleRepository $bouleRepository): Response
    {
        $boule = new Boule();
        $form = $this->createForm(BouleType::class, $boule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bouleRepository->add($boule);
            return $this->redirectToRoute('app_boule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('boule/new.html.twig', [
            'boule' => $boule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_boule_show', methods: ['GET'])]
    public function show(Boule $boule): Response
    {
        return $this->render('boule/show.html.twig', [
            'boule' => $boule,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_boule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Boule $boule, BouleRepository $bouleRepository): Response
    {
        $form = $this->createForm(BouleType::class, $boule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bouleRepository->add($boule);
            return $this->redirectToRoute('app_boule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('boule/edit.html.twig', [
            'boule' => $boule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_boule_delete', methods: ['POST'])]
    public function delete(Request $request, Boule $boule, BouleRepository $bouleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$boule->getId(), $request->request->get('_token'))) {
            $bouleRepository->remove($boule);
        }

        return $this->redirectToRoute('app_boule_index', [], Response::HTTP_SEE_OTHER);
    }
}
