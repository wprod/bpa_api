<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\Service\QuestionService;
use App\Domain\Model\Question\Question;
use App\Domain\Model\Question\QuestionsRepositoryInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class QuestionController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class QuestionController extends FOSRestController
{
    /**
     * @var QuestionService
     */
    private $questionService;

    /**
     * QuestionController constructor.
     * @param QuestionService $questionService
     */
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Creates an Question resource
     * @Rest\Post("/questions")
     * @param Request $request
     * @return View
     */
    public function postQuestion(Request $request): View
    {
        $article = $this->questionService->addQuestion($request->get('title'), $request->get('content'));

        return View::create($article, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an Question resource
     * @Rest\Get("/question/{questionId}")
     * @param int $questionId
     * @return View
     */
    public function getArticle(int $questionId): View
    {
        $question = $this->questionService->getArticle($questionId);

        return View::create($question, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Question resource
     * @Rest\Get("/questions")
     * @return View
     */
    public function getQuestions(): View
    {
        $questions = $this->questionService->getAllQuestions();

        return View::create($questions, Response::HTTP_OK);
    }

    /**
     * Replaces Question resource
     * @Rest\Put("/questions/{questionId}")
     * @param int $questionId
     * @param Request $request
     * @return View
     */
    public function putQuestion(int $questionId, Request $request): View
    {
        $question = $this->questionService->updateQuestion($questionId, $request->get('title'), $request->get('content'));

        return View::create($question, Response::HTTP_OK);
    }

    /**
     * Removes the Question resource
     * @Rest\Delete("/questions/{questionId}")
     * @param int $questionId
     * @return View
     */
    public function deleteArticle(int $questionId): View
    {
        $this->questionService->deleteArticle($questionId);

        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
