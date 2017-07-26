<div class="container-fluid sigbun-container">
    <h2>Daftar organisme penggangu tanaman</h2>

    <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Komoditi</th>
                <th>Organisme</th>
                <th>Nama Latin</th>
                <th>Kehilangan hasil (%)</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data->result() as $row) { ?>
            <tr>
                <td><?php echo $row->id_opt; ?></td>
                <td><?php echo $row->nm_tanaman; ?></td>
                <td><?php echo $row->nm_opt; ?></td>
                <td><?php echo $row->nm_latinopt; ?></td>
                <td><?php echo $row->persentase_hilang; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs" 
                        data-toggle="modal" data-target="#frmDetailOpt"
                        data-kode="<?php echo $row->id_opt; ?>" data-tanaman="<?php echo $row->id_tanaman; ?>"
                        data-nama="<?php echo $row->nm_opt; ?>" data-namalatin="<?php echo $row->nm_latinopt; ?>"
                        data-persen="<?php echo $row->persentase_hilang; ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs btnDelete" data-kode="<?php echo $row->id_opt; ?>">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#frmDetailOpt" data-kode="">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah data
    </button>

</div>

<div class="modal fade" id="frmDetailOpt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah data organisme pengganggu tanaman</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kode:</label>
            <input type="text" class="form-control" id="kodeopt" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Komoditi:</label>
            <select class="form-control" id="tanaman">
                <option value="">[ Pilih Komoditi ]</option>
                <?php foreach ($tanaman->result() as $row) { ?>
                <option value="<?php echo $row->id_tanaman; ?>"><?php echo $row->nm_tanaman; ?></option>
                <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Organisme:</label>
            <input type="text" class="form-control" id="namaopt"></input>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Nama Latin:</label>
            <input type="text" class="form-control" id="namalatin"></input>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Kehilangan produksi:</label>
            <input type="text" class="form-control" id="persen"></input>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <img id="imgSimpan" src="<?php echo base_url(); ?>libs/images/loading.gif" style="height:32px;float:left;display:none;">
        <input type="hidden" id="hMode" value=""></input>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>