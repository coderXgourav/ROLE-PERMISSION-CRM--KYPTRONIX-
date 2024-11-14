@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}
@push('title')
    <title>Add Contact</title>
@endpush
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        <h4>{{$customer->customer_name}}</h4><br>
                        <?php $id=encrypt($customer->customer_id);?>
                         
                         <a href="{{ route('admin.call',['id'=>$id])}}"  class="btn btn-success" <?php if($customer->status == '0'){?> style="pointer-events: none; background: #d3d3d3; border: #d3d3d3" <?php } ?>><i class="fa fa-phone" aria-hidden="true"></i></a>
                        <a href="{{route('admin.send-email',['id'=>$id])}}"  class="btn btn-primary" <?php if($customer->status == '0'){?> style="pointer-events: none; background: #d3d3d3; border: #d3d3d3" <?php } ?>><i class="fa fa-envelope" aria-hidden="true"></i></a>
                    
                         <a href="{{route('admin.send-message',['id'=>$id])}}" class="btn btn-secondary" <?php if($customer->status == '0'){?> style="pointer-events: none; background: #d3d3d3; border: #d3d3d3" <?php } ?>><i class="fa fa-commenting" aria-hidden="true"></i></a> 

                          <a href="#" class="" onclick="ChangeStatus({{$customer->customer_id}})">
                            @if($customer->status == '0')
                            <button class="btn btn-success">Enable</button>
                          </a>
                          @else <button class="btn btn-danger">Disable</button>
                          @endif


                         <div> <br>
                            <div class="btn-group">
                              <a href="{{route('admin.show-invoice',['id'=>$customer->customer_id])}}" class="btn btn-success" <?php if($customer->status == '0'){?> style="pointer-events: none;background: #d3d3d3; border: #d3d3d3 " <?php } ?>>View Invoice</a>
                              &nbsp;
                              <a href="{{route('admin.create-invoice',['id'=>$customer->customer_id])}}" class="btn btn-success" <?php if($customer->status == '0'){?> style="pointer-events: none; background: #d3d3d3; border: #d3d3d3" <?php } ?>>Generate Invoice</a>
                            
                            </div>  
                         
                         </div>   <br>
                           <?php $id=encrypt($customer->customer_id);?>
                      <!-- <a href="{{route('admin.chat',['id'=>$id])}}" class="btn btn-primary btn-sm ">Show Remarks</a>-->
                        <button class="btn btn-primary btn-sm" id="remarks" >Show Remarks</button>

                        <p class="text-secondary mb-1"><br>Type -<?php if($customer->type==1){echo 'Individual';}else if($customer->type==2){echo 'Business';}?></p>
                        <?php if(!empty($service_data)){?>
                          <p class="text-muted font-size-sm">Service Name - <?php foreach($service_data as $val){echo $val->service_names;}?></p>
                        <?php } ?>
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
                           <?php if(!empty($customer->fax)){ ?>
                             <p class="text-muted font-size-sm">FAX -{{$customer->fax}}</p>
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
                                  <?php if(!empty($customer->business_title)){?>
                            <p class="text-muted font-size-sm">Point of Contact -{{$customer->business_title}}</p>
                          <?php } ?>

                             <?php if(!empty($customer->contact_number)){ ?>
                             <p class="text-muted font-size-sm">Contact Number -{{$customer->contact_number}}</p>
                          <?php } ?>
                              <?php if(!empty($customer->contact_email)){ ?>
                             <p class="text-muted font-size-sm">Contact Email -{{$customer->contact_email}}</p>
                          <?php } ?>


                        <?php } ?>

                        <!--<button class="btn btn-primary">Follow</button>
                        <button class="btn btn-outline-primary">Message</button>-->
                      </div>
                    
                                    
                    </div>
                    <hr class="my-4" />
                    <ul class="list-group list-group-flush">
                     
                    </ul>
                  </div>
                        <!--Show Remarks Start-->
                        <div class="page-content" style="display: none;" id="show_remarks"> 
                          <div class="chat-wrapper" style="overflow: scroll; height: 500px; padding: 0px 0px 38px 0px;">

                           <div class="chat-header d-flex align-items-center" style="position: static;"> 
                            <div class="chat-toggle-btn">
                              <i class='bx bx-menu-alt-left'></i> 
                            </div> 
                            <div> 
                              <h4 class="mb-1 font-weight-bold">{{$customer->customer_name}}</h4> 
                              <div>
                                 <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><small class='bx bxs-circle me-1 chart-online'></small>Remarks</a>
                              </div>
                            
                            </div> 
                           
                          </div>
                          <div class="chat-content" style="margin-left: 0px; height: auto;"> 

                           <?php 
                           if(!empty($data)){
                            foreach ($data as $key => $value) {
                             ?>
                             <div class="chat-content-leftside"> 
                              <div class  ="d-flex">
                               <img src="/assets/images/user.png" width="48"
                               height="48" class="rounded-circle" alt /> 
                               <div class="flex-grow-1 ms-2"> 
                                {{-- <p class="mb-0 chat-time">{{$value->customer_name}}</p>  --}}  
                                <p class="chat-left-msg">{{$value->first_name}} {{$value->last_name}}</p> 
                                <p class="mb-0 chat-time">{{$value->user_type}}</p> 

                              </div> 
                            </div> 
                          </div>

                          <div class="chat-content-rightside">   
                            <div class="d-flex ms-auto">
                             <div class="flex-grow-1 me-2"> 
                              <p class="mb-0 chat-time text-end" id="time-ago">

                                <?php $dateTime = new DateTime($value->created_at);
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
                                ?> 

                              </p>
                              <p class="chat-right-msg">{{$value->remark}}</p> 
                            </div>
                            </div> 
                          </div>  


                          <?php } } ?> 

                    </div> 
                                     
                                  <!--start chat overlay--> 
                               <div class="overlay chat-toggle-btn-mobile"></div>
                              <!--end chat overlay-->
                          </div> 
                      </div>
                       <form id="remark_form">
                                        <input type="hidden" name="team_member_id" value="{{$customer->team_member}}">
                                        <input type="hidden" name="customer_id" value="{{$customer->customer_id}}">
                                        <input type="hidden" name="role" value="{{$admin_data->user_type}}">
                                        <input type="hidden" name="user_id" value="{{$admin_data->id}}">

                                        {{@csrf_field()}}
                                        <div class="chat-footer d-flex align-items-center" style="position:absolute; left:0;"> 
                                         <div class="flex-grow-1 pe-2"> 
                                          <div class="input-group"> 
                                        <!--   <span class="input-group-text">
                                              <i class='bx bx-smile'></i>
                                            </span>  -->
                                            <input type="text" class="form-control" name="remark" placeholder="Type Remark"> 
                                          </div> 
                                        </div> 
                                        <div class="chat-footer-menu"> 
                                     <!--  <a href="javascript:;">
                                          <i class='bx bx-file'></i>
                                        </a>  -->
                                        <button type="submit"><i class='bx bxs-send'></i></button>
                                        <!-- <a href="javascript:;"><i class='bx bx-microphone'></i></a> -->
                                        <!-- <a href="javascript:;"><i class='bx bx-dots-horizontal-rounded'></i></a> -->
                                      </div> 
                                    </div> 
                                  </form>
                        <!--Show Remarks End-->    
                      
                </div>

              </div>
              <div class="col-lg-8">

             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   <script type="text/javascript">
     $('#remarks').click(function(){
        $('#show_remarks').show();
     });
  </script>
@include('admin.dashboard.footer')
