<?php
namespace App\RequestDTO;

use Symfony\Component\Validator\Constraints as Assert;

class TodoDTO implements RequestDTOInterface
{
	/**
	 * @Assert\NotBlank(
	 *     message="Description should not be blank."
	 * )
	 */
	private $description;

	private $isCompleted;

	public function getIsCompleted()
	{
		return (boolean) $this->isCompleted;
	}

	public function setIsCompleted($isCompleted): void
	{
		$this->isCompleted = $isCompleted;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description): void
	{
		$this->description = $description;
	}
}
