<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Question\Question;
use App\Domain\Model\Question\QuestionsRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ArticleRepository
 * @package App\Infrastructure\Repository
 */
final class QuestionsRepository implements QuestionsRepositoryInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    /**
     * ArticleRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Question::class);
    }

    /**
     * @param int $articleId
     * @return Question
     */
    public function findById(int $articleId): ?Question
    {
        return $this->objectRepository->find($articleId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param Question $article
     */
    public function save(Question $article): void
    {
        $this->entityManager->persist($article);
        $this->entityManager->flush();
    }

    /**
     * @param Question $article
     */
    public function delete(Question $article): void
    {
        $this->entityManager->remove($article);
        $this->entityManager->flush();
    }

}
