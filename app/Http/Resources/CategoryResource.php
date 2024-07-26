<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'icon' => $this->icon,
            'order' => $this->order,
            'name' => $this->getTranslations('name'),
            'parent_id' => $this->parent_id,
            'child_categories' => $this->childCategories
        ];
    }
}
