@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}
@push('title')
    <title>Add Contact</title>
@endpush

<div>
      <div>
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
          <div class="breadcrumb-title pe-3"></div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Lead Details </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <a href="{{route('admin.create-invoice',['id'=>$customer->customer_id])}}" class="btn btn-success">Generate Invoice</a>
            
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
          <div class="main-body">
            <div class="row">
              <div class="col-lg-10 m-auto">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <img src="{{url('assets/images/team.png')}}" alt="Team Member" class="rounded-circle p-1 bg-primary" width="120">

                      <div class="mt-3">
                        <h4>{{$customer->customer_name}}</h4>
                        <p class="text-secondary mb-1">Email -{{$customer->customer_email}}</p>
                        <p class="text-muted font-size-sm">Number -{{$customer->customer_number}}</p>
                        <p class="text-muted font-size-sm">Service Name - {{$service_data->name}}</p>
                      
                        <!--<button class="btn btn-primary">Follow</button>
                        <button class="btn btn-outline-primary">Message</button>-->
                      </div>
                      <?php $id=encrypt($customer->customer_id);?>
                       <a href="{{route('admin.chat',['id'=>$id])}}" class="btn btn-primary btn-sm">Show Remarks</a>
                                    
                    </div>
                    <hr class="my-4" />
                    <ul class="list-group list-group-flush">
                     
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@include('admin.dashboard.footer')
