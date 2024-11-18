@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}
@push('title')
    <title>Add Contact</title>
@endpush
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <style>
        .profile-card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .profile-image {
            width: 150px;
            height: 150px;
            border: 4px solid #0d6efd;
            padding: 3px;
            transition: transform 0.3s ease;
        }
        
        .profile-image:hover {
            transform: scale(1.05);
        }
        
        .action-buttons .btn {
            margin: 5px;
            transition: all 0.3s ease;
        }
        
        .action-buttons .btn:hover {
            transform: translateY(-2px);
        }
        
        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 8px 15px;
            border-radius: 20px;
        }
        
        .service-checkbox {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
        
        .remarks-section {
            max-height: 500px;
            overflow-y: auto;
        }
        
        .remark-card {
            border-radius: 10px;
            margin-bottom: 15px;
        }
        
        .chat-input {
            border-radius: 20px;
            padding: 10px 20px;
        }
        
        .info-table th {
            width: 150px;
            background-color: #f8f9fa;
        }
    </style>

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
        
 
<div class="container py-5">
    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card profile-card">
                <div class="position-relative">
                    <span class="status-badge {{ $customer->status == '1' ? 'bg-success' : 'bg-danger' }} text-white">
                        {{ $customer->status == '1' ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                
                <div class="card-body text-center">
                    <img src="{{url('assets/images/team.png')}}" 
                         class="rounded-circle profile-image mb-4" 
                         alt="{{$customer->customer_name}}"> 
                    
                    <h4 class="mb-3">{{$customer->customer_name}}</h4>
                    <p class="text-muted">
                        {{ $customer->type == 1 ? 'Individual Account' : 'Business Account' }}
                    </p>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button class="btn btn-primary" onclick="AddMoreService()" id="addmorebtn">
                            <i class="lni lni-circle-plus"></i> Add Service
                        </button>
                        
                        <a href="#" onclick="ChangeStatus({{$customer->customer_id}})" class="btn {{ $customer->status == '0' ? 'btn-success' : 'btn-danger' }}">
                            <i class="lni lni-warning"></i> 
                            {{ $customer->status == '0' ? 'Enable' : 'Disable' }}
                        </a>
                    </div>

                    <!-- Service Selection -->
                    <div id="categoryTable" class="mt-4" style="display: none;">
                        <div class="row g-2">
                            <span>Select One Service</span>
                            <hr>
                            @foreach ($services as $item)
                            <div class="col-12">
                                <div class="form-check text-start">
                                    <input type="checkbox" 
                                           class="form-check-input service-checkbox"  
                                           name="service_id" 
                                           value="{{$item->service_id}}">
                                    <label class="form-check-label">{{$item->name}}</label>
                                </div>

                            </div>

                            @endforeach
                        </div>
                    </div>
                    <!-- Sub Service -->
                     <div class="mt-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <hr>
                                <div class="form-check text-start" id="subservices"></div>
                            </div>

                        </div>
                       

                    </div>
    
                  <!-- Communication Buttons -->
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <a href="{{ route('admin.call', ['id' => encrypt($customer->customer_id)]) }}" 
                           class="btn btn-outline-success {{ $customer->status == '0' ? 'disabled' : '' }}">
                          <i class="fa fa-phone" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('admin.send-email', ['id' => encrypt($customer->customer_id)]) }}" 
                           class="btn btn-outline-primary {{ $customer->status == '0' ? 'disabled' : '' }}">
                          <i class="fa fa-envelope" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('admin.send-message', ['id' => encrypt($customer->customer_id)]) }}" 
                           class="btn btn-outline-secondary {{ $customer->status == '0' ? 'disabled' : '' }}">
                          <i class="fa fa-commenting" aria-hidden="true"></i>
                        </a>
                        <a href="https://wa.me/{{$customer->customer_number}}" 
                           target="_blank" 
                           class="btn btn-outline-success {{ $customer->status == '0' ? 'disabled' : '' }}">
                            <i class="lni lni-whatsapp"></i>
                        </a>
                    </div>

                    <!-- Invoice Buttons -->
                    <div class="mt-4">
                        <a href="{{route('admin.show-invoice',['id'=>$customer->customer_id])}}" 
                           class="btn btn-success {{ $customer->status == '0' ? 'disabled' : '' }} me-2">
                          View Invoice
                        </a>
                        <a href="{{route('admin.create-invoice',['id'=>$customer->customer_id])}}" 
                           class="btn btn-success {{ $customer->status == '0' ? 'disabled' : '' }}">
                           Generate Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="col-lg-8">
            <div class="card profile-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-light">Customer Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover info-table">
                        @foreach ($service_data as $item)
                        <tr>
                            <th>Service Name</th>
                            <td>{{$item->service_names}}</td>
                        </tr>
                        @endforeach
                        
                        <tr>
                            <th>Email</th>
                            <td>{{$customer->customer_email}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$customer->customer_number}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$customer->address}}</td>
                        </tr>

                        @if($customer->business_name == null)
                            <!-- Individual Customer Fields -->
                            <tr>
                                <th>State</th>
                                <td>{{$customer->state}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{$customer->city}}</td>
                            </tr>
                            <tr>
                                <th>Zip Code</th>
                                <td>{{$customer->zip}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{$customer->dob}}</td>
                            </tr>
                            <tr>
                                <th>SSN</th>
                                <td>{{$customer->ssn}}</td>
                            </tr>
                        @else
                            <!-- Business Customer Fields -->
                            <tr>
                                <th>Business Name</th>
                                <td>{{$customer->business_name}}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>{{$customer->business_title}}</td>
                            </tr>
                            <tr>
                                <th>Industry</th>
                                <td>{{$customer->industry}}</td>
                            </tr>
                            <tr>
                                <th>EIN</th>
                                <td>{{$customer->ein}}</td>
                            </tr>
                            <tr>
                                <th>FAX</th>
                                <td>{{$customer->fax}}</td>
                            </tr>
                            <tr>
                                <th>Point of Contact</th>
                                <td>{{$customer->point_of_contact}}</td>
                            </tr>
                            <tr>
                                <th>Contact Number</th>
                                <td>{{$customer->contact_number}}</td>
                            </tr>
                            <tr>
                                <th>Contact Email</th>
                                <td>{{$customer->contact_email}}</td>
                            </tr>
                        @endif

                        @if(!empty($package_details))
                            @foreach ($package_details as $value)
                            <tr>
                                <th>Package Title</th>
                                <td>
                                    @if($value->package_id != '')
                                        {{$value->title}}
                                    @else
                                        {{$value->custom_title}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </table>

                    <!-- Remarks Section -->
                    <div class="mt-4">
                        <button class="btn btn-primary" onclick="toggleRemarks()">
                          <i class="fa fa-eye" aria-hidden="true"></i> Show Remarks
                        </button>
                    </div>

                    <div id="show_remarks" class="mt-4 remarks-section" style="display: none;">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"> Customer Remarks</h5>
                            </div>
                            <div class="card-body">
                                @if(!empty($data))
                                    @foreach($data as $value)
                                    <div class="remark-card p-3 {{ $loop->odd ? 'bg-light' : 'bg-white' }}">
                                        <div class="d-flex align-items-start">
                                            <img src="/assets/images/user.png" 
                                                 class="rounded-circle me-3" 
                                                 width="40" 
                                                 height="40" 
                                                 alt="User">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">{{$value->first_name}} {{$value->last_name}}</h6>
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}
                                                    </small>
                                                </div>
                                                <small class="text-muted d-block">{{$value->user_type}}</small>
                                                <p class="mt-2 mb-0">{{$value->remark}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            
                            <!-- Remarks Input Form -->
                            <div class="card-footer bg-white">
                                <form id="remark_form" class="d-flex gap-2">
                                    @csrf
                                    <input type="hidden" name="team_member_id" value="{{$customer->team_member}}">
                                    <input type="hidden" name="customer_id" value="{{$customer->customer_id}}">
                                    <input type="hidden" name="role" value="{{$admin_data->user_type}}">
                                    <input type="hidden" name="user_id" value="{{$admin_data->id}}">
                                    
                                    <input type="text" 
                                           class="form-control chat-input" 
                                           name="remark" 
                                           placeholder="Type your remark...">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bxs-send"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

      </div>
    </div>
<script>
function toggleRemarks() {
    const remarksSection = document.getElementById('show_remarks');
    remarksSection.style.display = remarksSection.style.display === 'none' ? 'block' : 'none';
}

function AddMoreService() {
    const categoryTable = document.getElementById('categoryTable');
    categoryTable.style.display === 'none' ? 'block' : 'none';
}

function AddMoreService() {
    const categoryTable = document.getElementById('categoryTable');
    categoryTable.style.display === 'none' ? 'block' : 'none';
}

// Add your existing JavaScript functions here
</script>
   <script type="text/javascript">
     $('#remarks').click(function(){
        $('#show_remarks').css.display="block";
        // $('#show_remarks').css.alignItems="center";
     });

     function AddMoreService(){
    $('#categoryTable').show(200);
      
     }
     $(document).ready(function() {
            $('.service-checkbox').on('change', function() {
                var selectedServiceIds = [];
                $('.service-checkbox:checked').each(function() {
                    selectedServiceIds.push($(this).val());
                });

                if (selectedServiceIds.length === 0) {
                    $('#subservices').html('');
                    return;
                }


  const checkboxes = document.querySelectorAll('.service-checkbox');

    // checkboxes.forEach(checkbox => {
    //   checkbox.addEventListener('click', function() {
    //     if (this.checked) {
    //       checkboxes.forEach(cb => {
    //         if (cb !== this) {
    //           cb.checked = false;
    //         }
    //       });
    //     }
    //   });
    // });



                $.ajax({
                    url: '/admin/subservices/' + selectedServiceIds.join(','),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var subserviceHtml = '<p class="text-center">Choose Sub-Services </p>';
                        if (response.length > 0) {
                            response.forEach(function(subservices) {
                                subserviceHtml += '<input type="checkbox" class="form-check-input subservice-checkbox " name="subservices[]" value="' + subservices.id + '" /><label class="form-check-label"> ' + subservices.service_name + '</label><br>';
                            });
                        } else {
                            subserviceHtml = '<p style="color:red">No subservices available for the selected service.</p>';
                        }
                        $('#subservices').html(subserviceHtml);
                    },
                    error: function() {
                        alert('Error fetching subservices.');
                    }
                });
            });
        });
  </script>
@include('admin.dashboard.footer')
