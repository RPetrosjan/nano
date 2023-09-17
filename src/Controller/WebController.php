<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Repository\QuestionsRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class WebController extends AbstractController
{
    #[Route('/', name: 'web_home_nano')]
    #[Template('web_home.html.twig')]
    public function index(){
        return [
        ];
    }

    #[Route('/ajaxmots', name: 'web_home_ajax')]
    public function getMotsAjax(QuestionsRepository $questionsRepository) : JsonResponse{
        /** @var Questions $questionInfo */
        $questionInfo = $questionsRepository->getQuestion();
        $reponsesInfo = $questionsRepository->getReponses($questionInfo->getId());
        $reponsesInfo[] = $questionInfo->getReponse();
        shuffle($reponsesInfo);
        return new JsonResponse([
            'right' => $questionInfo->getReponse(),
            'question' => $questionInfo->getQuestion(),
            'reponses' => $reponsesInfo
        ], headers: [
            'Content-Type' => 'application/json; charset=UTF-8'
        ]);
    }
}
