<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ongoing Menu</h5>
        <button type="button" class="close red-text" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <button type="button" onclick="clickDone()" class="btn green btn-sm white-text" data-dismiss="modal">Done</button>
        <button type="button" class="btn red btn-sm white-text" id="callBackup" onclick="reqBack()">Call backup</button>
        <button type="button" class="btn blue btn-sm white-text" id="acceptBackup" onclick="acceptBack()">View Backup</button>
      </div>
    </div>
  </div>
</div>