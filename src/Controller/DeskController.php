<?php declare(strict_types=1);

namespace App\Controller;

use App\Component\Common\Constants\UserType;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Desk\Interfaces\DeskManagerInterface;
use App\Component\Game\Interfaces\GameInterface;
use App\Component\Game\Interfaces\GameManagerInterface;
use App\Controller\Traits\ResponseTrait;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeskController
 * @package App\Controller
 */
class DeskController
{
    use ResponseTrait;

    /**
     * @var DeskManagerInterface
     */
    private $deskManager;

    /**
     * @var GameManagerInterface
     */
    private $gameManager;

    /**
     * DeskController constructor.
     * @param DeskManagerInterface $deskManager
     * @param GameManagerInterface $gameManager
     */
    public function __construct
    (
        DeskManagerInterface $deskManager,
        GameManagerInterface $gameManager
    ) {
        $this->deskManager = $deskManager;
        $this->gameManager = $gameManager;
    }

    /**
     * Get User desk
     *
     * @Route("/api/games/{token}/desks/user", methods={"GET"})
     * @SWG\Get(
     *      @SWG\Response(
     *          response=200,
     *          description="Token of created game",
     *          examples={"
                    {
                        'coordinateX': 5,
                        'coordinateY': 5,
                        'type': 40,
                        'isGameOver': false,
                        'sinkShip': [
                            {
                            'coordinateX': 5,
                            'coordinateY': 5
                            }
                        ]
                        }", "
                        {
                            'coordinateX': 1,
                            'coordinateY': 1,
                            'type': 1,
                            'isGameOver': false,
                            'sinkShip': []
                        }
                    "}),
     *      @SWG\Response(
     *          response=400,
     *          description="An error message"
     *      ),
     * )
     * @SWG\Tag(name="Shooter")
     * @param string $token
     * @return JsonResponse
     */
    public function getUserDeskAction(string $token): JsonResponse
    {
        $game = $this->getGameByToken($token);

        $desk = $this->getDesk($game, UserType::USER);

        $result = [];

        foreach ($desk->getAreas() as $key => $area) {
            $result[$key]['coordinateX'] = $area->getCoordinateX();
            $result[$key]['coordinateY'] = $area->getCoordinateY();
            $result[$key]['type'] = $area->getType();
        }

        return $this->response($result);
    }

    /**
     * @param string $token
     * @return GameInterface
     * @throws BadRequestHttpException
     */
    private function getGameByToken(string $token): GameInterface
    {
        $game = $this->gameManager->getByToken($token);

        if ($game === null) {
            throw new BadRequestHttpException('Game is not found');
        }

        if ($game->getIsGameOver()) {
            throw new BadRequestHttpException('The game is already over');
        }

        return $game;
    }

    /**
     * @param GameInterface $game
     * @param int $type
     * @return DeskInterface
     */
    private function getDesk(GameInterface $game, int $type): DeskInterface
    {
        $desk = $this->deskManager->getByType($game, UserType::USER);

        if ($desk === null) {
            throw new \LogicException('Desk is not found');
        }

        return $desk;
    }
}
