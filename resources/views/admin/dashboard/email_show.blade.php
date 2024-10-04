	@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title> Email Show</title>
@endpush
{{-- <div class="email-content"> --}}
						<div class="email-read-box ">
						<div class="card" style="padding:25px;">
							<div class="p-4">
									<div class="d-flex align-items-center">
								<img src="{{url('/assets/images/admin.png')}}" width="42" height="42" class="rounded-circle" alt="" />
								<div class="flex-grow-1 ms-2">
									<p class="mb-0 font-weight-bold">{{$data->customer_name}}</p>
									<div class="dropdown">
										<div >Send By <b>{{$data->name}}</b></div>
									
									</div>
								</div>
								{{-- <p class="mb-0 chat-time ps-5 ms-auto">Sep 15, 2020, 11:04 PM (19 hours ago)</p> --}}
							</div>
							</div>
						<div> <br>
                            {!! $data->email_text!!}
                        </div>
						</div>
						</div>
					{{-- </div> --}}
	@include('admin.dashboard.footer')
