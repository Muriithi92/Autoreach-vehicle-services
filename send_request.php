<?php 
require_once('config.php');
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
    span.select2-selection.select2-selection--single,span.select2-selection.select2-selection--multiple {
    padding: 0.25rem 0.5rem;
    min-height: calc(1.5em + 0.5rem + 2px);
    height:auto !important;
    max-height:calc(3.5em + 0.5rem + 2px);
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    border-radius: 0;
}
</style>
<div class="container-fluid">
    <form action="" id="request_form">
        <input type="hidden" name="id">
    <div class="col-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id" class="control-label">Vehicle Type</label>
                    <select name="category_id" id="category_id" class="form-select form-select-sm select2 rounded-0" required>
                        <option disabled selected></option>
                        <?php 
                        $category = $conn->query("SELECT * FROM `categories` where status = 1 order by category asc");
                        while($row = $category->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo  $row['category'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="owner_name" class="control-label">Owner's Fullname</label>
                    <input type="text" name="owner_name" id="owner_name" class="form-control form-control-sm rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label">Owner's Phone Number</label>
                    <input type="text" name="contact" id="contact" class="form-control form-control-sm rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Owner's Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" required>
                </div>
                <div class="form-group">
  <label for="address" class="control-label">Address</label>
  <textarea rows="3" name="address" id="address" class="form-control form-control-sm rounded-0" style="resize:none" required></textarea>
  <button type="button" class="btn btn-primary" onclick="getLocation()">Get Location</button>
    <script >
        function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;
  const addressField = document.getElementById("address");
  addressField.value = `Latitude: ${latitude}, Longitude: ${longitude}`;
}

function showError(error) {
  let errorMessage;
  switch (error.code) {
    case error.PERMISSION_DENIED:
      errorMessage = "User denied the request for Geolocation.";
      break;
    case error.POSITION_UNAVAILABLE:
      errorMessage = "Location information is unavailable.";
      break;
    case error.TIMEOUT:
      errorMessage = "The request to get user location timed out.";
      break;
    case error.UNKNOWN_ERROR:
      errorMessage = "An unknown error occurred.";
      break;
  }
  alert(errorMessage);
}
    </script>
</div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_name" class="control-label">Vehicle Name</label>
                    <input type="text" name="vehicle_name" id="vehicle_name" class="form-control form-control-sm rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="vehicle_registration_number" class="control-label">Vehicle Registration Number</label>
                    <input type="text" name="vehicle_registration_number" id="vehicle_registration_number" class="form-control form-control-sm rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="vehicle_model" class="control-label">Vehicle Model</label>
                    <input type="text" name="vehicle_model" id="vehicle_model" class="form-control form-control-sm rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="service_id" class="control-label">Services</label>
                    <select name="service_id[]" id="service_id" class="form-select form-select-sm select2 rounded-0" multiple required>
                        <option disabled></option>
                        <?php 
                        $service = $conn->query("SELECT * FROM `service_list` where status = 1 order by `service` asc");
                        while($row = $service->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo  $row['service'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="service_type" class="control-label">Request Type</label>
                    <select name="service_type" id="service_type" class="form-select form-select-sm select2 rounded-0" required>
                    <option value="">Select</option>
                    <option value="Drop off">Drop Off</option>
                        <option value="Pick up">Pick Up</option>
                    </select>

                    <div class="form-group" style="display:none">
                 <label for="dropoff_address" class="control-label">Drop Off Address</label>
                 <textarea rows="3" name="dropoff_address" id="dropoff_address" class="form-control form-control-sm rounded-0" style="resize:none" readonly></textarea>
             </div>
 
                </div>
                <div class="form-group" style="display:none">
                 <label for="pickup_address" class="control-label">Pick up Address</label>
                 <textarea rows="3" name="pickup_address" id="pickup_address" class="form-control form-control-sm rounded-0" style="resize:none" required></textarea>
                 <button type="button" class="btn btn-primary" onclick="document.getElementById('pickup_address').value = document.getElementById('address').value;">Pick Location</button>
                        </div>

                        <script>
    function toggleAddressFields() {
        var serviceType = document.getElementById("service_type").value;
        var dropoffAddressGroup = document.getElementById("dropoff_address_group");
        var pickupAddressGroup = document.getElementById("pickup_address_group");

        if (serviceType === "Drop off") {
            dropoffAddressGroup.style.display = "block";
            pickupAddressGroup.style.display = "none";
            document.getElementById("pickup_address").removeAttribute("required");
        } else if (serviceType === "Pick up") {
            dropoffAddressGroup.style.display = "none";
            pickupAddressGroup.style.display = "block";
            document.getElementById("pickup_address").setAttribute("required", "required");
        }
    }

    document.getElementById("submit_button").addEventListener("click", function(event) {
        // Perform additional validation or submission logic if needed
        console.log("Form submitted");
    });
</script>
            </div>
        </div>
    </div>
        <div class="w-100 d-flex justify-content-end mx-2">
            <div class="col-auto">
                <button class="btn btn-primary btn-sm rounded-0">Submit Request</button>
                <button class="btn btn-dark btn-sm rounded-0" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('.select2').select2({
            placeholder:"Please Select Here",
            dropdownParent: $('#uni_modal')
        })
        $('#service_type').change(function(){
            var type = $(this).val().toLowerCase()
            if(type == 'pick up'){
                $('#pickup_address').parent().show()
                $('#pickup_address').attr('required',true)
            }else{
                $('#pickup_address').parent().hide()
                $('#pickup_address').attr('required',false)
            }
                
        })
        $('#request_form').submit(function(e){
            e.preventDefault()
            start_loader();
            $.ajax({
                url:'classes/Master.php?f=save_request',
                method:'POST',
                data:$(this).serialize(),
                dataType:'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader()
                },
                success:function(resp){
                    end_loader()
                    if(resp.status == 'success'){
                        $('#uni_modal').on('hidden.bs.modal', function(){
                            if($(this).find('#request_form').length > 0){
                                setTimeout(() => {
                                    uni_modal("","success_msg.php")
                                }, 200);
                            }
                        })
                        $('#uni_modal').modal('hide')
                    }else{
                        alert_toast("An error occured",'error');
                    }
                }
            })
        })
    })
</script>