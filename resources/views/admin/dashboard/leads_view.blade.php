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

        /* .service-tree {
    padding: 1.5rem;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
} */

.tree-item {
    position: relative;
    margin: 0.5rem 0;
}

.tree-content {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    border-radius: 0.375rem;
    transition: background-color 0.2s;
}

.tree-content:hover {
    background-color: #f0f7ff;
}

.tree-toggle {
    background: none;
    border: none;
    padding: 0.25rem;
    margin-right: 0.5rem;
    cursor: pointer;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.2s;
}

.tree-toggle:hover {
    background-color: #e1effe;
}

.tree-toggle i {
    transition: transform 0.2s;
}

.tree-toggle.expanded i {
    transform: rotate(90deg);
}

.tree-children {
    margin-left: 2.5rem;
    position: relative;
    display: none;
}

.tree-children::before {
    content: '';
    position: absolute;
    left: -1rem;
    top: 0;
    bottom: 0;
    width: 1px;
    background-color: #e5e7eb;
}

.tree-children.show {
    display: block;
}

.tree-item-label {
    /* display: flex; */
    /* align-items: center;
    flex: 1;
    cursor: pointer;
    font-size: 0.95rem; */
}

.tree-checkbox {
    margin-right: 0.75rem;
    width: 1.125rem;
    height: 1.125rem;
    border-radius: 0.25rem;
    border: 2px solid #d1d5db;
    transition: all 0.2s;
}

.tree-checkbox:checked {
    border-color: #2563eb;
    background-color: #2563eb;
}

.package-info {
    margin-left: auto;
    font-size: 0.875rem;
    color: #6b7280;
}

