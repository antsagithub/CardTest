<?php
namespace App\Services;

use App\Entity\Card;
use App\Form\CardType;
use App\Model\CardRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

final class CardService
{
    /**
     * @var CardRepositoryInterface
     */
    private $cardRepository;
	
    public function __construct(CardRepositoryInterface $cardRepository){
        $this->cardRepository = $cardRepository;
    }
	
    public function getCard(int $cardId): ?Card
    {
        $card = $this->cardRepository->findById($cardId);
		if (!$card) {
            throw new EntityNotFoundException('Card with id '.$cardId.' does not exist!');
        }
		return $card;
    }
	
    public function getAllCard(): ?array
    {
        return $this->cardRepository->findAll();
    }
	
    public function addCard(string $name, string $description): Card
    {
        $card = new Card();
        $card->setName($name);
        $card->setDescription($description);
        $this->cardRepository->save($card);
        return $card;
    }
	
    public function updateCard(int $cardId, string $name, string $description): ?Card
    {
        $card = $this->cardRepository->findById($cardId);
        if(!$card){
            throw new EntityNotFoundException('Card with id '.$cardId.' does not exist!');
        }
        $card->setName($name);
        $card->setDescription($description);
        $this->cardRepository->save($card);
        return $card;
    }
	
    public function deleteCard(int $cardId): void
    {
        $card = $this->cardRepository->findById($cardId);
		if(!$card){
            throw new EntityNotFoundException('Card with id '.$cardId.' does not exist!');
        }
		$this->cardRepository->delete($card);
    }
}