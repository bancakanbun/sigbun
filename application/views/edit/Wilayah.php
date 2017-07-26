<div class="container-fluid sigbun-container">
    <h2>Lahan perkebunan</h2>

    <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Komoditi</th>
                <th>Kec/desa</th>
                <th>Kab/kota</th>
                <th>Luas lahan (ha)</th>
                <th>Harga panen (Rp)</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data->result() as $row) { ?>
            <tr>
                <td><?php echo $row->id_wilayah; ?></td>
                <td><?php echo $row->nm_tanaman; ?></td>
                <td><?php echo $row->nm_desa; ?></td>
                <td><?php echo $row->nm_kota; ?></td>
                <td><?php echo $row->luasdaerah; ?></td>
                <td><?php echo $row->harga; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs" 
                        data-toggle="modal" data-target="#frmDetailWilayah"
                        data-kode="<?php echo $row->id_wilayah; ?>" data-tanaman="<?php echo $row->id_tanaman; ?>"
                        data-desa="<?php echo $row->id_desa; ?>" data-kota="<?php echo $row->id_kota; ?>"
                        data-luas="<?php echo $row->luasdaerah; ?>" data-harga="<?php echo $row->harga; ?>"
                        >
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs btnDelete" data-kode="<?php echo $row->id_wilayah; ?>">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#frmDetailWilayah" data-kode="">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah data
    </button>

</div>

<div class="modal fade" id="frmDetailWilayah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah data Lahan Perkebunan</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kode:</label>
            <input type="text" class="form-control" id="kodewilayah" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Komoditi:</label>
            <select class="form-control" id="tanaman">
                <option value="">[ Pilih Komoditi ]</option>
                <?php foreach ($komoditi->result() as $row) { ?>
                <option value="<?php echo $row->id_tanaman; ?>"><?php echo $row->nm_tanaman; ?></option>
                <?php } ?>
            </select>
          </div>
          <div class="row">
            <div class="form-group col-md-6 col-sm-12">
              <label for="message-text" class="control-label">Kota:</label>
              <select class="form-control" id="kota">
                  <option value="">[ Pilih Kota ]</option>
                  <?php foreach ($kota->result() as $row) { ?>
                  <option value="<?php echo $row->id_kota; ?>"><?php echo $row->nm_kota; ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="message-text" class="control-label">Desa:</label>
              <select class="form-control" id="desa">
                  <option value="">[ Pilih Desa ]</option>
              </select>
            </div>
          </div>
          <div class="row">
              <div class="form-group col-md-6 col-sm-12">
                <label for="message-text" class="control-label">Luas:</label>
                <input type="text" class="form-control" id="luaslahan"></input>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="message-text" class="control-label">Harga panen:</label>
                <input type="text" class="form-control" id="hargapanen"></input>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <img id="imgSimpan" src="<?php echo base_url(); ?>libs/images/loading.gif" style="height:32px;float:left;display:none;">
        <input type="hidden" id="hMode" value=""></input>
        <input type="hidden" id="hDesa" value=""></input>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>