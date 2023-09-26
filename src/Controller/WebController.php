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

    #[Route('/addfauxreponse/{question}', name: 'web_add_faux_reponse')]
    public function addFauxreponse(QuestionsRepository $questionsRepository, Questions $questions = null): JsonResponse{
        if($questions) {
            $questions->setNReponse(0);
            $questionsRepository->save($questions, true);
        }
        return new JsonResponse([
            'questions' => $questions->getNReponse()
        ]);
    }

    #[Route('/addrighreponse/{question}', name: 'web_add_right_reponse')]
    public function addRightreponse(QuestionsRepository $questionsRepository, Questions $questions = null): JsonResponse{
        if($questions) {
            $questions->setNReponse(($questions->getNReponse() ? $questions->getNReponse() : 0)   + 1);
            $questionsRepository->save($questions, true);
        }

        return new JsonResponse([
            'questions' => $questions?->getNReponse()
        ]);
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
