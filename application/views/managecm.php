<script type="text/javascript">
	window.role = "<?php echo $this->data['role'] = $this->session->userdata('role'); ?>";
	window.ID = "<?php echo $this->data['role'] = $this->session->userdata('ID'); ?>";
</script>
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head_dash.php';
	echo '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/animate.min.css') . '"/>';
	echo '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/dashboard.css') . '"/>';
	echo '</head>';

	include_once 'header_dash.php';

	echo "<script>window.navActive = 'managecm';</script>";
	include_once 'navbar_dash.php';

	echo "<script>window.cMs = " . $cMs . ";</script>";
?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default cmlistWidget">
					<div class="panel-heading">Lista Click Master</div>
					<div class="panel-body table-responsive">
						<table class="table table-striped cmT">
							<thead>
								<tr>
									<th>Nome Completo</th>
									<th>Codici ClickMaster</th>
									<th>Email</th>
									<th>Utenti associati</th>
									<th>Con | Senza Progetto</th>
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
		</div>

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">Aggiungi Click Master</div>
					<div class="panel-body addCM">
						<form>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nome Completo</label>
										<input type="text" class="form-control" name="fullName" tabindex="1" autocomplete="off" required/>
										<small class="hidden text-danger">Per favore inserisci un Nome</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Codici</label>
										<input type="text" class="form-control" name="code" tabindex="4" autocomplete="off" required/>
										<small class="hidden text-danger">Per favore inserisci almeno un Codice ClickMaster</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" name="email" tabindex="3" autocomplete="off" required/>
										<small class="hidden text-danger">Per favore inserisci un Email</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<button type="submit" class="btn btn-primary btn-block newCm"><span>Aggiungi</span></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<script src="<? echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/notifications.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/pagination.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/jquery.noty.packaged.min.js') ?>"></script>
	<script src="<? echo base_url('assets/js/managecm.js'); ?>"></script>

</body>
</html>
