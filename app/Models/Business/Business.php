<?php

namespace App\Models\Business;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model {
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'address_id',
    ];

    protected function casts(): array {
        return [
            'user_id' => 'string',
            'address_id' => 'string',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function address(): HasOne {
        return $this->hasOne(Address::class);
    }
}
