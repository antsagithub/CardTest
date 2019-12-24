<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Card;
use App\Form\CardType;
/**
 * Card controller.
 * @Route("/api", name="api_")
 */
class CardController extends FOSRestController
{
  /**
   * Lists all Card.
   * @Rest\Get("/cards")
   *
   * @return Response
   */
  public function getCardAction()
  {
    $repository = $this->getDoctrine()->getRepository(Card::class);
    $cards = $repository->findall();
    return $this->handleView($this->view($cards));
  }
  
  /**
   * Create Card.
   * @Rest\Post("/card")
   *
   * @return Response
   */
  public function postCardAction(Request $request)
  {
    $card = new Card();
    $form = $this->createForm(CardType::class, $card);
    $data = json_decode($request->getContent(), true);
    $form->submit($data);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($card);
      $em->flush();
      return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
    }
    return $this->handleView($this->view($form->getErrors()));
  }
  
  /**
   * Edit Card.
   * @Rest\Get("/card/{id}", requirements={"id"="\d+"})
   *
   * @return Response
   */
  public function editCardAction(Request $request){
	$repository = $this->getDoctrine()->getRepository(Card::class);
	$card = $repository->find($request->get('id'));

	if(empty($card)){
		return $this->handleView($this->view(['message' => 'Card not found'], Response::HTTP_CREATED));
	}
	return $this->handleView($this->view($card));
  }
  
  /**
   * Delete Card.
   * @Rest\Delete("/card/{id}", requirements={"id"="\d+"})
   *
   * @return Response
   */
  public function deleteCardAction(Request $request){
	$id = $request->get('id');
	$repository = $this->getDoctrine()->getRepository(Card::class);
	$card = $repository->find($id);

	if(empty($card)){
		return $this->handleView($this->view(['message' => 'Card not found'], Response::HTTP_CREATED));
	}
	
	$em = $this->getDoctrine()->getManager();
	$em->remove($card);
	$em->flush();
	return $this->handleView($this->view(['message' => 'Card with ID:'.$id.' is deleted'], Response::HTTP_CREATED));
  }
  
}