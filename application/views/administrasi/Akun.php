<div class="container-fluid sigbun-container">
    <h2>Daftar User</h2>

    <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Username</th>
                <th>Akses</th>
                <th>Kota</th>
                <th>Telp</th>
                <th>Email</th>
                <th>Status</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data->result() as $row) { ?>
            <tr>
                <td><?php echo $row->name; ?></td>
                <td><?php echo $row->username; ?></td>
                <td><?php echo $row->type; ?></td>
                <td><?php echo $row->nm_kota; ?></td>
                <td><?php echo $row->telp; ?></td>
                <td><?php echo $row->email; ?></td>
                <?php if($row->status == 1) { ?>
                <td>Disetujui</td>
                <?php } else { ?>
                <td>Belum disetujui</td>
                <?php } ?>
                <td>
                    <button type="button" class="btn btn-default btn-xs" title="Update user"
                        data-toggle="modal" data-target="#frmDetailUser"
                        data-kode="<?php echo $row->id; ?>" data-nama="<?php echo $row->name; ?>"
                        data-user="<?php echo $row->username; ?>" data-pass="<?php echo $row->Pass; ?>"
                        data-telp="<?php echo $row->telp; ?>" data-email="<?php echo $row->email; ?>"
                        data-type="<?php echo $row->type; ?>" data-status="<?php echo $row->status; ?>" 
                        data-kota="<?php echo $row->id_kota; ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs btnDelete" title="Hapus user" data-kode="<?php echo $row->id; ?>">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    <?php if($row->status == 0) { ?>
                    <button type="button" class="btn btn-default btn-xs btnApprove" title="Approve user" data-kode="<?php echo $row->id; ?>">
                        <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                    </button>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#frmDetailUser" data-kode="">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah data
    </button>

</div>

<div class="modal fade" id="frmDetailUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah data pengguna</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="message-text" class="control-label">Nama:</label>
            <input type="text" class="form-control" id="nama"></input>
          </div>
          <div class="row">
            <div class="form-group col-md-6 col-sm-12">
              <label for="recipient-name" class="control-label">User:</label>
              <input type="text" class="form-control" id="username">
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="recipient-name" class="control-label">Password:</label>
              <input type="password" class="form-control" id="password">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6 col-sm-12">
              <label for="message-text" class="control-label">Level:</label>
              <select class="form-control" id="level">
                  <option value="">[ Pilih Level ]</option>
                  <option value="Administrator">Administrator</option>
                  <option value="Operator">Data Editor</option>
                  <option value="Eksekutif">Eksekutif</option>
                  <option value="Lapangan">Petugas Lapangan</option>
                  <option value="Eksternal">Petugas Eksternal</option>
              </select>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="message-text" class="control-label">Kota:</label>
              <select class="form-control" id="kota">
                  <option value="">[ Pilih Kota ]</option>
                  <?php foreach ($kota->result() as $row) { ?>
                  <option value="<?php echo $row->id_kota; ?>"><?php echo $row->nm_kota; ?></option>
                  <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6 col-sm-12">
              <label for="recipient-name" class="control-label">Telp:</label>
              <input type="text" class="form-control" id="telp">
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="recipient-name" class="control-label">Email:</label>
              <input type="text" class="form-control" id="email">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <img id="imgSimpan" src="<?php echo base_url(); ?>libs/images/loading.gif" style="height:32px;float:left;display:none;">
        <input type="hidden" id="hMode" value=""></input>
        <input type="hidden" id="kode" value=""></input>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>