@include('admin.dashboard.header')
<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <form id="add_service_form">
        {{@csrf_field()}}
        <input type="hidden" id="reset">
        <input type="hidden" name="user_type" value="{{$admin_data->user_type}}">
        <div class="card-body p-4">
          <h5 class="mb-4">Add Service</h5>
          
          <!-- Main Service -->
          <div class="row mb-3">
            <label for="main_service" class="col-sm-3 col-form-label">Main Service <span style="color:red;">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="Main Service" name="main_service" id="main_service" required>
            </div>
          </div>

          <!-- Add Packages under Main Service -->
          <div class="mb-3">
            <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this)">+ Add Package</button>
            <div class="package-list"></div>
          </div>
          
          <!-- Services Section -->
          <div id="servicesList" class="row mb-3">
            <label class="col-sm-3 col-form-label">Service</label>
            <div class="col-sm-9">
              <button type="button" class="btn btn-success" onclick="addService()">+ Add Service</button>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  // Add Service Section
  function addService() {
    const servicesList = document.getElementById('servicesList');
    const serviceGroup = document.createElement('div');
    serviceGroup.classList.add('service-group', 'mt-3');

    serviceGroup.innerHTML = `
      <div class="border p-3 mb-3 rounded">
        <div class="d-flex justify-content-between mb-2">
          <strong>Service</strong>
          <button type="button" class="btn btn-danger btn-sm" onclick="removeSection(this)">Remove Service</button>
        </div>
        <input type="text" class="form-control mb-2" name="service[]" placeholder="Type Service Name">

        <!-- Add Packages under Service -->
        <div class="mb-2">
          <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this)">+ Add Package</button>
          <div class="package-list"></div>
        </div>

        <!-- Sub-Service Section -->
        <div>
          <button type="button" class="btn btn-info btn-sm" onclick="addSubService(this)">+ Add Sub-Service</button>
          <div class="sub-service-list"></div>
        </div>
      </div>
    `;

    servicesList.appendChild(serviceGroup);
  }

  // Add Sub-Service Section
  function addSubService(button) {
    const subServiceList = button.closest('.border').querySelector('.sub-service-list');
    const subServiceGroup = document.createElement('div');
    subServiceGroup.classList.add('sub-service-group', 'border', 'p-3', 'mt-2');

    subServiceGroup.innerHTML = `
      <div class="d-flex justify-content-between mb-2">
        <strong>Sub Service</strong>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeSection(this)">Remove Sub-Service</button>
      </div>
      <input type="text" class="form-control mb-2" name="sub_service[]" placeholder="Type Sub Service Name">

      <!-- Add Packages under Sub-Service -->
      <div class="mb-2">
        <button type="button" class="btn btn-warning btn-sm" onclick="addPackage(this)">+ Add Package</button>
        <div class="package-list"></div>
      </div>
    `;

    subServiceList.appendChild(subServiceGroup);
  }

  // Add Package Section
function addPackage(button) {
  // Check if 'button' is nested under a border element
  let packageList;

  if (button.closest('.border')) {
    // If nested under Service, Sub-Service, or Package
    packageList = button.closest('.border').querySelector('.package-list');
  } else {
    // For Main Service level
    packageList = button.parentElement.querySelector('.package-list');
  }

  // Create Package Group
  const packageGroup = document.createElement('div');
  packageGroup.classList.add('package-group', 'border', 'p-2', 'mt-2');

  packageGroup.innerHTML = `
    <div class="d-flex justify-content-between mb-2">
      <strong>Package</strong>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeSection(this)">Remove Package</button>
    </div>
    <input type="text" class="form-control mb-2" name="package[]" placeholder="Package Name">
    <input type="number" class="form-control mb-2" name="package_price[]" placeholder="Price (e.g., $10)">

    <select class="form-control mb-2" name="package_duration[]">
      <option value="">Select Duration</option>
      <option value="monthly">Monthly</option>
      <option value="quarterly">Quarterly</option>
      <option value="yearly">Yearly</option>
    </select>

    <select class="form-control mb-2" name="trial_duration[]">
      <option value="">Select Trial Duration</option>
      <option value="weekly">1 Week</option>
      <option value="monthly">2 Month</option>
      <option value="quarterly">3 Month</option>
      <option value="yearly">1 Year</option>
      <option value="yearly">one time free</option>
    </select>

    <!-- Add Sub-Package -->
    <div>
      <button type="button" class="btn btn-primary btn-sm" onclick="addPackage(this)">+ Add Sub-Package</button>
      <div class="package-list"></div>
    </div>
  `;

  packageList.appendChild(packageGroup);
}

  // Remove Section (Generic for Service, Sub-Service, and Package)
  function removeSection(button) {
    button.closest('.border').remove();
  }
</script>
@include('admin.dashboard.footer')
