	<div class="container">
        <div class="jumbotron" style="margin-top: 50px;">
			<h1>Akses ditolak!</h1>
			<p>Anda tidak punya akses ke halaman ini.</p>
			<?php
				$user = $this->session->userdata("userinfo");
        		if(!$user) { 
			?>
			<p><a class="btn btn-primary btn-lg" href="<?php echo site_url('akun/login'); ?>" role="button">Login</a></p>
			<?php } else { ?>
			<p><a class="btn btn-primary btn-lg" href="javascript:window.history.back()" role="button">Kembali</a></p>
			<?php } ?>
		</div>
    </div>