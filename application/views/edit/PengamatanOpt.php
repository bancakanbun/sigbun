    <div class="container sigbun-container">
      <h2>Pengamatan organisme pengganggu tanaman</h2>

      <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Tahun</th>
                <th>Triwulan</th>
                <th>Kab/kota</th>
                <th>Kec/desa</th>
                <th>Komoditas</th>
                <th>Organisme</th>
                <th>Harga panen (Rp)</th>
                <th>Luas lahan (ha)</th>
                <th>Total rugi (Rp)</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Tahun</th>
                <th>Triwulan</th>
                <th>Kab/kota</th>
                <th>Kec/desa</th>
                <th>Komoditas</th>
                <th>Organisme</th>
                <th>Harga panen (Rp)</th>
                <th>Luas lahan (ha)</th>
                <th>Total rugi (Rp)</th>
                <th>&nbsp;</th>
            </tr>
        </tfoot>
        <tbody>
        <?php 
            foreach ($data->result() as $row) { 
                echo '<tr>';
                echo '<td>'.$row->idinfo.'</td>';
                echo '<td>'.$row->tanggal.'</td>';
                echo '<td>'.$row->nm_tahun.'</td>';
                echo '<td>'.$row->triwulan.'</td>';
                echo '<td>'.$row->nm_kota.'</td>';
                echo '<td>'.$row->nm_desa.'</td>';
                echo '<td>'.$row->nm_tanaman.'</td>';
                echo '<td>'.$row->nm_opt.'</td>';
                echo '<td>'.$row->hargapanen.'</td>';
                echo '<td>'.$row->luasdaerah.'</td>';
                echo '<td>'.$row->total_rugi.'</td>';
                echo '<td>
                    <button type="button" class="btn btn-default btn-xs btnEdit" data-kode="'.$row->idinfo.'">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs btnDelete" data-kode="'.$row->idinfo.'">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>

    <a class="btn btn-primary btn-lg" role="button" href="<?php echo site_url('edit/pengamatan/tambah'); ?>">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah data
    </a>
</div>