.main-service {
    background-color: #f9fafb;
    font-weight: 600;
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
                         alt="{{ucwords($customer->customer_name)}}"> 
                    
                    <h4 class="mb-3">{{ucwords($customer->customer_name)}}</h4>
                    <p class="text-muted">
                        {{ $customer->type == 1 ? 'Individual Account' : 'Business Account' }}
                    </p>


                      <div class="d-flex justify-content-center gap-2">
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
                    </div> <br>
                   <form id="add-service">
                     {{@csrf_field()}}
                    <!-- Service Selection -->
                   <?php if(!empty($service_data[0]->customer_ids)){ ?>
                    <input type="hidden" name="customer_id" value="{{$service_data[0]->customer_ids}}">
                  <?php }else{ ?>
                    <input type="hidden" name="customer_id" value="{{$customer->customer_id}}">

                  <?php } ?>

{{-- <div id="categoryTable" class="service-tree">
    @foreach ($data as $mainService)
    <div class="tree-item">
        <!-- Main Service -->
        <div class="tree-content main-service">
            <button type="button" class="tree-toggle" onclick="toggleTreeItem(this)">
                <i class="fa fa-chevron-right"></i>
            </button>
            <label class="tree-item-label">
                <input type="checkbox" class="tree-checkbox" name="main_service_id[]" value="{{ $mainService->service_id }}">
                {{ $mainService->name }}
            </label>
        </div>

        <!-- Services under Main Service -->
        <div class="tree-children">
            @foreach ($mainService->services as $service)
            <div class="tree-item">
                <div class="tree-content">
                    <button type="button" class="tree-toggle" onclick="toggleTreeItem(this)">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                    <label class="tree-item-label">
                        <input type="checkbox" class="tree-checkbox" name="service_id[]" value="{{ $service->id }}">
                        {{ $service->service_name }}
                    </label>
                </div>

                <!-- Sub-Services under Service -->
                <div class="tree-children">
                    @foreach ($service->subServices as $subService)
                    <div class="tree-item">
                        <div class="tree-content">
                            <button type="button" class="tree-toggle" onclick="toggleTreeItem(this)">
                                <i class="fa fa-chevron-right"></i>
                            </button>
                            <label class="tree-item-label">
                                <input type="checkbox" class="tree-checkbox" name="sub_service_id[]" value="{{ $subService->sub_subservice_id }}">
                                {{ $subService->sub_subservice_name }}
                            </label>
                        </div>

                        <!-- Packages under Sub-Service -->
                        <div class="tree-children">
                            @foreach ($subService->packages as $package)
                            <div class="tree-item">
                                <div class="tree-content">
                                    <label class="tree-item-label">
                                        <input type="checkbox" class="tree-checkbox" name="package_id[]" value="{{ $package->package_id }}">
                                        {{ $package->title }}
                                        <span class="package-info">Price: ${{ $package->price }}, Duration: {{ $package->duration }} Days</span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <!-- Packages under Service -->
            @foreach ($service->packages as $package)
            <div class="tree-item">
                <div class="tree-content">
                    <label class="tree-item-label">
                        <input type="checkbox" class="tree-checkbox" name="package_id[]" value="{{ $package->package_id }}">
                        {{ $package->title }}
                        <span class="package-info">Price: ${{ $package->price }}, Duration: {{ $package->duration }} Days</span>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div> --}}


<div id="categoryTable" class="service-tree">
    @foreach ($data as $mainService)
    <div class="tree-item">
        <!-- Main Service -->
        <div class="tree-content main-service">
            <button type="button" class="tree-toggle" onclick="toggleTreeItem(this)">
                <i class="fa fa-chevron-right"></i>
            </button>
            <label class="tree-item-label">
                <input type="checkbox" class="tree-checkbox" name="main_service_id[]" value="{{ $mainService->service_id }}" 
                @if($mainService->packages->pluck('package_id')->intersect($customer_packages->pluck('package_id'))->isNotEmpty() || $mainService->services->pluck('id')->intersect($customer_packages->pluck('service_id'))->isNotEmpty()) checked @endif>
                {{ $mainService->name }}
            </label>
        </div>

        <!-- Packages under Main Service -->
        <div class="tree-children">
            @foreach ($mainService->packages as $package)
            <div class="tree-item">
                <div class="tree-content">
                    <label class="tree-item-label">
                        <input type="checkbox" class="tree-checkbox" name="package_id[]" value="{{ $package->package_id }}" 
                        @if(in_array($package->package_id, $customer_packages->pluck('package_id')->toArray())) checked @endif>
                        {{ $package->title }}
                        <span class="package-info">Price: ${{ $package->price }}, Duration: {{ $package->duration }} Days</span>
                    </label>
                </div>
            </div>
            @endforeach

            <!-- Services under Main Service -->
            @foreach ($mainService->services as $service)
            <div class="tree-item">
                <div class="tree-content">
                    <button type="button" class="tree-toggle" onclick="toggleTreeItem(this)">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                    <label class="tree-item-label">
                        <input type="checkbox" class="tree-checkbox" name="service_id[]" value="{{ $service->id }}" 
                        @if($service->packages->pluck('package_id')->intersect($customer_packages->pluck('package_id'))->isNotEmpty() || $service->subServices->pluck('sub_subservice_id')->intersect($customer_packages->pluck('sub_service_id'))->isNotEmpty()) checked @endif>
                        {{ $service->service_name }}
                    </label>
                </div>

                <!-- Packages under Service -->
                <div class="tree-children">
                    @foreach ($service->packages as $package)
                    <div class="tree-item">
                        <div class="tree-content">
                            <label class="tree-item-label">
                                <input type="checkbox" class="tree-checkbox" name="package_id[]" value="{{ $package->package_id }}" 
                                @if(in_array($package->package_id, $customer_packages->pluck('package_id')->toArray())) checked @endif>
                                {{ $package->title }}
                                <span class="package-info">Price: ${{ $package->price }}, Duration: {{ $package->duration }} Days</span>
                            </label>
                        </div>
                    </div>
                    @endforeach

                    <!-- Sub-Services under Service -->
                    @foreach ($service->subServices as $subService)
                    <div class="tree-item">
                        <div class="tree-content">
                            <button type="button" class="tree-toggle" onclick="toggleTreeItem(this)">
                                <i class="fa fa-chevron-right"></i>
                            </button>
                            <label class="tree-item-label">
                                <input type="checkbox" class="tree-checkbox" name="sub_service_id[]" value="{{ $subService->sub_subservice_id }}" 
                                @if($subService->packages->pluck('package_id')->intersect($customer_packages->pluck('package_id'))->isNotEmpty()) checked @endif>
                                {{ $subService->sub_subservice_name }}
                            </label>
                        </div>

                        <!-- Packages under Sub-Service -->
                        <div class="tree-children">
                            @foreach ($subService->packages as $package)
                            <div class="tree-item">
                                <div class="tree-content">
                                    <label class="tree-item-label">
                                        <input type="checkbox" class="tree-checkbox" name="package_id[]" value="{{ $package->package_id }}" 
                                        @if(in_array($package->package_id, $customer_packages->pluck('package_id')->toArray())) checked @endif>
                                        {{ $package->title }}
                                        <span class="package-info">Price: ${{ $package->price }}, Duration: {{ $package->duration }} Days</span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>



<br>
   <div class="action-buttons">
                        <button class="btn btn-primary" onclick="AddMoreService()" id="addmorebtn">
                            <i class="lni lni-circle-plus"></i> Update
                        </button>
                        <a href="#" onclick="ChangeStatus('{{$customer->customer_id}}','{{$customer->status}}')" class="btn {{ $customer->status == '0' ? 'btn-success' : 'btn-danger' }}">
                            <i class="lni lni-warning"></i> 
                            {{ $customer->status == '0' ? 'Enable' : 'Disable' }}
                        </a>
                    </div>




 
                    
                   </form>

                  <!-- Communication Buttons -->
                  

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
                           @php
                            $no = 1;
                       @endphp
                        @foreach ($service_data as $item)
                       
                        <tr>
                            <th>Service {{$no++}}</th>
                            <td>{{$item->name}}</td>
                        </tr>
                        @endforeach
                       @php
                            $no = 1;
                       @endphp
                          @foreach ($subservices as $item)
                        <tr>
                            <th>Sub Service {{$no++}} </th>
                            <td>{{$item->service_name}}</td>
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
                        @if(!empty($customer_packages))
                            @php
                            $no = 1;
                       @endphp
                            @foreach ($customer_packages as $value)
                            <tr>
                                <th>Package {{$no++}}</th>
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
                                @if(!empty($remark))
                                    @foreach($remark as $value)
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
function toggleTreeItem(button) {
    const treeContent = button.closest('.tree-content');
    const treeChildren = treeContent.nextElementSibling;
    const icon = button.querySelector('i');
    
    // Toggle the expanded class on the button
    button.classList.toggle('expanded');
    
    // Toggle the show class on the children container
    if (treeChildren) {
        treeChildren.classList.toggle('show');
    }
    
    // Rotate the chevron icon
    if (button.classList.contains('expanded')) {
        icon.style.transform = 'rotate(90deg)';
    } else {
        icon.style.transform = 'rotate(0)';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.tree-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const treeItem = this.closest('.tree-item');
            const childCheckboxes = treeItem.querySelectorAll('.tree-children .tree-checkbox');
            
            // Check/uncheck all child checkboxes
            childCheckboxes.forEach(childBox => {
                childBox.checked = this.checked;
            });
            
            // Update parent checkboxes
            updateParentCheckboxes(this);
        });
    });
});

