<?php
namespace App\Controller\Api\v1;

use App\Entity\Todo;
use App\RequestDTO\TodoDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TodoController
{
	/** @var Serializer  */
	private $serializer;

	public  function __construct()
	{
		$this->serializer = new Serializer([ new ObjectNormalizer() ], [ new JsonEncoder() ]);
	}

	/**
	 * @Route(path="/todo", methods={"GET"})
	 * @return JsonResponse
	 */
	public function all(EntityManagerInterface $entityManager)
	{
		$data = $this->serializer->serialize($entityManager->getRepository(Todo::class)->findAll(), 'json');
		return new JsonResponse($data, 200, [], true);
	}

	/**
	 * @Route(
	 *     "/todo/{id}",
	 *     name="delete_todo",
	 *     methods={"DELETE"},
	 *     requirements={"id"="\d+"}
	 * )
	 * @return JsonResponse
	 */
	public function delete(int $id, EntityManagerInterface $entityManager)
	{
		$todo = $entityManager
			->getRepository(Todo::class)
			->find($id);

		if (!$todo) {
			throw new NotFoundHttpException('Todo not found');
		}

		$entityManager->remove($todo);
		$entityManager->flush();

		return new JsonResponse();
	}

	/**
	 * @Route(
	 *     path="/todo",
	 *     methods={"POST"}
	 * )
	 * @return JsonResponse
	 */
	public function create(TodoDTO $todoDTO, EntityManagerInterface $entityManager, ValidatorInterface $validator)
	{
		$todo = new Todo();
		$todo->setDescription($todoDTO->getDescription());
		$todo->setIsCompleted(false);
		$entityManager->persist($todo);
		$entityManager->flush();
		return new JsonResponse($this->serializer->serialize($todo, 'json'), 201, [], true);
	}

	/**
	 * @Route(
	 *     path="/todo/{id}",
	 *     methods={"GET"},
	 *     requirements={"id"="\d+"}
	 * )
	 * @return JsonResponse
	 */
	public function read(int $id, EntityManagerInterface $entityManager)
	{
		$todo = $entityManager
			->getRepository(Todo::class)
			->find($id);

		if (!$todo) {
			throw new NotFoundHttpException('Todo not found');
		}

		return new JsonResponse($this->serializer->serialize($todo, 'json'), 200, [], true);
	}

	/**
	 * @Route(
	 *     "/todo/{id}",
	 *     methods={"PUT"},
	 *     requirements={"id"="\d+"}
	 * )
	 * @return JsonResponse
	 */
	public function update(int $id, TodoDTO $todoDTO, EntityManagerInterface $entityManager)
	{
		$todo = $entityManager->getRepository(Todo::class)->find($id);

		if (!$todo) {
			throw new NotFoundHttpException('Todo not found');
		}

		$todo->setDescription($todoDTO->getDescription());
		$todo->setIsCompleted($todoDTO->getIsCompleted());
		$entityManager->flush();
		return new JsonResponse($this->serializer->serialize($todo, 'json'), 200, [], true);
	}
}
