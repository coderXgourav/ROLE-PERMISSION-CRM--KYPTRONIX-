 @include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Customer Remarks</title>
@endpush
      <div class="page-content"> 
        <div class="chat-wrapper" style="overflow-y: scroll;">

           <div class="chat-header d-flex align-items-center" style="position: static;"> 
                <div class="chat-toggle-btn">
                    <i class='bx bx-menu-alt-left'></i> 
                </div> 
                <div> 
                    <h4 class="mb-1 font-weight-bold">{{$customer->customer_name}}</h4> 
                    <div class="list-inline d-sm-flex mb-0 d-none">
                        <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><small class='bx bxs-circle me-1 chart-online'></small>Active Now</a>
                        <a href="{{route('team.invoices',['id'=>$customer->customer_id])}}" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-images me-1'></i>Invoices</a> <a  href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
                        <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-search me-1'></i>Find</a> 
                    </div>
                </div> 
                <div class="chat-top-header-menu ms-auto"> 
                    invoice
                    <a href="{{route('admin.create-invoice',['id'=>$customer->customer_id])}}"><i class='bx bx-chevron-right-square'></i></a>
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
              <!--start chat overlay--> 
             <div class="overlay chat-toggle-btn-mobile"></div>
            <!--end chat overlay-->
        </div> 
    </div>
 @include('admin.dashboard.footer')