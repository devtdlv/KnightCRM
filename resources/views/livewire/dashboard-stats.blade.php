<div class="space-y-6">
    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-knight-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Leads</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalLeads }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Clients</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalClients }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Pending Tasks</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Upcoming Reminders</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $upcomingReminders }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Conversion Rate</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $conversionRate }}%</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $wonLeads }} of {{ $totalLeads }} won</p>
                </div>
                <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pipeline Value</p>
                    <p class="text-2xl font-semibold text-gray-900">${{ number_format($totalPipelineValue, 0) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Total potential</p>
                </div>
                <div class="flex-shrink-0 bg-knight-100 rounded-full p-3">
                    <svg class="h-6 w-6 text-knight-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Won Revenue</p>
                    <p class="text-2xl font-semibold text-green-600">${{ number_format($wonValue, 0) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Closed deals</p>
                </div>
                <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">This Month</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $thisMonthLeads }} leads</p>
                    <p class="text-xs text-gray-500 mt-1">${{ number_format($thisMonthValue, 0) }} value</p>
                </div>
                <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Lead Status Overview -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Lead Pipeline Overview</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
            @foreach(['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost'] as $status)
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <p class="text-2xl font-bold text-gray-900">{{ $statusBreakdown[$status] ?? 0 }}</p>
                    <p class="text-sm font-medium text-gray-600 capitalize mt-1">{{ $status }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Leads</h3>
            </div>
            <div class="p-6">
                @if($recentLeads->count() > 0)
                    <ul class="space-y-3">
                        @foreach($recentLeads as $lead)
                            <li class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $lead->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $lead->company ?? 'No company' }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $lead->status_color }}">
                                    {{ ucfirst($lead->status) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-500">No leads yet.</p>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Upcoming Tasks</h3>
            </div>
            <div class="p-6">
                @if($upcomingTasks->count() > 0)
                    <ul class="space-y-3">
                        @foreach($upcomingTasks as $task)
                            <li class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $task->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $task->due_date->format('M d, Y') }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $task->priority_color }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-500">No upcoming tasks.</p>
                @endif
            </div>
        </div>
    </div>
</div>

