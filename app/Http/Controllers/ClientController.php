<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index');
    }

    public function notes($id)
    {
        return view('clients.notes', ['clientId' => $id]);
    }

    public function export()
    {
        $clients = Client::withCount(['notes', 'tasks', 'leads'])->get();

        $filename = 'clients_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($clients) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, ['Name', 'Email', 'Phone', 'Company', 'Address', 'Notes Count', 'Tasks Count', 'Leads Count', 'Created At']);
            
            // Data rows
            foreach ($clients as $client) {
                fputcsv($file, [
                    $client->name,
                    $client->email ?? '',
                    $client->phone ?? '',
                    $client->company ?? '',
                    $client->address ?? '',
                    $client->notes_count,
                    $client->tasks_count,
                    $client->leads_count,
                    $client->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

