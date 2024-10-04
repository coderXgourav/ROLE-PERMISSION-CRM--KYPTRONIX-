
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title> Customers/Clients Table</title>
@endpush
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<div class="card">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
					<div class="card-body">
						<div class="table-responsive">
							<form id="assign_client_form">
							<table id="myTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="display: flex; justify-content: center;align-items: center">Select All &nbsp;<input type="checkbox" id="select-all" onclick="selectAllCheckboxes()" style="width:22px;"> </th>
										<th>No.</th>
										<th>Name</th>
										<th>Mobile No.</th>
										<th>Email</th>
										<th>Message</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)

                                    <tr>
										<td style="display:flex; justify-content:center;"><input type="checkbox" value="{{$value->customer_id}}" name="customer[]" required style="width:22px;"> </td>
										{{@csrf_field()}}
										<td>{{$i++}}</td>
										<td>{{$value->customer_name}}</td>
										<td>{{$value->customer_number}}</td>
										<td>{{$value->customer_email}}</td>
										<td>{{$value->msg}}</td>
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="6" style="text-align: center; color:red;"><b>Customer Records Not Found..!</b></td>
										
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
        <h5 class="modal-title" id="exampleModalLabel">Choose Team Member </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> <br>
       <select name="team_member" id="" class="form-control">
		   <option value="">Select Team Member</option>
		@foreach ($team as $members)
		<option value="{{$members->user_id}}">{{$members->name}}</option>
		@endforeach
	   </select> <br>
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
								 <button class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModal" style="background-color: #38833c; border:1px solid #38833c; width:300px;">Assign Clients</button>
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
	function selectAllCheckboxes(){
		 var selectAll = document.getElementById("select-all");
         var checkboxes = document.querySelectorAll("input[type='checkbox']");

		for (var i = 0; i < checkboxes.length; i++) {
			checkboxes[i].checked = selectAll.checked;
		}
	}
</script>