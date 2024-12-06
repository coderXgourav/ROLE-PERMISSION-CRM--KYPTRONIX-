@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}
@push('title')
    <title>Add Contact</title>
@endpush
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
	
    <style>
        .profile-stats {
            transition: all 0.3s ease;
        }
        
        .profile-stats:hover {
            transform: translateY(-3px);
            /* box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); */
        }

        .profile-card {
            background: linear-gradient(145deg, #ffffff 0%, #f3f4f6 100%);
        }

        .badge {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
    </style>

<div>
			<body class="bg-gray-50 shadow-lg p-4">
    <div class="container mx-auto px-4 py-8 ">
        <div class="max-w-8xl mx-auto"> <br>
            <div class="bg-white rounded-lg shadow-md overflow-hidden profile-card">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row" style="gap: 40px;">
                        <div class="md:w-1/3 text-center md:text-left">
                            <div class="relative">
                                <img src="{{ url('assets/images/team.png') }}" 
                                     alt="Profile Picture" 
                                     class="w-32 h-32 rounded-full border-4 border-blue-500 mx-auto md:mx-0">
                              {{--  @if($data->user_type == "operation_manager") --}}
                                    <span class="absolute bottom-0 right-0 bg-green-500 p-1.5 rounded-full border-2 border-white"></span>
                              {{--  @endif --}}
                            </div>
                        </div>
                        
                        <div class="md:w-2/3 mt-6 md:mt-0 md:pl-8">
                            <h2 class="text-3xl font-bold text-gray-800">
                                {{ ucwords($data['first_name']) }} {{ ucwords($data['last_name']) }}
                            </h2>
                            
                            <div class="mt-2">
                                <span class="badge px-4 py-1 rounded-full text-white text-sm">
                                  {{$user_role['modern_name']}}
                                </span>
                            </div>


                                <div class="mt-4">
                                    <h3 class="text-lg font-semibold text-gray-700">Services</h3>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach($service_data as $val)
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                                {{ $val->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                            <div class="mt-4 space-y-2">
                                <p class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $data['email_address'] }}
                                </p> 
                                <p class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    {{ $data['phone_number'] }}
                                </p>
                            </div>
                        </div>
                         
									

                          <div style="position: absolute; right:125px;"> <a href="{{route('admin.edit',['id'=>$data['id']])}}"  class="btn btn-primary">Edit Profile</a></div>

                    </div>
                    {{-- @if($data->user_type != "operation_manager") --}}
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                          {{--   @if(isset($data) && ( $data->user_type == 'operation_manager')) --}}
                               <!-- <a href="{{ route('admin.show-team-manager-list', ['id' => $data->id]) }}" 
                                   class="profile-stats bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-500">Team Managers</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $team_manager_count }}</p>
                                        </div>
                                        <div class="bg-blue-100 p-3 rounded-full">
                                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </a>-->
                           {{-- @endif
                            @if(isset($data) && ($data->user_type == 'team_manager' || $data->user_type == 'operation_manager')) --}}
                               <!-- <a href="{{ route('admin.show-team-member-list', ['id' => $data->id]) }}" 
                                   class="profile-stats bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-500">Team Members</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $total_team_member }}</p>
                                        </div>
                                        <div class="bg-blue-100 p-3 rounded-full">
                                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </a>-->
                          {{--  @endif --}}
                            <a href="{{ route('admin.show-clients-list', ['id' => $data->id]) }}" 
                               class="profile-stats bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500">Leads</p>
                                        <p class="text-2xl font-bold text-gray-800">{{ count($clients) }}</p>
                                    </div>
                                    <div class="bg-green-100 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('admin.invoice_list', ['id' => $data->id]) }}" 
                               class="profile-stats bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500">Invoices</p>
                                        <p class="text-2xl font-bold text-gray-800">{{ $invoice_data }}</p>
                                    </div>
                                    <div class="bg-purple-100 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('admin.login-list', ['id' => $data->id]) }}" 
                               class="profile-stats bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500">Date wise Workign Hours</p>
                                        <p class="text-2xl font-bold text-gray-800">{{ count($user_login_details) }}</p>
                                    </div>
                                    <div class="bg-yellow-100 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                              <a href="{{ route('admin.login-times', ['id' => $data->id]) }}" 
                               class="profile-stats bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500">Login, Logout Times</p>
                                        <p class="text-2xl font-bold text-gray-800">{{ $loginLogoutCount}}</p>
                                    </div>
                                    <div class="bg-blue-100 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    {{-- @endif --}}
                </div>
            </div>
			<br>
        </div>
    </div>
</body>
		</div>
@include('admin.dashboard.footer')