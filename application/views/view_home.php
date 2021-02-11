<?php
	if (!$this->session->userdata('logged_in')){
		redirect('login');
	}
	if(!isset($tela) || empty($tela)){
		$tela='view_dashboard';
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>SistemaYoutube | Dashboard</title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.7 -->
	  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css')?>">
	  <!-- DataTables -->
  	  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')?>">
	  <!-- jvectormap -->
	  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/jvectormap/jquery-jvectormap.css')?>">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css')?>">
	  <!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
	  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css')?>">

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->

	  <!-- Google Font -->
	  <link rel="stylesheet"
	        href="<?php echo base_url('assets/css/dashboard.fonts.googleapis.com.css')?>">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">

			<?php
				$this->load->view('template/header');
				$this->load->view('template/topbar');
				$this->load->view('template/sidebar');
				$this->load->view('template/configbar');
			?>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!--<?php
	            	if(isset($msg) && isset($msg_tipo)){
	            		set_msg($msg,$msg_tipo);
	            	}
	        	?>-->
	  			<?php
		  			if($tela !=''){
						$this->load->view('telas/'.$tela);
		  			}
				?>
				
			 </div>
  			<!-- /.content-wrapper -->

			<?php
				$this->load->view('template/footer');
				$this->load->view('template/controlbar');
				$this->load->view('template/js');

			?>
		</div>
		<!-- ./wrapper -->


		<!-- jQuery 3 -->		
		<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
		<!-- DataTables -->
		<script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')?>"></script>
		<script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>
		<!-- FastClick -->
		<script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js')?>"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo base_url('assets/dist/js/adminlte.min.js')?>"></script>
		<!-- Sparkline -->
		<script src="<?php echo base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')?>"></script>
		<!-- jvectormap  -->
		<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
		<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
		<!-- SlimScroll -->
		<script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
		<!-- ChartJS -->
		<script src="<?php echo base_url('assets/bower_components/chart.js/Chart.js')?>"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<!--<script src="<?php echo base_url('assets/dist/js/pages/dashboard2.js')?>"></script>-->
		<!-- AdminLTE for demo purposes -->
		<script src="<?php echo base_url('assets/dist/js/demo.js')?>"></script>
	</body>
</html>