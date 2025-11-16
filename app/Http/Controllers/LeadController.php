<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LeadController extends Controller
{
    public function index()
    {
        return view('leads.index');
    }

    public function export()
    {
        $leads = Lead::with('client')->get();

        $filename = 'leads_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($leads) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, ['Name', 'Email', 'Phone', 'Company', 'Status', 'Value', 'Source', 'Client', 'Created At']);
            
            // Data rows
            foreach ($leads as $lead) {
                fputcsv($file, [
                    $lead->name,
                    $lead->email ?? '',
                    $lead->phone ?? '',
                    $lead->company ?? '',
                    $lead->status,
                    $lead->value ?? '0.00',
                    $lead->source ?? '',
                    $lead->client?->name ?? '',
                    $lead->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

