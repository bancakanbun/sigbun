    <div class="container sigbun-container">
        <h2>Dashboard</h2>

		<div class="panel panel-default">
			<div class="panel-heading">
		        <form class="form-inline">
					<label for="tahun1" style="font-size: large;">Jumlah serangan organisme penggangu tanaman</label>
			        <select class="form-control input-sm pull-right" id="tahun1">
						<option value="">[ Pilih Tahun ]</option>
						<?php foreach ($tahun->result() as $row) { ?>
						<option value="<?php echo $row->nm_tahun; ?>"><?php echo $row->nm_tahun; ?></option>
						<?php } ?>
					</select>
		    	</form>
			</div>
	        <div class="row">
	            <div class="col-xs-12 sigbun-chart-container sigbun-chart-container1" id="dashboard01"></div>
	        </div>
		</div>

		<?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
		        <form class="form-inline">
					<label for="tahun1" style="font-size: large;">Jumlah kerugian (rupiah) akibat organisme penggangu tanaman</label>
			        <select class="form-control input-sm pull-right" id="tahun2">
						<option value="">[ Pilih Tahun ]</option>
						<?php foreach ($tahun->result() as $row) { ?>
						<option value="<?php echo $row->nm_tahun; ?>"><?php echo $row->nm_tahun; ?></option>
						<?php } ?>
					</select>
		    	</form>
			</div>
	        <div class="row">
	            <div class="col-xs-12 sigbun-chart-container sigbun-chart-container1" id="dashboard02"></div>
	        </div>
		</div>
		<?php } ?>

		<div class="panel panel-default">
			<div class="panel-heading">
		        <form class="form-inline">
					<label for="tahun1" style="font-size: large;">Luas daerah IUP berdasarkan Kota/Kabupaten</label>
		    	</form>
			</div>
	        <div class="row">
	            <div class="col-xs-12 sigbun-chart-container sigbun-chart-container1" id="dashboard03"></div>
	        </div>
		</div>

		<?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
		        <form class="form-inline">
					<label for="tahun1" style="font-size: large;">Luas daerah IUP berdasarkan status SK</label>
		    	</form>
			</div>
	        <div class="row">
	            <div class="col-xs-12 sigbun-chart-container sigbun-chart-container1" id="dashboard04"></div>
	        </div>
		</div>
		<?php } ?>

    </div>
