@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
@media only screen and (max-width: 1500px) {

}

</style>
<style>
        body {
            background-color: #f4f7fa;
        }
        .card-header-custom {
            background: linear-gradient(135deg, rgb(37, 117, 252), rgb(37, 117, 252) 100%);
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }
        .form-control {
            border-left: none;
            box-shadow: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #2575fc;
        }
        .btn-submit {
            background: linear-gradient(135deg,rgb(37, 117, 252) , #2575fc 100%);
            border: none;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(50,50,93,.1), 0 3px 6px rgba(0,0,0,.08);
        }
        .form-text {
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
@push('title')
    <title>Add Service</title>
@endpush
  <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card card-custom shadow-lg border-0 rounded-4">
                    <form id="add_role_form" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header card-header-custom text-white text-center py-3 rounded-top">
                            <h4 class="mb-0 d-flex align-items-center text-white justify-content-center">
                                <i class='bx bx-shield-alt-2 me-2'></i>
                                Add New Role
                            </h4>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-4">
                              <label for="name" class="form-label fw-bold mb-3">
                                 Services
                                    <span class="text-danger">*</span>
                                </label>
                               <div style="display: flex; align-items: center; gap:10px; flex-wrap: wrap"> 
                                @foreach ($service as $item)
                                   <input type="checkbox" id="{{$item->name}}" name="service[]" value="{{$item->service_id}}" style="width: 25px;" required> <label style=" cursor: pointer;" for="{{$item->name}}">{{$item->name}}</label>
                                @endforeach

                             
                            
                            </div>
                            </div>
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold mb-3">
                                    Role Name 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bx bx-detail"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        class="form-control form-control-lg" 
                                        placeholder="Enter Role Name (e.g., Administrator)" 
                                        name="name" 
                                        id="name" 
                                        required 
                                        pattern="[A-Za-z\s]+" 
                                        minlength="3" 
                                        maxlength="50"
                                    >   
                                    <div class="invalid-feedback">
                                        Please provide a valid role name (3-50 characters, letters only).
                                    </div>
                                </div>
                                <small class="form-text mt-2 d-block">
                                    Create a descriptive role name that clearly defines the user's responsibilities.
                                </small>
                            </div>

                            <div class="d-grid mt-4">
                                <button 
                                    type="submit" 
                                    class="btn btn-submit text-white"
                                    id="btn"
                                >
                                
                                    Create Role
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

	
				
@include('admin.dashboard.footer')
