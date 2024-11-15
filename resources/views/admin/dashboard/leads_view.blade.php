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
                        <h4 class="my-2">{{$customer->customer_name}}</h4>
                        <div>
                            <button class="btn btn-primary" onclick="AddMoreService()" id="addmorebtn">Add Service</button>

                             <a href="#" class="" onclick="ChangeStatus({{$customer->customer_id}})">
                            @if($customer->status == '0')
                            <button class="btn btn-success">Enable</button>
                          </a>
                          @else <button class="btn btn-danger">Disable</button>
                          @endif
                        </div>

                        <div id="categoryTable" style="display: none; align-items: center; gap: 20px; ">
                            @foreach ($services as $item)
                               <td > <input type="checkbox" name="service_id[]" value="{{$item->service_id}}" style="width: 25px"></td>
                               <td class="text-mute">{{$item->name}}</td>
                            @endforeach

                        </div>
                       
                        <?php $id=encrypt($customer->customer_id);?>
                         <div><br></div>
                         <a href="{{ route('admin.call',['id'=>$id])}}"  class="btn btn-success" <?php if($customer->status == '0'){?> style="pointer-events: none; background: #d3d3d3; border: #d3d3d3" <?php } ?>><i class="fa fa-phone" aria-hidden="true"></i></a>
                        <a href="{{route('admin.send-email',['id'=>$id])}}"  class="btn btn-primary" <?php if($customer->status == '0'){?> style="pointer-events: none; background: #d3d3d3; border: #d3d3d3" <?php } ?>><i class="fa fa-envelope" aria-hidden="true"></i></a>
                    
                         <a href="{{route('admin.send-message',['id'=>$id])}}" class="btn btn-secondary" <?php if($customer->status == '0'){?> style="pointer-events: none; background: #d3d3d3; border: #d3d3d3" <?php } ?>><i class="fa fa-commenting" aria-hidden="true"></i></a> 
                          <a href="https://wa.me/{{$customer->customer_number}}" target="_blank" class="btn btn-success" <?php if($customer->status == '0'){?> style="pointer-events: none; background: #d3d3d3; border: #d3d3d3" <?php } ?>><i class="lni lni-whatsapp" aria-hidden="true"></i></a> 
                         <div> <br>
                            <div class="btn-group">
                              <a href="{{route('admin.show-invoice',['id'=>$customer->customer_id])}}" class="btn btn-success" <?php if($customer->status == '0'){?> style="pointer-events: none;background: #d3d3d3; border: #d3d3d3 " <?php } ?>>View Invoice</a>
                              &nbsp;
                              <a href="{{route('admin.create-invoice',['id'=>$customer->customer_id])}}" class="btn btn-success" <?php if($customer->status == '0'){?> style="pointer-events: none; background: #d3d3d3; border: #d3d3d3" <?php } ?>>Generate Invoice</a>
                            
                            </div>  
                         
                         </div>   <br>
                          <table class="table table-striped"> 
                              @foreach ($service_data as $item)
                            <tr>
                              <th>Service Name</th>
                              <td>{{$item->service_names}}</td>
                            </tr>
                            @endforeach
                            <tr>
                              <th>Type</th>
                              <td><?php if($customer->type==1){echo 'Individual'; }else if($customer->type==2){echo 'Business';}else{echo "...";}?></td>
                              <th>Email Address</th>
                              <td>{{$customer->customer_email}}</td>
                            </tr>
                            <tr>
                              <th>Phone Number</th>
                              <td>{{$customer->customer_number}}</td>
                              <th>Address</th>
                              <td>{{$customer->address}}</td> 
                            </tr>

                             <?php if($customer->business_name==null){?>
                              <tr>
                                <th>State</th>
                                <td>{{$customer->state}}</td>
                                <th>City</th>
                                <td>{{$customer->city}}</td>
                              </tr>

                               <tr>
                                <th>Zip Code</th>
                                <td>{{$customer->zip}}</td>
                                <th>Date Of Birth</th>
                                <td>{{$customer->dob}}</td>
                              </tr>
                              <tr>
                                <th>SSN </th>
                                <td>{{$customer->ssn}}</td>
                              </tr>
                              <?php } else{ ?>
                                <tr>
                                  <th>Business Name</th>
                                  <td>{{$customer->business_name}}</td>
                                  <th>Title</th>
                                  <td>{{$customer->business_title}}</td>
                                </tr>
                                <tr>
                                  <th>Industry</th>
                                  <td>{{$customer->industry}}</td>
                                  <th>EIN</th>
                                  <td>{{$customer->ein}}</td>
                                </tr>
                                 <tr>
                                  <th>FAX</th>
                                  <td>{{$customer->fax}}</td>
                                  <th>Point of Contact</th>
                                  <td>{{$customer->point_of_contact}}</td>
                                </tr>
                                <tr>
                                  <th>Contact Number</th>
                                  <td>{{$customer->contact_number}}</td>
                                  <th>Contact Email</th>
                                  <td>{{$customer->contact_email}}</td>
                                </tr>

                                <?php } ?>
                                <?php if(!empty($package_details)){
                                      foreach ($package_details as  $value) {
                                ?>
                                <tr>
                                  <th>Package Title</th>
                                 <?php if($value->package_id != ''){?>
                                  <td><?=$value->title?></td>
                                  <?php }else{?>
                                  <td><?=$value->custom_title?></td>

                                  <?php } ?>
                                </tr>
                                <?php } } ?>

                      </div>
                       <button class="btn btn-primary btn-sm" id="remarks" >Show Remarks</button> <br>
                                    
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
        $('#show_remarks').css.display="block";
        // $('#show_remarks').css.alignItems="center";
     });

     function AddMoreService(){
    $('#categoryTable').show(200);
      
     }

  </script>
@include('admin.dashboard.footer')
