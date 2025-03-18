<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Entity\Reponses;
use App\Entity\TypeSection;
use App\Repository\QuestionsRepository;
use App\Repository\TypeSectionRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class WebController extends AbstractController
{
    #[Route('/', name: 'web_home_nano')]
    #[Template('web_home.html.twig')]
    public function index(TypeSectionRepository $typeSectionRepository){

        $typeSection = $typeSectionRepository->getSectionRandom();
        return [
            'typeSection' => $typeSection,
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

    #[Route('/ajaxmots/{typeSection}/{numero}', name: 'web_home_ajax')]
    public function getMotsAjax(TypeSection $typeSection, int $numero = 0) : JsonResponse{

        /** @var Questions $questionInfo */
        $questionInfo = $typeSection->getQuestions()[$numero];

        $reponsesInfo = array_map(function (Reponses $reponse) {
            return [
                'reponse' => $reponse->getReponse(),
                'iscorrect' => $reponse->isIsCorrect(),
            ];
        }, $questionInfo->getReponses()->toArray());

        shuffle($reponsesInfo);
        return new JsonResponse([
            'max' => sizeof($typeSection->getQuestions()),
            'doc' => $questionInfo->getDocumentation()->getText(),
            'typeSection' => $questionInfo->getTypeSection()->getTitle(),
            'question' => $questionInfo->getQuestion(),
            'reponses' => $reponsesInfo,
        ], headers: [
            'Content-Type' => 'application/json; charset=UTF-8'
        ]);

    }
}
