@include('admin.dashboard.header')

<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <form id="update_service_form">
        {{ @csrf_field() }}
        <input type="hidden" name="service_id">
        <div class="card-body p-4">
          <h5 class="mb-4">Edit Service</h5>

          <!-- Main Service -->
          <div class="row mb-3">
            <label for="main_service" class="col-sm-3 col-form-label">Main Service <span style="color:red;">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="main_service[name]" id="main_service" value="{{ $serviceData['service']['name'] }}" required>
            </div>
          </div>

          <!-- Packages for Main Service -->
          <div class="mb-3">
            <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this, 'main_service[packages]')">+ Add Package</button>
            <div class="package-list">
              @foreach ($serviceData['service']['packages'] as $package)
                <div class="package-group border p-2 mt-2">
                  <input type="text" class="form-control mb-2" name="main_service[packages][][title]" value="{{ $package->title }}" placeholder="Package Title">
                  <input type="number" class="form-control mb-2" name="main_service[packages][][price]" value="{{ $package->price }}" placeholder="Price">
                  <button type="button" class="btn btn-danger btn-sm" onclick="removeSection(this)">Remove Package</button>
                </div>
              @endforeach
            </div>
          </div>

          <!-- Sub Services -->
          <div id="servicesList">
            @foreach ($serviceData['service']['sub_services'] as $serviceIndex => $subService)
              <div class="service-group border p-3 mt-3 rounded">
                <h6>Sub Service {{ $serviceIndex + 1 }}</h6>
                <input type="text" class="form-control mb-2" name="main_service[sub_services][{{ $serviceIndex }}][name]" value="{{ $subService['name'] }}" placeholder="Sub Service Name">

                <!-- Packages for Sub Service -->
                <div class="mb-3">
                  <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this, 'main_service[sub_services][{{ $serviceIndex }}][packages]')">+ Add Package</button>
                  <div class="package-list">
                    @foreach ($subService['packages'] as $package)
                      <div class="package-group border p-2 mt-2">
                        <input type="text" class="form-control mb-2" name="main_service[sub_services][{{ $serviceIndex }}][packages][][title]" value="{{ $package->title }}" placeholder="Package Title">
                        <input type="number" class="form-control mb-2" name="main_service[sub_services][{{ $serviceIndex }}][packages][][price]" value="{{ $package->price }}" placeholder="Price">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeSection(this)">Remove Package</button>
                      </div>
                    @endforeach
                  </div>
                </div>

                <!-- Sub-Sub Services -->
                <div class="sub-service-list">
                  @foreach ($subService['sub_sub_services'] as $subSubIndex => $subSubService)
                    <div class="sub-service-group border p-3 mt-2 rounded">
                      <h6>Sub-Sub Service {{ $subSubIndex + 1 }}</h6>
                      <input type="text" class="form-control mb-2" name="main_service[sub_services][{{ $serviceIndex }}][sub_sub_services][{{ $subSubIndex }}][name]" value="{{ $subSubService['name'] }}" placeholder="Sub-Sub Service Name">

                      <!-- Packages for Sub-Sub Service -->
                      <div class="mb-3">
                        <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this, 'main_service[sub_services][{{ $serviceIndex }}][sub_sub_services][{{ $subSubIndex }}][packages]')">+ Add Package</button>
                        <div class="package-list">
                          @foreach ($subSubService['packages'] as $package)
                            <div class="package-group border p-2 mt-2">
                              <input type="text" class="form-control mb-2" name="main_service[sub_services][{{ $serviceIndex }}][sub_sub_services][{{ $subSubIndex }}][packages][][title]" value="{{ $package->title }}" placeholder="Package Title">
                              <input type="number" class="form-control mb-2" name="main_service[sub_services][{{ $serviceIndex }}][sub_sub_services][{{ $subSubIndex }}][packages][][price]" value="{{ $package->price }}" placeholder="Price">
                              <button type="button" class="btn btn-danger btn-sm" onclick="removeSection(this)">Remove Package</button>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach
          </div>

          <!-- Add New Service -->
          <div>
            <button type="button" class="btn btn-success mt-4" onclick="addService()">+ Add Service</button>
          </div>

          <!-- Submit Button -->
          <div class="row mt-4">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary w-100">Update Service</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  let serviceCounter = 0; 
  let subServiceCounter = {}; 

  function addService() {
    serviceCounter++;
    const servicesList = document.getElementById('servicesList');
    const serviceGroup = document.createElement('div');
    serviceGroup.classList.add('service-group', 'mt-3');

    serviceGroup.innerHTML = `
      <div class="border p-3 mb-3 rounded">
        <div class="d-flex justify-content-between mb-2">
          <strong>Service ${serviceCounter}</strong>
          <button type="button" class="btn btn-danger btn-sm" onclick="removeSection(this)">Remove Service</button>
        </div>
        <input type="text" class="form-control mb-2" name="main_service[services][${serviceCounter}][name]" placeholder="Type Service Name">

        <div class="mb-2">
          <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this, 'main_service[services][${serviceCounter}][packages]')">+ Add Package</button>
          <div class="package-list"></div>
        </div>

        <div>
          <button type="button" class="btn btn-info btn-sm" onclick="addSubService(this, ${serviceCounter})">+ Add Sub-Service</button>
          <div class="sub-service-list"></div>
        </div>
      </div>
    `;

    servicesList.appendChild(serviceGroup);
    subServiceCounter[serviceCounter] = 0; 
  }

  function addSubService(button, serviceIndex) {
    subServiceCounter[serviceIndex]++;
    const subServiceList = button.closest('.border').querySelector('.sub-service-list');
    const subServiceGroup = document.createElement('div');
    subServiceGroup.classList.add('sub-service-group', 'border', 'p-3', 'mt-2');

    subServiceGroup.innerHTML = `
      <div class="d-flex justify-content-between mb-2">
        <strong>Sub Service ${subServiceCounter[serviceIndex]}</strong>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeSection(this)">Remove Sub-Service</button>
      </div>
      <input type="text" class="form-control mb-2" name="main_service[services][${serviceIndex}][sub_services][${subServiceCounter[serviceIndex]}][name]" placeholder="Type Sub Service Name">
    `;

    subServiceList.appendChild(subServiceGroup);
  }

  function removeSection(button) {
    button.closest('.border').remove();
  }
</script>

@include('admin.dashboard.footer')
