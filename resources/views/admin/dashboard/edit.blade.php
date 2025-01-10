@include('admin.dashboard.header')
<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <form id="edit_service_form">
        {{@csrf_field()}}
        <input type="hidden" name="service_id" >
        <div class="card-body p-4">
          <h5 class="mb-4">Edit Service</h5>

          <!-- Main Service -->
          <div class="row mb-3">
            <label for="main_service" class="col-sm-3 col-form-label">Main Service <span style="color:red;">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="main_service[name]" id="main_service" value="{{ $serviceData['main_service']['name'] }}" required>
            </div>
          </div>

          <!-- Packages under Main Service -->
          <div class="mb-3">
            <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this, 'main_service[packages]')">+ Add Package</button>
            <div class="package-list">
              @foreach($serviceData['main_service']['packages'] as $package)
              <div class="package-group border p-2 mt-2">
                <input type="text" class="form-control mb-2" name="main_service[packages][][package_name]" value="{{ $package['package_name'] }}">
                <input type="number" class="form-control mb-2" name="main_service[packages][][price]" value="{{ $package['price'] }}">
              </div>
              @endforeach
            </div>
          </div>
 
          <!-- Services Section -->
          <div id="servicesList" class="row mb-3">
            <label class="col-sm-3 col-form-label">Service</label>
            <div class="col-sm-9">
              <button type="button" class="btn btn-success" onclick="addService()">+ Add Service</button>
            </div>

            @foreach($serviceData['main_service']['services'] as $index => $service)
            <div class="service-group mt-3 border p-3">
              <input type="text" class="form-control mb-2" name="main_service[services][{{ $index }}][name]" value="{{ $service['name'] }}">
              <div class="package-list">
                @foreach($service['packages'] as $package)
                <input type="text" class="form-control mb-2" name="main_service[services][{{ $index }}][packages][][package_name]" value="{{ $package['package_name'] }}">
                <input type="number" class="form-control mb-2" name="main_service[services][{{ $index }}][packages][][price]" value="{{ $package['price'] }}">
                @endforeach
              </div>

              <!-- Sub-Services -->
              <div class="sub-service-list">
                @foreach($service['sub_services'] as $subIndex => $subService)
                <input type="text" class="form-control mb-2" name="main_service[services][{{ $index }}][sub_services][{{ $subIndex }}][name]" value="{{ $subService['name'] }}">
                @endforeach
              </div>
            </div>
            @endforeach
          </div>

          <!-- Submit Button -->
          <div class="row">
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
  let serviceCounter = 0; // Counter for Services
  let subServiceCounter = {}; // Counter for Sub-Services under each Service

  // Add Service Section
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

        <!-- Add Packages under Service -->
        <div class="mb-2">
          <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this, 'main_service[services][${serviceCounter}][packages]')">+ Add Package</button>
          <div class="package-list"></div>
        </div>

        <!-- Sub-Service Section -->
        <div>
          <button type="button" class="btn btn-info btn-sm" onclick="addSubService(this, ${serviceCounter})">+ Add Sub-Service</button>
          <div class="sub-service-list"></div>
        </div>
      </div>
    `;

    servicesList.appendChild(serviceGroup);
    subServiceCounter[serviceCounter] = 0; // Initialize sub-service counter for this service
  }

  // Add Sub-Service Section
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

      <!-- Add Packages under Sub-Service -->
      <div class="mb-2">
        <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this, 'main_service[services][${serviceIndex}][sub_services][${subServiceCounter[serviceIndex]}][packages]')">+ Add Package</button>
        <div class="package-list"></div>
      </div>
    `;

    subServiceList.appendChild(subServiceGroup);
  }

  // Add Package Section
function addPackage(button, namePrefix) {
  const packageList = button.closest('.border') 
    ? button.closest('.border').querySelector('.package-list') 
    : button.parentElement.querySelector('.package-list');
  
  const packageGroup = document.createElement('div');
  packageGroup.classList.add('package-group', 'border', 'p-2', 'mt-2');

  // Set fields with structured keys for array submission
  packageGroup.innerHTML = `
    <div class="d-flex justify-content-between mb-2">
      <strong>Package</strong>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeSection(this)">Remove Package</button>
    </div>
    <input type="text" class="form-control mb-2" name="${namePrefix}[][package_name]" placeholder="Package Name">
    <input type="number" class="form-control mb-2" name="${namePrefix}[][price]" placeholder="Price (e.g., 10)">
    <select class="form-control mb-2" name="${namePrefix}[][package_duration]">
      <option value="">Select Duration</option>
      <option value="monthly">Monthly</option>
      <option value="quarterly">Quarterly</option>
      <option value="yearly">Yearly</option>
    </select>
     <select class="form-control mb-2" name="${namePrefix}[][trial]">
      <option value="">Select Trial Duration</option>
      <option value="not_free">NA</option>
      <option value="1month">1st Month</option>
      <option value="3month">3 Months</option>
      <option value="1year">1 Year</option>
    </select>
  `;
  packageList.appendChild(packageGroup);
}


  // Remove Section
  function removeSection(button) {
    button.closest('.border').remove();
  }
</script>

@include('admin.dashboard.footer')
