<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index()
    {
        $auditLogs = AuditLog::with('user')->latest('performed_at')->get();

        return view('audit-logs.index', compact('auditLogs'));
    }
}
