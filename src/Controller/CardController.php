<?php
namespace App\Controller;

/*
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Card;
use App\Form\CardType;
*/



use App\Services\CardService;
use App\Entity\Card;
use App\Model\CardRepositoryInterface;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Card controller.
 * @Route("/api", name="api_")
 */
final class CardController extends FOSRestController
{
	/**
     * @var CardService
     */
    private $cardService;

    /**
     * CardController constructor.
     * @param CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }
	
	/**
	* Create Card.
	* @Rest\Post("/card")
	*
	* @return View
	*/
	public function postCardAction(Request $request): View
	{
		$card = $this->cardService->addCard($request->get('name'), $request->get('description'));
		//return a 201 HTTP CREATED response with the created object
		return View::create($card, Response::HTTP_CREATED);
	}
	
	/**
	* Lists all Card.
	* @Rest\Get("/cards")
	*
	* @return View
	*/
	public function getCardAction(): View
	{
		$cards = $this->cardService->getAllCard();
		//return a 200 HTTP OK response with the collection of object
		return View::create($cards, Response::HTTP_OK);
	}
  
  
	/**
	* Edit Card.
	* @Rest\Get("/card/{cardId}", requirements={"cardId"="\d+"})
	*
	* @return View
	*/
	public function editCardAction(int $cardId): View
	{
		$card = $this->cardService->getCard($cardId);
        //return a 200 HTTP OK response with the request object
        return View::create($card, Response::HTTP_OK);
	}
  
	/**
	* Delete Card.
	* @Rest\Delete("/card/{cardId}", requirements={"cardId"="\d+"})
	*
	* @return View
	*/
	public function deleteCardAction(int $cardId): View
	{
		$this->cardService->deleteCard($cardId);
        //return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
	}
  
}