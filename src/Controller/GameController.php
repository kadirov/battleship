<?php declare(strict_types=1);

namespace App\Controller;

use App\Component\Game\Interfaces\GameBuilderInterface;
use App\Controller\Traits\ResponseTrait;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GameController
 * @package App\Controller
 */
class GameController
{
    use ResponseTrait;

    /**
     * @var GameBuilderInterface
     */
    private $gameBuilder;

    /**
     * GameController constructor.
     * @param GameBuilderInterface $gameBuilder
     */
    public function __construct
    (
        GameBuilderInterface $gameBuilder
    ) {
        $this->gameBuilder = $gameBuilder;
    }

    /**
     * Start a new game
     *
     * @Route("/api/games/new", methods={"GET"})
     * @SWG\Get(
     *      @SWG\Response(
     *          response=200,
     *          description="Token of created game",
     *          examples={"{'token': '27e75b666e2c369e7c39869fcf2ad94e'}"}
     *      ),
     *      @SWG\Response(
     *          response=400,
     *          description="An error message"
     *      )
     * )
     * @SWG\Tag(name="Game")
     * @return JsonResponse
     */
    public function newGameAction(): JsonResponse
    {
        $game = $this->gameBuilder->build();
        return $this->response(['token' => $game->getToken()]);
    }
}
