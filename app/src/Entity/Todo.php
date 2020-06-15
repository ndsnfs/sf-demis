<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Todo
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $description;

	/**
	 * @var bool
	 * @ORM\Column(type="boolean", name="is_completed")
	 */
	private $isCompleted;

	public function getDescription() : string
	{
		return $this->description;
	}

	public function setDescription(string $description): void
	{
		$this->description = $description;
	}

	public function isCompleted(): bool
	{
		return $this->isCompleted;
	}

	public function setIsCompleted(bool $isCompleted): void
	{
		$this->isCompleted = $isCompleted;
	}

	public function getId() : int
	{
		return $this->id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}
}
