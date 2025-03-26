<!-- Add -->
<div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Approval</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="../controller/approvalController.php">
        <input type="hidden" id="request_id" name="request_id">
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-sm-12">  
                <div class="form-group">
                  <label for="event_name">Status</label>
                  <select type="text" name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="Approved">Approved</option>
                    <option value="Declined">Declined</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="save" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

