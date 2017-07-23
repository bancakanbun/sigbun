  <div class="container sigbun-container">
    <h2>Update data pengamatan OPT</h2>

    <input type="hidden" id="kode" value=""></input>
    <form class="form-inline">
      <div class="row">
        <div class="form-group col-sm-4 col-sm-12" style="margin-bottom: 15px;">
          <label for="tahun">Tahun</label>
          <select class="form-control pull-right" id="tahun" style="margin-top:-5px;">
            <option value="">[ Pilih Tahun ]</option>
            <?php foreach ($tahun->result() as $row) { ?>
            <option value="<?php echo $row->id_tahun; ?>"><?php echo $row->nm_tahun; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-md-4 col-sm-12">
          <label for="message-text" class="control-label">Luas Lahan:</label>
          <input type="text" class="form-control pull-right" id="luaslahan" style="margin-top:-5px;" />
        </div>
        <div class="form-group col-md-4 col-sm-12">
          <label for="message-text" class="control-label">Harga panen (Rp):</label>
          <input type="text" class="form-control pull-right" id="hargapanen" style="margin-top:-5px;" />
        </div>
      </div>
    </form>
    <form>
      <div class="row">
        <div class="form-group col-md-4 col-sm-12">
          <label for="message-text" class="control-label">Komoditi:</label>
          <select class="form-control" id="tanaman">
            <option value="">[ Pilih Komoditi ]</option>
            <?php foreach ($komoditi->result() as $row) { ?>
            <option value="<?php echo $row->id_tanaman; ?>" data-prd="<?php echo $row->produktivitas; ?>"><?php echo $row->nm_tanaman; ?></option>
            <?php } ?>
          </select>
        </div>
        <input type="hidden" id="produktivitas" value="0"></input>
        <div class="form-group col-md-4 col-sm-12">
          <label for="message-text" class="control-label">Kab/Kota:</label>
          <select class="form-control" id="kota">
            <option value="">[ Pilih Kab/Kota ]</option>
          </select>
        </div>
        <div class="form-group col-md-4 col-sm-12">
          <label for="message-text" class="control-label">Kec/Desa:</label>
          <select class="form-control" id="desa">
              <option value="">[ Pilih Kec/Desa ]</option>
          </select>
        </div>
      </div>
      <input type="hidden" id="wilayah" value=""></input>
      <div class="row">
        <div class="form-group col-md-4 col-sm-12">
          <label for="message-text" class="control-label">Dari:</label>
          <div class='input-group date' id='dtDari'>
              <input type='text' class="form-control" />
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
              </span>
          </div>
        </div>
        <div class="form-group col-md-4 col-sm-12">
          <label for="message-text" class="control-label">Sampai:</label>
          <div class='input-group date' id='dtSampai'>
              <input type='text' class="form-control" />
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
              </span>
          </div>
        </div>
        <div class="form-group col-md-4 col-sm-12">
          <label for="message-text" class="control-label">Triwulan:</label>
            <div class="radio form-control" style="margin-top:0">
              <label style="padding-right:15px;">
                <input type="radio" name="triwulanRadio" id="triwulan1" value="I"> I</label>
              <label style="padding-right:15px;">
                <input type="radio" name="triwulanRadio" id="triwulan2" value="II"> II</label>
              <label style="padding-right:15px;">
                <input type="radio" name="triwulanRadio" id="triwulan3" value="III"> III</label>
              <label><input type="radio" name="triwulanRadio" id="triwulan4" value="IV"> IV</label>
            </div>
        </div>
      </div>
    </form>
    <form class="form-inline">
    </form>

    <p>&nbsp;</p>

    <div>
      <button style="margin-bottom: 5px;" type="button" class="btn btn-primary btn-sm pull-right" id="btnTambahDetail">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah data detail
      </button>
    </div>

    <table id="detail_opt" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Organisme</th>
          <th>Persentase Serang</th>
          <th>Kendali APBN</th>
          <th>Kendali APBD1</th>
          <th>Kendali APBD2</th>
          <th>Kendali Masyarakat</th>
          <th>Serangan Ringan</th>
          <th>Serangan Sedang</th>
          <th>Serangan Berat</th>
          <th>Harga panen (Rp)</th>
          <th>Kerugian Hasil</th>
          <th>Kerugian Produksi</th>
          <th>Pengendalian</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($detail->result() as $row) { ?>
          <tr>
            <td><?php echo $row->id_opt; ?></td>
            <td><?php echo $row->nm_opt; ?></td>
            <td><?php echo $row->persentaseserang; ?></td>
            <td><?php echo $row->APBN; ?></td>
            <td><?php echo $row->APBD1; ?></td>
            <td><?php echo $row->APBD2; ?></td>
            <td><?php echo $row->Masyarkat; ?></td>
            <td><?php echo $row->Ringan; ?></td>
            <td><?php echo $row->Sedang; ?></td>
            <td><?php echo $row->Berat; ?></td>
            <td><?php echo $row->hargapanen; ?></td>
            <td><?php echo $row->RugiHasil; ?></td>
            <td><?php echo $row->ProdukHasil; ?></td>
            <td><?php echo $row->CaraKendali; ?></td>
            <td><?php echo $row->id_opt; ?></td>
          </tr>
        <?php } ?>
        </tbody>
    </table>

    <div>
      <button type="button" class="btn btn-primary btn-lg" id="btnSave">Simpan</button>
      <img id="imgSave" src="<?php echo base_url(); ?>libs/images/loading.gif" style="display:none;height:50px;">
    </div>

  </div>

<div class="modal fade" id="frmDetailPengamatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Organisme Pengganggu Tanaman</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="organisme" class="col-sm-2 control-label">Organisme:</label>
            <div class="col-sm-10">
              <select class="form-control" id="organisme">
                  <option value="">[ Pilih organisme ]</option>
              </select>
            </div>
          </div>
        </form>

        <form class="form-inline">
          <p><label>Luas serangan (ha)</label></p>
          <div class="row">
            <div class="form-group col-md-4 col-sm-12">
              <p>
                <label for="ringan" style="font-weight:normal;">Ringan:</label>
                <input type="text" class="form-control pull-right" id="ringan" value="0" style="width:60px;margin-top:-5px;">
              </p>
            </div>
            <div class="form-group col-md-4 col-sm-12">
              <p>
                <label for="sedang" style="font-weight:normal;margin-left: 15px;">Sedang:</label>
                <input type="text" class="form-control pull-right" id="sedang" value="0" style="width:60px;margin-top:-5px;">
              </p>
            </div>
            <div class="form-group col-md-4 col-sm-12">
              <p>
                <label for="berat" style="font-weight:normal;margin-left: 15px;">Berat:</label>
                <input type="text" class="form-control pull-right" id="berat" value="0" style="width:60px;margin-top:-5px;">
              </p>
            </div>
          </div>
        </form>

        <form class="form-inline">
          <p><label>Luas pengendalian (ha)</label></p>
          <div class="row">
            <div class="form-group col-md-6 col-sm-12">
              <p>
                <label for="ringan" style="font-weight:normal;">APBN:</label>
                <input type="text" class="form-control pull-right" id="apbn" value="0" style="width:60px;margin-top:-5px;">
              </p>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <p>
                <label for="ringan" style="font-weight:normal;">APBD 2:</label>
                <input type="text" class="form-control pull-right" id="apbd2" value="0" style="width:60px;margin-top:-5px;">
              </p>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6 col-sm-12">
              <p>
                <label for="ringan" style="font-weight:normal;">APBD 1:</label>
                <input type="text" class="form-control pull-right" id="apbd1" value="0" style="width:60px;margin-top:-5px;">
              </p>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <p>
                <label for="ringan" style="font-weight:normal;">Masyarakat:</label>
                <input type="text" class="form-control pull-right" id="masyarakat" value="0" style="width:60px;margin-top:-5px;">
              </p>
            </div>
          </div>
        </form>

        <form>
          <div class="form-group">
            <label for="message-text" class="control-label">Cara Pengendalian:</label>
            <textarea class="form-control" rows="3" id="pengendalian"></textarea>
          </div>
        </form>

        <form class="form-horizontal">
          <div class="form-group">
            <label for="tanaman" class="col-sm-4 control-label">Kehilangan produksi:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="hilangproduksi" value="0">
            </div>
          </div>
          <div class="form-group">
            <label for="tanaman" class="col-sm-4 control-label">Kerugian hasil (Rp):</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="kerugianhasil" value="0">
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <img id="imgSimpan" src="<?php echo base_url(); ?>libs/images/loading.gif" style="height:32px;float:left;display:none;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="btnSimpanDetail">Simpan</button>
      </div>
    </div>
  </div>
</div>