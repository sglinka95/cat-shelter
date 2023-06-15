<?php

namespace App\Http\Controllers;

use App\Exceptions\EmployeeNotFoundException;
use App\Filters\EmployeesFilter;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function __construct(
        private  readonly EmployeeRepositoryInterface $employeeRepository,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        $filter = (new EmployeesFilter())->transform($request);
        return EmployeeResource::collection($this->employeeRepository->findByCriteria($filter))->response();
    }

    /**
     * @throws EmployeeNotFoundException
     */
    public function store(CreateEmployeeRequest $request): EmployeeResource
    {
        $this->employeeRepository->save(
            $department = Employee::createFromArray(
                array_merge(
                    ['id' => (string) Str::uuid()],
                    $request->all()
                )
            )
        );

        return new EmployeeResource($this->getEmployeeById($department->getKey()));
    }

    /**
     * @throws EmployeeNotFoundException
     */
    public function show(string $id): EmployeeResource
    {
        return new EmployeeResource($this->getEmployeeById($id));
    }

    /**
     * @throws EmployeeNotFoundException
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
        $employee = $this->getEmployeeById($id);
        $this->employeeRepository->save(
            Employee::createFromArray(
                array_merge(
                    ['id' => $employee->getKey()],
                    $request->all()
                )
            )
        );

        return new EmployeeResource($this->getEmployeeById($employee->getKey()));
    }

    /**
     * @throws EmployeeNotFoundException
     */
    public function destroy(string $id): JsonResponse
    {
        $this->getEmployeeById($id);
        $this->employeeRepository->delete($id);

        return response()->json(
            ['message' => 'Employee deleted successfully'],
            Response::HTTP_OK
        );
    }

    /**
     * @throws EmployeeNotFoundException
     */
    private function getEmployeeById(string $id): Employee
    {
        $employee = $this->employeeRepository->findById($id);

        if($employee === null) {
            throw EmployeeNotFoundException::forId($id);
        }

        return $employee;
    }
}
