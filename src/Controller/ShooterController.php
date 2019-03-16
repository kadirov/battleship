<?php declare(strict_types=1);

namespace App\Controller;

use App\Component\Area\Constants\AreaType;
use App\Component\Area\Interfaces\AreaManagerInterface;
use App\Component\Common\Constants\UserType;
use App\Component\Desk\Interfaces\DeskManagerInterface;
use App\Component\Game\Interfaces\GameInterface;
use App\Component\Game\Interfaces\GameManagerInterface;
use App\Component\Shooter\Dto\Interfaces\ShootResultInterface;
use App\Component\Shooter\Interfaces\ShooterInterface;
use App\Controller\Traits\ResponseTrait;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ShooterController
 * @package App\Controller
 */
class ShooterController
{
    use ResponseTrait;

    /**
     * @var GameManagerInterface
     */
    private $gameManager;
    /**
     * @var ShooterInterface
     */
    private $shooter;
    /**
     * @var DeskManagerInterface
     */
    private $deskManager;
    /**
     * @var AreaManagerInterface
     */
    private $areaManager;

    /**
     * ShooterController constructor.
     * @param GameManagerInterface $gameManager
     * @param ShooterInterface $shooter
     * @param DeskManagerInterface $deskManager
     * @param AreaManagerInterface $areaManager
     */
    public function __construct
    (
        GameManagerInterface $gameManager,
        ShooterInterface $shooter,
        DeskManagerInterface $deskManager,
        AreaManagerInterface $areaManager
    ) {
        $this->gameManager = $gameManager;
        $this->shooter = $shooter;
        $this->deskManager = $deskManager;
        $this->areaManager = $areaManager;
    }

    /**
     * User shoots to CPU desk
     *
     * @Route("/api/games/{token}/shoots/user-to-cpu", methods={"POST"})
     * @SWG\Post(
     *      @SWG\Response(
     *          response=200,
     *          description="Token of created game",
     *          examples={"{'token': '27e75b666e2c369e7c39869fcf2ad94e'}"}
     *      ),
     *      @SWG\Response(
     *          response=400,
     *          description="An error message"
     *      ),
     *      @SWG\Parameter(
     *          name="coordinateX",
     *          type="integer",
     *          in="query",
     *          required=true
     *      ),
     *      @SWG\Parameter(
     *          name="coordinateY",
     *          type="integer",
     *          in="query",
     *          required=true
     *      )
     * )
     * @SWG\Tag(name="Shooter")
     * @param string $token
     * @param Request $request
     * @return JsonResponse
     * @throws BadRequestHttpException
     */
    public function userShootsToCpuAction(string $token, Request $request): JsonResponse
    {
        $coordinateX = (int)$request->get('coordinateX');
        $coordinateY = (int)$request->get('coordinateY');

        if (!$this->areaManager->isValidCoordinates($coordinateX, $coordinateY)) {
            throw new BadRequestHttpException('Wrong coordinates');
        }

        $game = $this->getGameByToken($token);

        if ($game->getTurn() === UserType::CPU) {
            throw new BadRequestHttpException("Now CPU's turn");
        }

        $desk = $this->deskManager->getByType($game, UserType::CPU);

        if ($desk === null) {
            throw new \LogicException('Desk is not found');
        }

        $shootResult = $this->shooter->shootToCpu($desk, $coordinateX, $coordinateY);

        return $this->responseByShootResult($shootResult);
    }

    /**
     * CPU shoots to User desk
     *
     * @Route("/api/games/{token}/shoots/cpu-to-user", methods={"GET"})
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
    public function cpuShootsToUserAction(string $token): JsonResponse
    {
        $game = $this->getGameByToken($token);

        if ($game->getTurn() === UserType::USER) {
            throw new BadRequestHttpException("Now User's turn");
        }

        $desk = $this->deskManager->getByType($game, UserType::USER);

        if ($desk === null) {
            throw new \LogicException('Desk is not found');
        }

        $shootResult = $this->shooter->shootToUser($desk);

        return $this->responseByShootResult($shootResult);
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
     * @param ShootResultInterface $shootResult
     * @return JsonResponse
     */
    private function responseByShootResult(ShootResultInterface $shootResult): JsonResponse
    {
        $sinkShip = [];

        if ($shootResult->getArea()->getType() === AreaType::SINK) {
            foreach ($shootResult->getArea()->getShip()->getAreas() as $key => $area) {
                $sinkShip[$key]['coordinateX'] = $area->getCoordinateX();
                $sinkShip[$key]['coordinateY'] = $area->getCoordinateY();
            }
        }

        return $this->response([
            'coordinateX' => $shootResult->getArea()->getCoordinateX(),
            'coordinateY' => $shootResult->getArea()->getCoordinateY(),
            'type' => $shootResult->getArea()->getType(),
            'isGameOver' => $shootResult->getArea()->getDesk()->getGame()->getIsGameOver(),
            'sinkShip' => $sinkShip
        ]);
    }
}
