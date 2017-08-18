<div class="container-fluid sigbun-container">
    <h2>Ubah password</h2>

    <form class="form-horizontal">
      <div class="form-group">
        <label for="passlama" class="col-sm-4 control-label">Password Lama</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" id="passlama" placeholder="Password Lama">
        </div>
      </div>

      <div class="form-group">
        <label for="passbaru" class="col-sm-4 control-label">Password Baru</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" id="passbaru" placeholder="Password Baru">
        </div>
      </div>

      <div class="form-group">
        <label for="passbaru2" class="col-sm-4 control-label">Konfirmasi Password Baru</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" id="passbaru2" placeholder="Konfirmasi Password Baru">
        </div>
      </div>

      <div class="form-group" id="errorbox" style="display:none">
        <div class="col-sm-offset-4 col-sm-4">
          <div class="alert alert-danger" role="alert">
            Password baru dan password konfirmasi tidak sama 
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-4">
          <button type="button" class="btn btn-primary" id="btnSave">
              <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Simpan
          </button>
        </div>
      </div>

    </form>
</div>

