<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    .error{
      color: red;
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="{{url('assets/images/favicon-32x32.png')}}" type="image/png" />
  <!--plugins--> 
  <link href="{{url('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
  <link href="{{url('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
        <!-- loader-->
        
  <link href="{{url('assets/css/pace.min.css')}}" rel="stylesheet" />
  <script src="{{url('assets/js/pace.min.js')}}"></script>
  <!-- Bootstrap CSS -->
  <link href=" {{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{url('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet"/>
  <link href="assets/css/app.css" rel="stylesheet" />
  <link href="assets/css/icons.css" rel="stylesheet" />
  {{-- TOASTR  --}}
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      height: 100vh;
      background-color: #f5f7fb;
    }

    .sidebar {
      background-color: #2c3e50;
      color: #fff;
      padding: 30px;
      width: 250px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .sidebar-menu {
      list-style-type: none;
    }

    .sidebar-menu li {
      margin-bottom: 15px;
    }

    .sidebar-menu a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
      border-radius: 6px;
      transition: background-color 0.3s ease;
    }

    .sidebar-menu a:hover {
      background-color: #34495e;
    }

    .sidebar-menu i {
      margin-right: 12px;
      font-size: 18px;
    }

    .sidebar-footer {
      text-align: center;
    }

    .sidebar-footer a {
      color: #fff;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .sidebar-footer a:hover {
      color: #bdc3c7;
    }
    .main-content {
      flex-grow: 1;
      padding: 40px;
      /*display: flex;*/
      flex-direction: column;
      align-items: center;
    }

    
    
  </style>
</head>
<body>
  <div class="sidebar">
    <ul class="sidebar-menu">
      <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="{{route('upload-file')}}"><i class="fas fa-file-upload"></i> Upload</a></li>
      <li><a href="{{ route('view-files')}}"><i class="fas fa-file-alt"></i> Files</a></li>
      <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
    </ul>
    <div class="sidebar-footer">
      <a href="{{ route('user-logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
 <div class="main-content">

<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>File</th>
										<th>Created at</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($file_data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($file_data as $key => $value)
                                    <tr id="{{$value->paid_customer_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->file}}</td>
										<td>{{$value->created_at}}</td>
										<td>
											<a href="{{url('/user/view-file')}}/{{$value->file}}"  class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>

										</td>
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="5" style="text-align: center; color:red;"><b> Documents Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
							<div>{{$file_data->links()}}</div>
						</div>
					</div>
				</div>
			</div>
<script>
  <?php if(count($file_data)>0){?>
	 $('#myTable').DataTable({
	 });
   <?php } ?>
</script>
</body>
</html>