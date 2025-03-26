
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="../controller/logController.php">
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-sm-12">  
                <div class="form-group">
                  <h3 class="text-center">Are You Sure You Want To Delete?</h3>
                  <input type="hidden" name="id" id="delete_id" class="form-control" placeholder="Enter your event name">
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

