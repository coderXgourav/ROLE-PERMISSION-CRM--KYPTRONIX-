	@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Send Emails</title>
@endpush
<style>
    .message{
     height: 50px;
    width: 400px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.w-5{
    display: none !important;
}
</style>
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            {{-- <div class="breadcrumb-title pe-3"></div> --}}
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    All Sent Emails
                  </li>
                </ol>
              </nav>
            </div>
          </div>
    {{-- <div class="email-content"> --}}
						{{-- <div class="card shadow"> --}}
                            <table id="email">

                            
							<div class="email-list">
                                @if(count($data)>0)
                                @foreach ($data as $item)
                                @php
                                    $id = encrypt($item->email_id);
                                @endphp
                                    <a href="{{route('admin.emailshow',['id'=>$id])}}">
									<div class="d-md-flex align-items-center email-message px-3 py-1">
										<div class="d-flex align-items-center email-actions">
										 {{-- <i class='bx bx-star font-20 mx-2 email-star'></i> --}}
											<p class="mb-0"><b>{{$item->customer_name}}</b>
											</p>
										</div>
										<div class="" >
											<div class="message"><p> {!!$item->email_text!!} </p>...</div>
										</div>
										<div class="ms-auto">
											<p class="mb-0 email-time">
                                                @php
                                                   echo  date('d-M-Y',strtotime($item->created_at));
                                                @endphp
                                                
                                                {{-- {{$item->created_at}} --}}
                                            </p>
										</div>
									</div>
								</a>
                                @endforeach
                              @else 
                              <h4 class="text-center text-danger"> Send Email Not Found</h4>
                                @endif
								
			
                                
							</div>
                            <div style="display: flex; justify-content:right;">
                                {{$data->links()}}
                            </div>
						{{-- </div> --}}
					{{-- </div> --}}

@include('admin.dashboard.footer')
