@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
    @media only screen and (max-width: 1500px) {
        #phone {
            width: 100% !important;
        }
    }
</style>
@push('title')
    <title>Set IP address</title>
@endpush
<div class="row">
    <div class="col-lg-8 mx-auto">


        <div class="card">
            <form id="add_contact_form">
                <div class="card-body p-4">
                    <h5 class="mb-4">Set IP Address </h5>
                    <div class="row mb-3">
                        <label for="input42" class="col-sm-3 col-form-label">Full Name</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="text" class="form-control" placeholder="Type Full Name" name="name"
                                    required>
                                <span class="position-absolute top-50 translate-middle-y"><i
                                        class='bx bx-user'></i></span>
                            </div>
                        </div>
                    </div>
                    {{ @csrf_field() }}
                    <div class="row mb-3">
                        <label for="input43" class="col-sm-3 col-form-label">Phone No</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="tel" id="phone" class="form-control" name="phone"
                                    placeholder="Type Phone Number" style="width: 575px;" required>
                                <input type="hidden" id="country_code" name="country_code" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="input44" class="col-sm-3 col-form-label">Email Address</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="email" class="form-control" placeholder="Type Email Address"
                                    name="email" required>
                                <span class="position-absolute top-50 translate-middle-y"><i
                                        class='bx bx-envelope'></i></span>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="input45" class="col-sm-3 col-form-label">Choose Password</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="password" class="form-control" placeholder="Type Password" name="password"
                                    required>
                                <span class="position-absolute top-50 translate-middle-y"><i
                                        class='bx bx-lock'></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="input48" required name="check">
                                &nbsp;
                                <label class="form-check-label" for="input48">Check me out</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn"
                                    onclick="addTeamMember()">Submit</button>
                                <button style="height:46px;" type="reset" class="btn btn-light px-4">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>



    </div>
</div><!--end row-->


@include('admin.dashboard.footer')
