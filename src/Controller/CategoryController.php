<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\CategoryRepository;
use App\Entity\Category;

#[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/list', name: 'app_category_list')]
    public function list(Request $request, CategoryRepository $categoryRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $categoryRepository->getCategoryPaginator($offset);

        return $this->render('category/list.html.twig', [
            'categories' => $paginator,
            'previous' => $offset - CategoryRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CategoryRepository::PAGINATOR_PER_PAGE),
            'currentPage' => ($offset / CategoryRepository::PAGINATOR_PER_PAGE) + 1
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
