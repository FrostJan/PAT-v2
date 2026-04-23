<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditLogger
{
    public static function record(string $event, ?Model $subject = null, array $meta = []): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => $event,
            'subject_type' => $subject?->getMorphClass(),
            'subject_id' => $subject?->getKey(),
            'meta' => $meta,
            'ip' => Request::ip(),
            'created_at' => now(),
        ]);
    }
}
