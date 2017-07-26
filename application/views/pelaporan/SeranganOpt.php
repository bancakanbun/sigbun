    <div class="container-fluid sigbun-container">
      <h2>Rekapitulasi serangan organisme pengganggu tanaman</h2>

      <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Organisme</th>
                <th>Triwulan</th>
                <th>Kab/kota</th>
                <th>Kec/desa</th>
                <th>Komoditas</th>
                <th>Serangan ringan (Ha)</th>
                <th>Serangan sedang (Ha)</th>
                <th>Serangan berat (Ha)</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Tahun</th>
                <th>Organisme</th>
                <th>Triwulan</th>
                <th>Kab/kota</th>
                <th>Kec/desa</th>
                <th>Komoditas</th>
                <th>Serangan ringan (Ha)</th>
                <th>Serangan sedang (Ha)</th>
                <th>Serangan berat (Ha)</th>
            </tr>
        </tfoot>
        <tbody>
        <?php 
            foreach ($data->result() as $row) { 
                echo '<tr>';
                echo '<td>'.$row->nm_tahun.'</td>';
                echo '<td>'.$row->nm_opt.'</td>';
                echo '<td>'.$row->triwulan.'</td>';
                echo '<td>'.$row->nm_kota.'</td>';
                echo '<td>'.$row->nm_desa.'</td>';
                echo '<td>'.$row->nm_tanaman.'</td>';
                echo '<td>'.$row->Ringan.'</td>';
                echo '<td>'.$row->Sedang.'</td>';
                echo '<td>'.$row->Berat.'</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    </div>
