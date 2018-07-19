<?php

namespace App\Application\Service;


use App\Domain\Model\Question\Question;
use App\Domain\Model\Question\QuestionsRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class QuestionService
 * @package App\Application\Service
 */
final class QuestionService
{

    /**
     * @var QuestionsRepositoryInterface
     */
    private $questionRepository;

    /**
     * QuestionService constructor.
     * @param QuestionsRepositoryInterface $questionRepository
     */
    public function __construct(QuestionsRepositoryInterface $questionRepository){
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param int $questionId
     * @return Question
     * @throws EntityNotFoundException
     */
    public function getQuestion(int $questionId): Question
    {
        $question = $this->questionRepository->findById($questionId);
        if (!$question) {
            throw new EntityNotFoundException('Question with id '.$questionId.' does not exist!');
        }
    }

    /**
     * @return array|null
     */
    public function getAllQuestions(): ?array
    {
        return $this->questionRepository->findAll();
    }

    /**
     * @param string $title
     * @param string $content
     * @return Question
     */
    public function addQuestion(string $title, string $content): Question
    {
        $question = new Question();
        $question->setTitle($title);
        $question->setContent($content);
        $this->questionRepository->save($question);

        return $question;
    }

    /**
     * @param int $questionId
     * @param string $title
     * @param string $content
     * @return Question
     * @throws EntityNotFoundException
     */
    public function updateQuestion(int $questionId, string $title, string $content): Question
    {
        $question = $this->questionRepository->findById($questionId);
        if (!$question) {
            throw new EntityNotFoundException('Question with id '.$questionId.' does not exist!');
        }

        $question->setTitle($title);
        $question->setContent($content);
        $this->questionRepository->save($question);

        return $question;
    }

    /**
     * @param int $questionId
     * @throws EntityNotFoundException
     */
    public function deleteArticle(int $questionId): void
    {
        $question = $this->questionRepository->findById($questionId);
        if (!$question) {
            throw new EntityNotFoundException('Question with id '.$questionId.' does not exist!');
        }

        $this->questionRepository->delete($question);
    }

}
