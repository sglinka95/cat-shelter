<?php

namespace App\Http\Controllers;

use App\Exceptions\CatNotFoundException;
use App\Filters\CatsFilter;
use App\Http\Requests\CreateCatRequest;
use App\Http\Requests\UpdateCatRequest;
use App\Http\Resources\CatResource;
use App\Models\Cat;
use App\Repositories\CatRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CatController extends Controller
{
    public function __construct(
        private readonly CatRepositoryInterface $catRepository
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        $filter = (new CatsFilter())->transform($request);
        return CatResource::collection($this->catRepository->findByCriteria($filter))->response();
    }

    /**
     * @throws CatNotFoundException
     */
    public function store(CreateCatRequest $request): CatResource
    {
        $this->catRepository->save(
            $cat = Cat::createFromArray(
                array_merge(
                    ['id' => (string) Str::uuid()],
                    $request->all()
                )
            )
        );

        return new CatResource($this->getCatById($cat->getKey()));
    }

    /**
     * @throws CatNotFoundException
     */
    public function show(string $id): CatResource
    {
        return new CatResource($this->getCatById($id));
    }

    /**
     * @throws CatNotFoundException
     */
    public function update(UpdateCatRequest $request, string $id): CatResource
    {
        $cat = $this->getCatById($id);
        $this->catRepository->save(
            Cat::createFromArray(
                array_merge(
                    ['id' => $cat->getKey()],
                    $request->all()
                )
            )
        );

        return new CatResource($this->getCatById($cat->getKey()));
    }

    /**
     * @throws CatNotFoundException
     */
    public function destroy(string $id): JsonResponse
    {
        $this->getCatById($id);
        $this->catRepository->delete($id);

        return response()->json(
            ['message' => 'Cat deleted successfully'],
            Response::HTTP_OK
        );
    }

    /**
     * @throws CatNotFoundException
     */
    private function getCatById(string $id): Cat
    {
        $cat = $this->catRepository->findById($id);

        if($cat === null) {
            throw CatNotFoundException::forId($id);
        }

        return $cat;
    }
}
