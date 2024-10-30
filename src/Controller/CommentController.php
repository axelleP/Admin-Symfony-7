<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Comment;
use App\Repository\CommentRepository;

#[Route('/comment')]
class CommentController extends AbstractController
{
    #[Route('/list', name: 'app_comment_list')]
    public function list(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/list.html.twig', [
            'appName' => $_ENV["APP_NAME"],
            'comments' => $commentRepository->findAll()
        ]);
    }

    #[Route('/show/{id<\d+>}', name: 'app_comment_show')]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    #[Route('/delete/{id<\d+>}', name: 'app_comment_delete', methods: ['POST'])]
    public function delete(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_comment_list', [], Response::HTTP_SEE_OTHER);
    }
}
