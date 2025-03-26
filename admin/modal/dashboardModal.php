<!-- Add -->
<div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Add New Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="../controller/dashboardController.php">
        <input type="hidden" id="request_id" name="request_id">
        <input type="hidden" id="users_id" name="users_id">
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-sm-12">  
                <div class="form-group">
                  <label for="event_name">Event name</label>
                  <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter your event name">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">  
                <div class="form-group">
                  <label for="event_start_date">Event start</label>
                  <input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Event start date">
                 </div>
              </div>
              <div class="col-sm-6">  
                <div class="form-group">
                  <label for="event_end_date">Event end</label>
                  <input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Event end date">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Delete -->
<div class="modal fade" id="delte_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Delete Data Event / See Details Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <div class="row">
            <div class="col-sm-12">  
              <br>
              <div class="form-group text-center">
                <button type="button" class="btn btn-success" id="seedetailsBtn">
                  See Details
                </button>
                <!-- Hidden input for request_id needed by all users -->
                <input type="hidden" name="request_id" id="see_request_id">
                
                <form method="POST" action="../controller/dashboardController.php" style="display:inline;">
                  <?php if($_SESSION['type'] == 0): ?>
                    <button type="submit" name="delete" class="btn btn-danger">Delete Data</button>
                    <input type="hidden" name="event_id" id="event_id">
                    <input type="hidden" name="request_id" value="<?php echo isset($_GET['request_id']) ? $_GET['request_id'] : ''; ?>">
                  <?php endif; ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="submit" name="delete" class="btn btn-primary">Save</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detailsContent">
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $(document).on('click', '#seedetailsBtn', function(e) {
    e.preventDefault();
    const requestId = $('#see_request_id').val();
    
    if (!requestId) {
      alert('Request ID not found');
      return;
    }
    
    $('#delte_modal').modal('hide');
    
    $.ajax({
      url: '../controller/get_request_details.php',
      type: 'POST',
      data: { id: requestId },
      success: function(response) {
        $('#detailsContent').html(response);
        $('#detailsModal').modal('show');
      },
      error: function() {
        alert('Failed to fetch request details.');
      }
    });
  });
});
</script>

<!-- Add this in the head section or in your CSS file -->
<style>
.modal-xl {
    width: 95%;
    max-width: 1400px;
}

.modal-body {
    max-height: 85vh;
    overflow-y: auto;
}
</style>

