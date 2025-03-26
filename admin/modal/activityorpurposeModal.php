<!-- Add -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Add New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="../controller/activityorpurposeController.php">
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-sm-12">  
                <div class="form-group">
                  <label for="event_name">Name</label>
                  <input type="text" name="name" class="form-control">
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

<!-- Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="../controller/activityorpurposeController.php">
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-sm-12">  
                <div class="form-group">
                  <label for="event_name">Name</label>
                  <input type="hidden" name="id" id="edit_id">
                  <input type="text" name="name" id="edit_name" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="edit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Delete -->

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="../controller/activityorpurposeController.php">
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-sm-12">  
                <div class="form-group">
                  <h3 class="text-center">Are You Sure You Want To Delete?</h3>
                  <input type="hidden" name="id" id="delete_id">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="delete" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


