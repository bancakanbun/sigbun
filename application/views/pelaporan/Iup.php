    <div class="container sigbun-container">
      <h2>Daftar pemegang IUP</h2>

      <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nama perusahaan</th>
                <th>Komoditi</th>
                <th>SK IUP</th>
                <th>SK ILOK</th>
                <th>Status SK</th>
                <th>Tanggal SK</th>
                <th>Akhir SK</th>
                <th>Kota/Kabupaten</th>
                <th>Lokasi</th>
                <th>Luas wilayah</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nama perusahaan</th>
                <th>Komoditi</th>
                <th>SK IUP</th>
                <th>SK ILOK</th>
                <th>Status SK</th>
                <th>Tanggal SK</th>
                <th>Akhir SK</th>
                <th>Kota/Kabupaten</th>
                <th>Lokasi</th>
                <th>Luas wilayah</th>
            </tr>
        </tfoot>
        <tbody>
        <?php 
            foreach ($data as $row) { 
                echo '<tr>';
                echo '<td>'.$row->namaobj.'</td>';
                echo '<td>'.$row->jnskbn.'</td>';
                echo '<td>'.$row->sk_iup.'</td>';
                echo '<td>'.$row->sk_ilok.'</td>';
                echo '<td>'.$row->statussk.'</td>';
                echo '<td>'.$row->tglsk.'</td>';
                echo '<td>'.$row->akhirsk.'</td>';
                echo '<td>'.$row->wadmkk.'</td>';
                echo '<td>'.$row->lokasi.'</td>';
                echo '<td>'.$row->shape_area.'</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    </div>
