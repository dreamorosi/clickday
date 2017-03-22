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

	$name = 'Admin '. $name;

	include_once 'header_dash.php';

	echo "<script>window.code = '" . $code . "';</script>";
	echo "<script>window.navActive = 'codes';</script>";
	echo "<script>window.notCodeUsers = '" . $notCodeUsers . "';</script>";
	include_once 'navbar_dash.php';
?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default codesWidget">
					<div class="panel-heading">
						<span>Assegna Codici</span>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<form data-projects="cl">
									<span>Utenti a cui assegnare un codice</span>
									<input type="number" class="form-control" autocomplete="off" tabindex="1" required />
									<br />
									<span>Tipo di progetto</span>
									<label>
										<input type="radio" value="cl" name="type" checked />
										Classico
									</label>
									<label>
										<input type="radio" value="sc" name="type">
										Solo Click
									</label>
									<br />
									<span>Assegnazione</span>
									<label>
										<input type="checkbox" name="assign" checked />
										Automatica
									</label>
									<select data-projects="cl" disabled>
										<? foreach($projects_classic as $file) {
 										echo  "<option value='". $file["file"] ."'>". $file["file"] . ' - ' . $file["region"] ."</option>";
 										}
 										?>
 									</select>
									<select data-projects="sc" class="hidden" disabled>
										<? foreach($projects_sc as $file) {
 										echo  "<option value='". $file["file"] ."'>". $file["file"] . ' - ' . $file["region"] ."</option>";
 										}
 										?>
 									</select>
									<br />
									<button type="submit" class="btn btn-sm btn-default">
										<span>Assegna</span>
										<i class="glyphicon glyphicon-refresh hidden"></i>
									</button>
								</form>
							</div>
							<div class="col-md-6 text-center">
								<h2>
									<i class="glyphicon glyphicon-user"></i><span></span><i class="glyphicon glyphicon glyphicon-arrow-down hidden"></i>
								</h2>
								<small class="text-uppercase">Utenti senza codice</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?
	include_once 'footer_dash.php';
	echo '</div>';
?>
	<script src="<? echo base_url('assets/js/jquery.animateNumber.min.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/jquery.noty.packaged.min.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/codes.js'); ?>"></script>
</body>
</html>
