<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/comment')]
class CommentController extends AbstractController
{
    #[Route('/list', name: 'app_comment_list')]
    public function list(): Response
    {
        return $this->render('comment/list.html.twig', [
            'appName' => $_ENV["APP_NAME"]
        ]);
    }

    #[Route('/view', name: 'app_comment_view')]
    public function view(): Response
    {
        return $this->render('comment/view.html.twig', [
            'appName' => $_ENV["APP_NAME"]
        ]);
    }
}
