<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LogController extends Controller
{
    public function index(Request $request): Response
    {
        abort_unless($request->user()?->can('audit-log.view'), 403);

        $logs = AuditLog::query()
            ->with('user:id,name,email')
            ->latest('created_at')
            ->limit(500)
            ->get()
            ->map(fn (AuditLog $log) => [
                'id' => $log->id,
                'event' => $log->event,
                'user' => $log->user ? ['name' => $log->user->name, 'email' => $log->user->email] : null,
                'subject_type' => $log->subject_type,
                'subject_id' => $log->subject_id,
                'meta' => $log->meta,
                'ip' => $log->ip,
                'created_at' => $log->created_at?->toIso8601String(),
            ]);

        return Inertia::render('log/index', [
            'logs' => $logs,
        ]);
    }
}
