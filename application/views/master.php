<?php
  if(!isset($load_map)) $load_map=false;
  if(!isset($load_datatable)) $load_datatable=false;
  if(!isset($load_chart)) $load_chart=false;
  if(!isset($custom_css)) $custom_css="";
  if(!isset($custom_js)) $custom_js="";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Informasi Geospasial Dinas Perkebunan - Kalimantan Timur</title>

    <link href="<?php echo base_url(); ?>libs/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>libs/css/sigbun.css" rel="stylesheet">

    <?php if($load_map) { ?>
    <link href="<?php echo base_url(); ?>libs/css/leaflet.css" rel="stylesheet">
    <?php } ?>

    <?php if($load_datatable) { ?>
    <link href="<?php echo base_url(); ?>libs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <?php } ?>

    <?php if($load_chart) { ?>
    <link href="<?php echo base_url(); ?>libs/css/highcharts.css" rel="stylesheet">
    <?php } ?>

    <?php if($custom_css!="") { $this->load->view($custom_css); } ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top sigbun-navbar">
      <div class="container-fluid">
        <div class="navbar-header sigbun-navbar-header">
          <div class="navbar-brand sigbun-navbar-brand">
            <img alt="Kalimantan Timur" src="<?php echo base_url(); ?>libs/images/logo.png">
            <h3>Sistem Informasi Geospasial Dinas Perkebunan - Kalimantan Timur</h3>
            <br>
            <div class="sigbun-navbar-menu">
              <div class="sigbun-navbar-menu-left">
                <a href="#">Tentang aplikasi</a> | 
                <a href="#">Bantuan</a>
              </div>
              <div class="sigbun-navbar-menu-right">
                <a href="#">Registrasi</a> | 
                <a href="#">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="sigbun-left-menu">
      <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#leftmenu" aria-expanded="false" aria-controls="leftmenu">
        MENU <span class="caret"></span>
      </button>
      <?php
        if(!isset($active_menu)) $active_menu="";
        
        $peta_active = ($active_menu=="peta");
        $dashboard_active = ($active_menu=="dashboard");
        $pelaporan_active = ($active_menu=="pelaporan");
        $admin_active = ($active_menu=="admin");
        $update_active = ($active_menu=="update");
      ?>
      <div class="collapse" id="leftmenu">
        <a <?php if($peta_active) { ?>class="active" <?php } ?>href="<?php echo site_url(); ?>">
          <span class="glyphicon glyphicon-globe" aria-hidden="true"></span><br>Peta</a>
        <a <?php if($dashboard_active) { ?>class="active" <?php } ?>href="<?php echo site_url('dashboard'); ?>">
          <span class="glyphicon glyphicon-search" aria-hidden="true"></span><br>Dashboard</a>
        <a <?php if($pelaporan_active) { ?>class="active" <?php } ?>href="<?php echo site_url('pelaporan'); ?>">
          <span class="glyphicon glyphicon-stats" aria-hidden="true"></span><br>Pelaporan</a>
        <a <?php if($admin_active) { ?>class="active" <?php } ?>href="<?php echo site_url(); ?>">
          <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><br>Administrasi</a>
        <a <?php if($update_active) { ?>class="active" <?php } ?>href="<?php echo site_url(); ?>">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><br>Update data</a>
      </div>          
    </div>

    <?php 
      if($template!="") { 
        $newdata['data'] = isset($data) ? $data : null;
        $this->load->view($template,$newdata); 
      } 
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>libs/js/bootstrap.min.js"></script>

    <?php if($load_map) { ?>
    <script src="<?php echo base_url(); ?>libs/js/leaflet.js"></script>
    <?php } ?>

    <?php if($load_datatable) { ?>
    <script src="<?php echo base_url(); ?>libs/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/js/dataTables.bootstrap.min.js"></script>
    <?php } ?>

    <?php if($load_chart) { ?>
    <script src="<?php echo base_url(); ?>libs/js/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>libs/js/modules/exporting.js"></script>
    <?php } ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#leftmenu').collapse('show');
      });

      <?php 
        if($custom_js!="") { 
          $this->load->view($custom_js,isset($custom_js_data) ? $custom_js_data : null); 
        } 
      ?>

    </script>

  </body>
</html>