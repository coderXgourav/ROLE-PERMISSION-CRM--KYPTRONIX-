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
          </div>
<form id="upload_clients">
  <div class="card ">
  <div class="p-4">
      {{@csrf_field()}} <br> 
      <label for=""><b>Select File</b></label>
<input type="file" name="csv" class="form-control" required>  
 <br>
 <label for="">Please Download Excel Sheet Format</label>
 <a href="{{url('/leads_format_sheet.xlsx')}}"> Click Here</a>

  <div style="display: flex; justify-content:center; margin-top:15px;"> 
    <button type="submit" id="btn" style="height:46px;" class="m-auto btn btn-primary">Upload Clients</button>
 
  </div>
  </div>
  </div>
</form>

  {{-- <script>
    CKEDITOR.replace('editor2');
  </script> --}}


     

@include('admin.dashboard.footer')
