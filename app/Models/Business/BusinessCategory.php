<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model {
    use HasFactory,
        HasUuids;

    protected function casts(): array {
        return [
            'parent_id' => 'string',
        ];
    }
}
