<?php

namespace App\Models;

use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacilityRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'activity_purpose_id',
        'department',
        'division',
        'attendees',
        'date_filed',
        'date_needed',
        'time_needed_start',
        'time_needed_end',
        'person_in_charge',
        'contact_number',
        'services',
        'classification',
        'attachment_path',
        'attachment_original_name',
        'status',
        'decided_by',
        'decided_at',
    ];

    protected function casts(): array
    {
        return [
            'attendees' => 'integer',
            'date_filed' => 'date',
            'date_needed' => 'date',
            'time_needed_start' => 'datetime:H:i',
            'time_needed_end' => 'datetime:H:i',
            'services' => 'array',
            'classification' => 'array',
            'status' => RequestStatus::class,
            'decided_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function activityPurpose(): BelongsTo
    {
        return $this->belongsTo(ActivityPurpose::class);
    }

    public function decidedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'decided_by');
    }

    public function calendarEvent(): HasOne
    {
        return $this->hasOne(CalendarEvent::class);
    }
}
