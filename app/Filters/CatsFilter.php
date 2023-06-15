<?php

namespace App\Filters;

use Illuminate\Http\Request;

class CatsFilter extends Filter
{
    protected array $safeParams = [
        'name' => ['eq'],
        'sex' => ['eq'],
        'birthdate' => ['eq'],
        'department_id' => ['eq'],
        'employee_id' => ['eq'],
        'breed' => ['eq'],
        'sterilized' => ['eq'],
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
