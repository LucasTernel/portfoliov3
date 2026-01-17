<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    // 1. AFFICHER LA LISTE
    public function index()
    {
        // On récupère les logs du plus récent au plus vieux, avec pagination (20 par page)
        $logs = ActivityLog::with('user')->latest()->paginate(20);
        return view('admin.logs.index', compact('logs'));
    }

    // 2. EXPORTER EN CSV
    public function export()
    {
        $fileName = 'logs_site_' . date('Y-m-d_H-i') . '.csv';
        $logs = ActivityLog::with('user')->latest()->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Date', 'Heure', 'Action', 'Description', 'Utilisateur', 'IP'];

        $callback = function() use($logs, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($logs as $log) {
                $row['Date']  = $log->created_at->format('d/m/Y');
                $row['Heure'] = $log->created_at->format('H:i:s');
                $row['Action'] = $log->action;
                $row['Description'] = $log->description;
                $row['Utilisateur'] = $log->user ? $log->user->name : 'Système/Invité';
                $row['IP'] = $log->ip_address;

                fputcsv($file, array($row['Date'], $row['Heure'], $row['Action'], $row['Description'], $row['Utilisateur'], $row['IP']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}