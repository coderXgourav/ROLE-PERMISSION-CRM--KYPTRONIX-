@include('admin.dashboard.header')

<div class="wrapper">
    <!--sidebar wrapper -->

    <!--end sidebar wrapper -->
    <!--start header -->

    <!--end header -->
    <!--start page wrapper -->
 
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Invoices</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
            <div class="row">
              
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                      
                         
                            <!--end row-->
                           
                            <!--end row-->
                            <div class="d-flex align-items-center">
                                <div>
                                </div>
                                <div class="ms-auto">
                                    {{-- <a href="javascript:;" class="btn btn-sm btn-outline-secondary"></a> --}}
                                </div>
                            </div>
                            <div class="table-responsive mt-3" >
                                <table class="table table-striped table-hover table-sm mb-0" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Name <i class='bx bx-up-arrow-alt ms-2'></i>
                                            </th>
                                            <th>Number</th>
                                            <th>Price</th>
                                            <th>Last Modified</th>
                                            <th>Show Invoice</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if(count($data)>0)
                                       @foreach ($data as $item)
                                       <tr>
                                           <td>
                                               <div class="d-flex align-items-center">
                                                   <div><i class='bx bxs-file-pdf me-2 font-24 text-danger'></i>
                                                   </div>
                                                   <div class="font-weight-bold text-danger">
                                                    {{$item->customer_name}}
                                                   
                                                   </div>
                                               </div>
                                           </td>
                                           <td>{{$item->customer_number}}</td>
                                         
                                          
                                           <td class="text-danger"><b> {{$item->price}}$</b></td>
                                           <td><?php echo date('d-M-Y',strtotime($item->created_at)) ?></td>
                                           <td><a href="{{route('admin.invoice2',['id'=>$item->customer_package_main_id])}}" class="btn btn-success btn-sm">View </a>
                                           </td>

                                       </tr>
                                       @endforeach
                                       @else
                                       <tr>
                                        <td colspan="6" class="text-danger text-center">
                                           Invoice Not Found
                                        </td>
                                    </tr>
                                       @endif
                                       
                                    </tbody>
                                </table>
                                <div>{{$data->links()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © 2024. All right reserved.</p>
    </footer>
</div>

@include('admin.dashboard.footer')
<script>
    $('#myTable').DataTable({
    });
</script>