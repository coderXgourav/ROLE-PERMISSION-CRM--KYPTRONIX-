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
										<div >Sent By <b>{{$data->first_name}} {{$data->last_name}}, 	<span class="text-primary">@if($data->user_type == "customer_success_manager"){{"Team Member"}} @elseif($data->user_type == "team_manager") {{"Team Manager"}}  @elseif($data->user_type == "operation_manager") {{"Operation Manager"}} @else  {{"Admin"}} @endif</span></b></div>
										<span > <?php $dateTime = new DateTime($data->created_at);
$now = new DateTime();

$interval = $now->diff($dateTime);

if ($interval->y > 0) {
    $timeAgo = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
} elseif ($interval->m > 0) {
    $timeAgo = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
} elseif ($interval->d > 0) {
    $timeAgo = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
} elseif ($interval->h > 0) {
    $timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
} elseif ($interval->i > 0) {
    $timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
} else {
    $timeAgo = 'just now';
}

echo $timeAgo;
 ?>   </span>
									
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
