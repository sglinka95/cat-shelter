<?php

namespace App\Http\Controllers;

use App\Enums\BreedEnum;
use App\Enums\PositionEnum;
use App\Enums\SexEnum;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class FilterController extends Controller
{
    public function getCatBreed(): JsonResponse
    {
        return response()->json(
            [
                'data' => BreedEnum::cases()
            ],
            Response::HTTP_OK
        );
    }

    public function getSex(): JsonResponse
    {
        return response()->json(
            [
                'data' => SexEnum::cases()
            ],
            Response::HTTP_OK
        );
    }

    public function getPosition(): JsonResponse
    {
        return response()->json(
            [
                'data' => PositionEnum::cases()
            ],
            Response::HTTP_OK
        );
    }
}
