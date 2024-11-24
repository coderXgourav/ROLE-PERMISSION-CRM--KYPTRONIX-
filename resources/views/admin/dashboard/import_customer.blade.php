@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}} 

@push('title') 
<title>Import Customer </title> 
@endpush
 {{-- <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script> --}}
     <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            {{-- <div class="breadcrumb-title pe-3">Import Customer</div> --}}
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                   Choose File Here 
                  </li>
                </ol>
              </nav>
            </div>

            
          </div> <br><br>
<div style="display: flex;
    justify-content: space-evenly;">
  <div class="col-md-5">
    <form id="upload_individual_lead">
  <div class="card ">
  <div class="p-4" style="padding: 3.5rem!important;">
      {{@csrf_field()}}
      <h5 for="" class=" "><b>Import Individual Leads</b> </h5>
<input type="file" name="csv" class="form-control" required>  
 <br>
 <label for="">Please Download Excel Sheet Format</label>
 <a href="{{url('/individual.xlsx')}}"> Click Here</a>

  <div style="display: flex; justify-content:center; margin-top:15px;"> 
    <button type="submit" id="btn1" style="height:46px;" class="m-auto btn btn-primary btn-sm">Upload Individual Leads</button>
 
  </div>
  </div>
  </div>
</form>
  </div>
  <div class="col-md-5"><form id="upload_clients">
  <div class="card ">
  <div class="p-4" style="padding: 3.5rem!important;">
      {{@csrf_field()}} 
      <h5 for="" class=" "><b>Import Business Leads</b> </h5>

<input type="file" name="csv" class="form-control" required>  
 <br>
 <label for="">Please Download Excel Sheet Format</label>
 <a href="{{url('/business.xlsx')}}"> Click Here</a>

  <div style="display: flex; justify-content:center; margin-top:15px;"> 
    <button type="submit" id="btn2" style="height:46px;" class="m-auto btn btn-success btn-sm">Upload Business Leads</button>
 
  </div>
  </div>
  </div>
</form></div>
</div>




  {{-- <script>
    CKEDITOR.replace('editor2');
  </script> --}}


     

@include('admin.dashboard.footer')
