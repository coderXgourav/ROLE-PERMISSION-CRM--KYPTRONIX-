@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}
@push('title')
    <title>Service</title>
@endpush
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
<style>
        .dashboard-card {
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        }
        
        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            transition: transform 0.2s ease;
        }
        
        .stat-card:hover {
            transform: scale(1.02);
        }

        .service-header {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
    </style>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-8xl mx-auto">
            <!-- Service Profile Header -->
            <div class="dashboard-card rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="service-header p-6 text-white">
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <img src="{{ url('/service.png') }}" 
                                 alt="Service Icon" 
                                 class="w-24 h-24 rounded-xl border-4 border-white shadow-md">
                            <div class="absolute -bottom-2 -right-2 bg-green-500 p-2 rounded-full border-2 border-white">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-light">{{ ucwords($data['name']) }}</h1>
                            <p class="text-blue-100 mt-2">Service Dashboard</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                    <!-- Sub Services Card -->
                    <a href="{{ route('admin.sub-service-list', ['id' => $data->service_id]) }}" 
                       class="stat-card bg-white rounded-lg p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Sub Services</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $total_sub_service }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($total_sub_service/max($total_sub_service, 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </a>
                     <!--<a  href="{{ route('admin.operation-manger-list', ['id' => $data->service_id]) }}"
                       class="stat-card bg-white rounded-lg p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Operation Manager</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $operation_manager_count }}</p>
                            </div>
                         <div class="bg-green-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($total_sub_service/max($total_sub_service, 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </a>-->

                    <!-- Team Manager Card -->
                    <!--<a href="{{ route('admin.team-manager-list', ['id' => $data->service_id]) }}" 
                       class="stat-card bg-white rounded-lg p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Team Managers</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $team_manager }}</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: {{ ($team_manager/max($team_manager, 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </a>-->

                    <!-- Team Members Card -->
                   <!-- <a href="{{ route('admin.team-member', ['id' => $data->service_id]) }}" 
                       class="stat-card bg-white rounded-lg p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Team Members</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $total_team_member }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($total_team_member/max($total_team_member, 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </a>-->

                    <!-- Leads Card -->
                    <a href="{{ route('admin.show-leads-list', ['id' => $data->service_id]) }}" 
                       class="stat-card bg-white rounded-lg p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Leads</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $total_leads }}</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-600 h-2 rounded-full" style="width: {{ ($total_leads/max($total_leads, 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </a>

                    <!-- Invoices Card -->
                    <a href="{{ route('admin.service_invoices', ['id' => $data->service_id]) }}" 
                       class="stat-card bg-white rounded-lg p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Invoices</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $total_invoices }}</p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-600 h-2 rounded-full" style="width: {{ ($total_invoices/max($total_invoices, 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
@include('admin.dashboard.footer')