<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EntryPointController extends AbstractController
{
	/**
	 * @Route(path="/", name="entry_point")
	 */
	public function index()
	{
		return $this->render('base.html.twig');
	}
}
