<?php

namespace App\Domain\Model\Question;

/**
 * Interface QuestionsRepositoryInterface
 * @package App\Domain\Model\Question
 */
interface QuestionsRepositoryInterface
{

    /**
     * @param int $articleId
     * @return Question
     */
    public function findById(int $questionId): ?Question;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Question $article
     */
    public function save(Question $question): void;

    /**
     * @param Question $article
     */
    public function delete(Question $question): void;

}
