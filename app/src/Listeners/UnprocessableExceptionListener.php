<?php
namespace App\Listeners;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UnprocessableExceptionListener
{
	public function onKernelException(ExceptionEvent $event)
	{
		if ($event->getThrowable() instanceof UnprocessableEntityHttpException
			&& $event->getRequest()->attributes->has('_err')) {
			$event->setResponse(new JsonResponse($event->getRequest()->attributes->get('_err')));
		}
	}
}
