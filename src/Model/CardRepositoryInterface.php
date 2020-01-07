<?php

namespace App\Model;

use App\Entity\Card;

/**
 * Interface CardRepositoryInterface
 * @package App\Repository
 */
interface CardRepositoryInterface
{
    /**
     * @param int $cardId
     * @return Card
     */
    public function findById(int $cardId): ?Card;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Card $card
     */
    public function save(Card $card): void;

    /**
     * @param Card $card
     */
    public function delete(Card $card): void;

}
