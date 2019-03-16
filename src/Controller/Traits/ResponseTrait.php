<?php declare(strict_types=1);

namespace App\Controller\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Trait ResponseTrait
 * @package App\Controller\Traits
 */
trait ResponseTrait
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    private function response(array $data): JsonResponse
    {
        return new JsonResponse($data);
    }
}
