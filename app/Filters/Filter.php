<?php

namespace App\Filters;

use Illuminate\Http\Request;

class Filter
{

    protected array $safeParams = [];
    protected array $columnMap = [];
    protected array $operatorMap = [];

    public function transform(Request $request): array
    {
        $eloquentQuery = [];
        foreach($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if(!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach($operators as $operator) {
                if(isset($query[$operator])) {
                    $eloquentQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloquentQuery;
    }
}
