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
                        <p class="text-secondary mb-1">Type -<?php if($customer->type==1){echo 'Individual';}else if($customer->type==2){echo 'Business';}?></p>
                        <p class="text-muted font-size-sm">Service Name - {{$service_data->name}}</p>
                        <p class="text-secondary mb-1">Email -{{$customer->customer_email}}</p>
                        <p class="text-muted font-size-sm">Number -{{$customer->customer_number}}</p>

                        <?php if($customer->business_name==null){?>
                          <?php if(!empty($customer->dob)){?>
                           <p class="text-muted font-size-sm">Date Of Birth -{{$customer->dob}}</p>
                          <?php } ?>
                         
                          <?php if(!empty($customer->address)){?>
                           <p class="text-muted font-size-sm">Address -{{$customer->address}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->city)){?>
                            <p class="text-muted font-size-sm">City -{{$customer->city}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->state)){?>
                            <p class="text-muted font-size-sm">State -{{$customer->state}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->zip)){?>
                            <p class="text-muted font-size-sm">Zip -{{$customer->zip}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->ssn)){?>
                            <p class="text-muted font-size-sm">SSN -{{$customer->ssn}}</p>
                          <?php } ?>
                        <?php }else{ ?>
                          <p class="text-muted font-size-sm">Business Name -{{$customer->business_name}}</p>
                          <?php if(!empty($customer->business_title)){?>
                             <p class="text-muted font-size-sm">Title -{{$customer->business_title}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->industry)){?>
                             <p class="text-muted font-size-sm">Industry -{{$customer->industry}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->ein)){ ?>
                             <p class="text-muted font-size-sm">EIN -{{$customer->ein}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->address)){?>
                             <p class="text-muted font-size-sm">Address -{{$customer->address}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->city)){?>
                             <p class="text-muted font-size-sm">City -{{$customer->city}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->state)){?>
                            <p class="text-muted font-size-sm">State -{{$customer->state}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->zip)){?>
                            <p class="text-muted font-size-sm">Zip -{{$customer->zip}}</p>
                          <?php } ?>
                          <?php if(!empty($customer->point_of_contact)){?>
                            <p class="text-muted font-size-sm">Point of Contact -{{$customer->point_of_contact}}</p>
                          <?php } ?>
                        <?php } ?>

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
