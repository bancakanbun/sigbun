    <div class="container-fluid sigbun-container">
      <h2>Daftar komoditi perkebunan</h2>

      <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Komoditi</th>
                <th>Produktivitas (%)</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach ($data->result() as $row) { 
                echo '<tr>';
                echo '<td>'.$row->id_tanaman.'</td>';
                echo '<td>'.$row->nm_tanaman.'</td>';
                echo '<td>'.$row->produktivitas.'</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    </div>
