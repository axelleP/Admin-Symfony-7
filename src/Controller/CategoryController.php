<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\CategoryCollectionType;

#[Route('/admin/category')]
class CategoryController extends AbstractController
{
    #[Route('/list', name: 'app_category_list', methods: ['GET', 'POST'])]
    public function list(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $categoryRepository->getCategoryPaginator($offset);

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lastCategory = $categoryRepository->getLastCategory();
            $category->setPosition($lastCategory->getPosition() + 1 ?? 1);
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('app_category_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category/list.html.twig', [
            'categories' => $paginator,
            'form' => $form,
            'previous' => $offset - CategoryRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CategoryRepository::PAGINATOR_PER_PAGE),
            'currentPage' => ($offset / CategoryRepository::PAGINATOR_PER_PAGE) + 1
        ]);
    }

    #[Route('/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryCollectionType::class, ['categories' => $categoryRepository->findAll()], ['context' => 'update']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()['categories'] as $categorie) {
                $entityManager->persist($categorie);
            }
            $entityManager->flush();
            return $this->redirectToRoute('app_category_list', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('category/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id<\d+>}', name: 'app_category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_category_list', [], Response::HTTP_SEE_OTHER);
    }
}
