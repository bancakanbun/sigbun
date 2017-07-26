<div class="container-fluid sigbun-container">
    <h2>Daftar Kabupaten/Kota</h2>

    <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data->result() as $row) { ?>
            <tr>
                <td><?php echo $row->id_kota; ?></td>
                <td><?php echo $row->nm_kota; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs" 
                        data-toggle="modal" data-target="#frmDetailKota"
                        data-kode="<?php echo $row->id_kota; ?>" data-nama="<?php echo $row->nm_kota; ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs btnDelete"
                        data-kode="<?php echo $row->id_kota; ?>" data-nama="<?php echo $row->nm_kota; ?>">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#frmDetailKota" data-kode="">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah data
    </button>

</div>

<div class="modal fade" id="frmDetailKota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah data Kabupaten/Kota</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kode:</label>
            <input type="text" class="form-control" id="kodekota" maxlength="3">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Nama:</label>
            <input type="text" class="form-control" id="namakota"></input>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <img id="imgSimpan" src="<?php echo base_url(); ?>libs/images/loading.gif" style="height:32px;float:left;display:none;">
        <input type="hidden" id="hMode" value=""></input>
        <input type="hidden" id="hKode" value=""></input>
        <input type="hidden" id="hNama" value=""></input>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>