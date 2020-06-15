<?php
namespace App\Validator;

use App\RequestDTO\RequestDTOInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDTOArgumentResolver implements ArgumentValueResolverInterface
{
	/**
	 * @var ValidatorInterface
	 */
	private $validator;

	public function __construct(ValidatorInterface $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * @inheritdoc
	 */
	public function supports(Request $request, ArgumentMetadata $argument)
	{
		$reflection = new \ReflectionClass($argument->getType());
		if ($reflection->implementsInterface(RequestDTOInterface::class)
				&& $request->headers->has('Content-Type')
				&& $request->headers->get('Content-Type') == 'application/json'
		) {
			return true;
		}

		return false;
	}

	/**
	 * @inheritdoc
	 */
	public function resolve(Request $request, ArgumentMetadata $argument)
	{
		$class = $argument->getType();
		$serializer = new Serializer([ new ObjectNormalizer() ], [ new JsonEncoder() ]);
		$new  = $serializer->deserialize($request->getContent(), $class, 'json');
		$errors = $this->validator->validate($new);
		if (count($errors) > 0) {
			$l = [];
			foreach ($errors as $err) {
				/** @var ConstraintViolationInterface $err */
				$l[$err->getPropertyPath()] = $err->getMessage();
			}
			$request->attributes->add(['_err' => $l]);
			throw new UnprocessableEntityHttpException();
		}
		yield $new;
	}
}
