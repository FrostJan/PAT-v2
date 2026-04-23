<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActivityPurpose extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function facilityRequests(): HasMany
    {
        return $this->hasMany(FacilityRequest::class);
    }
}
