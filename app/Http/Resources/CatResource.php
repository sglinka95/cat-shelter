<?php

namespace App\Http\Resources;

use App\Models\Employee;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class CatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'breed' => $this->breed,
            'description' => $this->description,
            'sterilized' => $this->sterilized,
            'department' => new DepartmentResource($this->whenLoaded('department')),
            'guardian' => new EmployeeResource($this->whenLoaded('guardian')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
