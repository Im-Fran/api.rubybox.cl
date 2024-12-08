<?php

namespace App\Models\Business;

use App\Models\User;
use Cog\Contracts\Ownership\CanBeOwner;
use Cog\Contracts\Ownership\Ownable;
use Cog\Laravel\Ownership\Traits\HasOwner;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model implements CanBeOwner, Ownable {
    use HasFactory,
        HasOwner,
        HasUuids,
        SoftDeletes;

    protected string $ownerModel = User::class;

    protected string $ownerPrimaryKey = 'id';

    protected string $ownerForeignKey = 'user_id';

    protected $fillable = [
        'name',
        'user_id',
    ];

    protected function casts(): array {
        return [
            'user_id' => 'string',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function address(): HasOne {
        return $this->hasOne(Address::class);
    }

    public function categories(): HasMany {
        return $this->hasMany(BusinessCategory::class);
    }
}
