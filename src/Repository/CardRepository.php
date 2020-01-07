<?php

namespace App\Repository;

use App\Entity\Card;
use App\Model\CardRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CardRepository
 * @package App\Repository
 */
final class CardRepository implements CardRepositoryInterface
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
     * CardRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Card::class);
    }

    /**
     * @param int $cardId
     * @return Card
     */
    public function findById(int $cardId): ?Card
    {
        return $this->objectRepository->find($cardId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param Card $card
     */
    public function save(Card $card): void
    {
        $this->entityManager->persist($card);
        $this->entityManager->flush();
    }

    /**
     * @param Card $card
     */
    public function delete(Card $card): void
    {
        $this->entityManager->remove($card);
        $this->entityManager->flush();
    }
}
