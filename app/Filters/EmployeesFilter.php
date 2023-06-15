<?php

namespace App\Filters;
class EmployeesFilter extends Filter
{
    protected array $safeParams = [
        'first_name' => ['eq'],
        'last_name' => ['eq'],
        'email' => ['eq'],
        'phone' => ['eq'],
        'department_id' => ['eq'],
        'position' => ['eq'],
    ];
    protected array $columnMap = [];
    protected array $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];
}
