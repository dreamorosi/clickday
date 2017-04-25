<script type="text/javascript">
	window.role = "<?php echo $this->data['role'] = $this->session->userdata('role'); ?>";
	window.ID = "<?php echo $this->data['role'] = $this->session->userdata('ID'); ?>";
</script>
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head_dash.php';
	echo '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/dashboard.css') . '"/>';
	echo '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/magnifier.css') . '"/>';
	echo '</head>';

	include_once 'header_dash.php';

	echo "<script>window.navActive = 'screenshots';</script>";
	include_once 'navbar_dash.php';

	echo "<script>window.screens = " . $screens . ";</script>";
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="panel panel-default screenWidget">
		<div class="panel-heading">Screenshots</div>
		<div class="panel-body table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>User</th>
						<th>Screenshot</th>
						<th>Zoom</th>
						<th>
							<small>Utenti per pagina</small>
							<select class="pageSpan">
								<option val="5" selected>5</option>
								<option val="10">10</option>
								<option val="20">20</option>
							</select>
						</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<div class="panel-footer text-center">
			<nav>
				<ul class="pagination"></ul>
			</nav>
		</div>
	</div>
</div>
<script src="<? echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
<script src="<? echo base_url('assets/js/jquery.noty.packaged.min.js') ?>"></script>
<script src="<? echo base_url('assets/js/Event.js'); ?>"></script>
<script src="<? echo base_url('assets/js/Magnifier.js'); ?>"></script>
<script src="<? echo base_url('assets/js/pagination.js'); ?>"></script>
<script src="<? echo base_url('assets/js/notifications.js'); ?>"></script>
<script src="<? echo base_url('assets/js/screens.js'); ?>"></script>

</body>
</html>
