<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Task;
use Livewire\Component;

class DashboardStats extends Component
{
    public function render()
    {
        // Overall Statistics
        $totalLeads = Lead::count();
        $totalClients = Client::count();
        $pendingTasks = Task::where('status', '!=', 'completed')->count();
        $upcomingReminders = \App\Models\Reminder::where('sent', false)
            ->where('remind_at', '>', now())
            ->count();

        // Lead Statistics
        $wonLeads = Lead::where('status', 'won')->count();
        $conversionRate = $totalLeads > 0 ? round(($wonLeads / $totalLeads) * 100, 1) : 0;
        $totalPipelineValue = Lead::sum('value') ?? 0;
        $wonValue = Lead::where('status', 'won')->sum('value') ?? 0;

        // Recent Activity
        $recentLeads = Lead::latest()->take(5)->get();
        $upcomingTasks = Task::where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        // Lead Status Breakdown
        $statusBreakdown = Lead::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // This Month Stats
        $thisMonthLeads = Lead::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $thisMonthWon = Lead::where('status', 'won')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->count();
        $thisMonthValue = Lead::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('value') ?? 0;

        return view('livewire.dashboard-stats', [
            'totalLeads' => $totalLeads,
            'totalClients' => $totalClients,
            'pendingTasks' => $pendingTasks,
            'upcomingReminders' => $upcomingReminders,
            'wonLeads' => $wonLeads,
            'conversionRate' => $conversionRate,
            'totalPipelineValue' => $totalPipelineValue,
            'wonValue' => $wonValue,
            'recentLeads' => $recentLeads,
            'upcomingTasks' => $upcomingTasks,
            'statusBreakdown' => $statusBreakdown,
            'thisMonthLeads' => $thisMonthLeads,
            'thisMonthWon' => $thisMonthWon,
            'thisMonthValue' => $thisMonthValue,
        ]);
    }
}

