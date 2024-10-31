<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Page;
use App\Repository\PageRepository;
use App\Form\PageType;

#[Route('/general-page')]
class GeneralPageController extends AbstractController
{
    #[Route('/list', name: 'app_general_page_list')]
    public function list(PageRepository $pageRepository): Response
    {
        return $this->render('generalPage/list.html.twig', [
            'pages' => $pageRepository->findAll()
        ]);
    }

    #[Route('/show/{id<\d+>}', name: 'app_general_page_show')]
    public function show(Page $page): Response
    {
        return $this->render('generalPage/show.html.twig', [
            'page' => $page,
        ]);
    }

    #[Route('/edit/{id<\d+>}', name: 'app_general_page_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Page $page, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_general_page_show', ['id' => $page->getId()], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('generalPage/edit.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }
}
