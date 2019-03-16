<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FrontendController
 * @package App\Controller
 */
class FrontendController extends AbstractController
{
    /**
     * @Route(name="front_index", methods={"GET"}, path="/")
     * @return Response
     */
    public function mainAction(): Response
    {
        return $this->render('index.html.twig');
    }
}
