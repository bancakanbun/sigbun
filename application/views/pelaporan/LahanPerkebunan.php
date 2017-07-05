    <div class="container sigbun-container">
      <h2>Data lahan perkebunan</h2>

      <table id="example" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Komoditi</th>
                <th>Kec/desa</th>
                <th>Kab/kota</th>
                <th>Luas lahan (ha)</th>
                <th>Harga panen</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach ($data->result() as $row) { 
                echo '<tr>';
                echo '<td>'.$row->id_wilayah.'</td>';
                echo '<td>'.$row->nm_tanaman.'</td>';
                echo '<td>'.$row->nm_desa.'</td>';
                echo '<td>'.$row->nm_kota.'</td>';
                echo '<td>'.$row->luasdaerah.'</td>';
                echo '<td>'.$row->harga.'</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    </div>