function updateParentCheckboxes(checkbox) {
    let parent = checkbox.closest('.tree-children');
    
    while (parent) {
        const parentCheckbox = parent.previousElementSibling.querySelector('.tree-checkbox');
        const siblings = parent.querySelectorAll(':scope > .tree-item > .tree-content > .tree-item-label > .tree-checkbox');
        const allChecked = Array.from(siblings).every(sibling => sibling.checked);
        const someChecked = Array.from(siblings).some(sibling => sibling.checked);
        
        parentCheckbox.checked = allChecked;
        parentCheckbox.indeterminate = !allChecked && someChecked;
        
        parent = parent.parentElement.closest('.tree-children');
    }
}
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
          var checkedValue=$(".service-checkbox").is(":checked");
          if(checkedValue==true){
              var selectedServiceIds = [];
                $('.service-checkbox:checked').each(function() {
                   selectedServiceIds.push($(this).val());
                   fetchSubServices(selectedServiceIds);
                   fetchPackages(selectedServiceIds);

                });

          }
            $('.service-checkbox').on('change', function() {
                var selectedServiceIds = [];
                $('.service-checkbox:checked').each(function() {
                   selectedServiceIds.push($(this).val());
                   fetchSubServices(selectedServiceIds);
                   fetchPackages(selectedServiceIds);

                });

                if (selectedServiceIds.length === 0) {
                    $('#subservices').html('');
                    return;
                }
                if (selectedServiceIds.length === 0) {
                    $('#packages').html('');
                    return;
                }
             });

    });
      
     function fetchSubServices(serviceIds){
        $.ajax({
                    url: '/admin/subservices/' + serviceIds.join(','),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {

                        var subserviceHtml = '<hr><p class="text-center">Choose Sub-Services </p>';

                        if (response.length > 0) {
                            const sub_service = $("#subservices_id").val();
                            const sub_service_array = sub_service.split(",");

                          response.forEach(function(subservices) {
                        // Check if subservices.id is in the sub_service_array
                      const isChecked = sub_service_array.includes(subservices.id.toString());  // Ensure both are compared as strings

                            // If it matches, mark the checkbox as checked
                            subserviceHtml += '<input type="checkbox" class="form-check-input subservice-checkbox" name="subservices[]" value="' + subservices.id + '" ' + (isChecked ? 'checked' : '') + ' />';
                            subserviceHtml += '<label class="form-check-label"> ' + subservices.service_name + '</label><br>';
                        });
                        } else {
                            subserviceHtml = '';
                        }
                        $('#subservices').html(subserviceHtml);
                    },
                    error: function() {
                        alert('Error fetching subservices.');
                    }
        });

     }
     function fetchPackages(serviceIds){
        $.ajax({
                    url: '/admin/package_details/' + serviceIds.join(','),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {

                        var packageHtml = '<hr><p class="text-center">Choose Package </p>';

                        if (response.length > 0) {
                            const packages = $("#packagesid").val();
                            const packages_array = packages.split(",");

                          response.forEach(function(packages) {
                             const isChecked = packages_array.includes(packages.package_id.toString());  // Ensure both are compared as strings
                            // If it matches, mark the checkbox as checked
                            packageHtml += '<input type="checkbox" class="form-check-input subservice-checkbox" name="packages[]" value="' + packages.package_id + '" ' + (isChecked ? 'checked' : '') + ' />';
                            packageHtml += '<label class="form-check-label"> ' + packages.title + '</label><br>';
                        });
                        } else {
                            packageHtml = '';
                        }
                        $('#packages').html(packageHtml);
                    },
                    error: function() {
                        alert('Error fetching packages.');
                    }
        });

     }
  </script>
@include('admin.dashboard.footer')
