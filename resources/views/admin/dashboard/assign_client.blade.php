
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title> Customers/Clients Table</title>
@endpush
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<div class="card">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
					<div class="card-body">
						<div class="table-responsive">
								<div >
									<form action={{route('admin.assign')}} method="GET">
										<div class="row">
										<div class="col-md-4">
								<select name="service"  class="form-control" id="" >
									<option value="">Filter Services</option>
									@foreach ($services as $item)
										<option {{ request('service') == $item->service_id ? 'selected' : '' }} value="{{$item->service_id}}">{{$item->name}}</option>
									@endforeach
									
								</select>
										</div>
										<div class="col-md-2"><button type="submit" class="btn btn-success">Search</button></div>
									</div>
								
								</form> <br>
								</div>
								{{-- <div class="bg-info" style="padding: 2px;">
									<p class="text-light text-center ">Please select only one type of lead. Selecting multiple service leads will disable the assignment feature</p>
								</div> --}}
								<br>
							<form id="update_assign_client_form">
							<table id="myTable" class="table table-striped table-bordered" style="width:100%">
							
								<thead>
									<tr>
										<th style="display: flex; justify-content: center;align-items: center">Select All &nbsp;<input type="checkbox" id="selectAll" onclick="toggleAll(this)" style="width:22px;"> </th>
										<th>No.</th>
										<th>Name</th>
										<th>Mobile No.</th>
										<th>Email</th>
										<th>Service</th>
										<th>Message</th>
										<th>Show Details</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)

                                    <tr>
										<td style="display:flex; justify-content:center;"><input type="checkbox" service_id={{$value->service_id}}  value="{{$value->customer_id}}" name="customer[]" required style="width:22px;" onclick="getLeads(this.value,{{$value->service_id}})"> </td>
										{{@csrf_field()}}
										<td>{{$i++}}</td>
										<td>{{$value->customer_name}}</td>
										<td>{{$value->customer_number}}</td>
										<td>{{$value->customer_email}}</td>
										<td>{{$value->name}}</td>
										<td>{{$value->msg}}</td>
										<td><a href="{{route('admin.view_assign_client',['id'=>$value->customer_id])}}" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
									</tr>
                                    @endforeach
                                    @else  
                                    <tr>
										<td colspan="8" style="text-align: center; color:red;"><b>Customer Records Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>

							{{-- <div style="display: flex; justify-content:center; margin-bottom: 20px">
								<h6 class="text-primary"><b>You can assign 10 Clients at once</b></h6>
								</div>  --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose Customer Success Manager </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> <br>
     {{-- <select name="team_member[]" id="team_member" class="form-control" multiple>
    <option value="">Select Team Member</option>
</select> --}}
<div id="team_member_container">
    <p>Select Team Members:</p>
    <!-- Checkboxes will be appended here -->
</div>
<br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
							</table>
							  @if(count($data)>0)
							<div style="display: flex; justify-content:center; margin-bottom: 20px; margin-top:20px;">
								 <button class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModal" id="assign" style="background-color: #38833c; border:1px solid #38833c; width:500px;">Update Customer success Manager</button>
								</div>
								@endif
							</form>
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>

<script>
	let leads = [];
	let service = [];

	function getLeads(id,service_id){
		console.log(id, service_id);
		
		if(leads.includes(id)  && service.includes(service_id)){
			leads.splice(leads.indexOf(id), 1);
			service.splice(service.indexOf(service_id), 1);
				console.log(allValuesSame(service));
		}else{
			leads.push(id);
			service.push(service_id);
			console.log(allValuesSame(service));
		}

	}

	function allValuesSame(array) {
   
		$.ajax({
    url: "/admin/get_service_based_member",
    method: "GET",
    dataType: "JSON",
    data: { id: array },
  success: function (data) {
    // Clear existing checkboxes (if needed)
    $('#team_member_container').empty();
    
    // Loop through the data and append checkboxes
    $.each(data, function(index, member) {
        $('#team_member_container').append(
           $('<label>', {
                style: 'display: flex; align-items: center; gap:10px;' // Correctly formatted style as a string
            }).append(
                $('<input>', {
                    type: 'checkbox',
                    name: 'team_member[]', // Name for the checkbox array
                    style: 'width: 20px;', // Set width for the checkbox
                    value: member.id // Adjust this according to your member's ID field
                }),
                member.first_name + " " + member.last_name // Member's name
            )
        );
    });
},
    error: function() {
        swal.fire({
            title: "Technical Issue",
            icon: "error",
        });
    }
});

		document.getElementById("assign").style.display="block";
}

function toggleAll(selectAllCheckbox) {
    const checkboxes = document.querySelectorAll('input[name="customer[]"]');
	let service = [];
	let leads = [];

    checkboxes.forEach(checkbox => {
		let serviceId = checkbox.getAttribute("service_id");
		service.push(serviceId);
		leads.push(checkbox.value);
        checkbox.checked = selectAllCheckbox.checked;
	  getLeads(checkbox.value,serviceId); 
      
    });
}
</script>