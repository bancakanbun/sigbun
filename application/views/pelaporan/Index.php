    <div class="container-fluid sigbun-container">
        <h2>Pelaporan</h2>

        <div class="list-group">
            
        <?php if( !CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
            <a class="list-group-item list-group-item-info" href="<?php echo site_url('pelaporan/komoditi');?>">
                &raquo;&nbsp;Daftar komoditi perkebunan
            </a>
            <a class="list-group-item" href="<?php echo site_url('pelaporan/opt');?>">
                &raquo;&nbsp;Daftar organisme penggangu tanaman
            </a>
            <a class="list-group-item list-group-item-info" href="<?php echo site_url('pelaporan/pengamatanopt');?>">
                &raquo;&nbsp;Rekapitulasi pengamatan organisme pengganggu tanaman
            </a>
        <?php } else { ?>
        	<a class="list-group-item list-group-item-info" href="<?php echo site_url('pelaporan/komoditi');?>">
        		&raquo;&nbsp;Daftar komoditi perkebunan
        	</a>
        	<a class="list-group-item" href="<?php echo site_url('pelaporan/opt');?>">
        		&raquo;&nbsp;Daftar organisme penggangu tanaman
        	</a>
            <a class="list-group-item list-group-item-info" href="<?php echo site_url('pelaporan/lahankebun');?>">
        		&raquo;&nbsp;Data lahan perkebunan
        	</a>
            <a class="list-group-item" href="<?php echo site_url('pelaporan/pengamatanopt');?>">
                &raquo;&nbsp;Rekapitulasi pengamatan organisme pengganggu tanaman
            </a>
            <a class="list-group-item list-group-item-info" href="<?php echo site_url('pelaporan/seranganopt');?>">
                &raquo;&nbsp;Rekapitulasi serangan organisme pengganggu tanaman
            </a>
            <a class="list-group-item" href="<?php echo site_url('pelaporan/iup');?>">
                &raquo;&nbsp;Daftar pemegang IUP
            </a>
        <?php } ?>
        </div>	
    </div>
