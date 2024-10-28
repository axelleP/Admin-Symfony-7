<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/general-page')]
class GeneralPageController extends AbstractController
{
    #[Route('/list', name: 'app_general_page_list')]
    public function list(): Response
    {
        return $this->render('generalPage/list.html.twig', [
            'appName' => $_ENV["APP_NAME"]
        ]);
    }
}
