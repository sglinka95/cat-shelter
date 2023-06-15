<?php

namespace App\Http\Controllers;

use App\Exceptions\DepartmentNotFoundException;
use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Repositories\DepartmentRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function __construct(
        private readonly DepartmentRepositoryInterface $departmentRepository,
    )
    {
    }

    public function index(): JsonResponse
    {
        return DepartmentResource::collection($this->departmentRepository->all())->response();
    }

    /**
     * @throws DepartmentNotFoundException
     */
    public function store(CreateDepartmentRequest $request): DepartmentResource
    {
        $this->departmentRepository->save(
            $department = Department::createFromArray(
                array_merge(
                    ['id' => (string) Str::uuid()],
                    $request->all()
                )
            )
        );

        return new DepartmentResource($this->getDepartmentById($department->getKey()));
    }

    /**
     * @throws DepartmentNotFoundException
     */
    public function show(string $id): DepartmentResource
    {
        return new DepartmentResource($this->getDepartmentById($id));
    }

    /**
     * @throws DepartmentNotFoundException
     */
    public function update(UpdateDepartmentRequest $request, string $id): DepartmentResource
    {
        $department = $this->getDepartmentById($id);
        $this->departmentRepository->save(
            Department::createFromArray(
                array_merge(
                    ['id' => $department->getKey()],
                    $request->all()
                )
            )
        );

        return new DepartmentResource($this->getDepartmentById($department->getKey()));
    }

    /**
     * @throws DepartmentNotFoundException
     */
    public function destroy(string $id): JsonResponse
    {
        $this->getDepartmentById($id);
        $this->departmentRepository->delete($id);

        return response()->json(
            ['message' => 'Department deleted successfully'],
            Response::HTTP_OK
        );
    }

    /**
     * @throws DepartmentNotFoundException
     */
    private function getDepartmentById(string $id): Department
    {
        $department = $this->departmentRepository->findById($id);

        if($department === null) {
            throw DepartmentNotFoundException::forId($id);
        }

        return $department;
    }
}
