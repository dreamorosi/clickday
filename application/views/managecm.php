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

	if($role=='admin'):
		$name = 'Admin '. $name;
	endif;

	include_once 'header_dash.php';

	echo "<script>window.navActive = 'managecm';</script>";
	include_once 'navbar_dash.php';

	echo "<script>window.cMs = " . $cMs . ";</script>";
	echo "<script>window.pageSpan = " . $pageSpan . ";</script>";
	echo "<script>window.maxOffset = " . $maxOffset . ";</script>";
	echo "<script>window.pages = " . $pages . ";</script>";
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
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?
									$k = 0;
									while(($k < $pageSpan)&&($k <count($rawCMs))) :
										$tr = '<tr class="user-line" data-ID="'. $rawCMs[$k]['ID'] .'">';

										$tr .= '<td><b>'. $rawCMs[$k]['name'] .'</b></td>';
										$tr .= '<td>'. $rawCMs[$k]['code'] .'</td>';
										$tr .= '<td>'. $rawCMs[$k]['email'] .'</td>';
										$tr .= '<td>'. $rawCMs[$k]['users'] .'</td>';

										$editBtn = '<button class="btn btn-sm btn-info editCm" title="Modifica Clickmaster"><span class="glyphicon glyphicon-pencil"></span></button>';

										$deleteBtn = '<button title="Elimina ClickMaster" class="btn btn-sm btn-danger deleteCm"><span class="glyphicon glyphicon-remove"></span></button>';

										$tr .= '<td>' . $editBtn . ' ' . $deleteBtn . '</td>';

										$tr .= '</tr>';
										echo $tr;
										$k++;
									endwhile;
								?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer text-center">
						<nav>
							<ul class="pagination" id="cmPages">
								<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
								<?
									echo '<li id="pag1" class="active" data-offset="0"><a href="#">1</a></li>';
									$k = 1;
									while($k < $pages):
										echo '<li id="pag'. ($k+1) .'" data-offset="'. $k*$pageSpan .'"><a href="#">'. ($k+1) .'</a></li>';
										$k++;
									endwhile;
								?>
								<li class="<? if($pages==1) echo 'disabled'; ?> ext next"><a data-toggle="tooltip" data-trigger="manual" data-html="true" data-placement="bottom" title='<span class="glyphicon glyphicon-ok"></span>' href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
							</ul>
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
										<label>Nome</label>
										<input type="text" class="form-control" name="name" tabindex="1" autocomplete="off" required/>
										<small class="hidden text-danger">Per favore inserisci un Nome</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Cognome</label>
										<input type="text" class="form-control" name="surname" tabindex="2" autocomplete="off" required/>
										<small class="hidden text-danger">Per favore inserisci un Cognome</small>
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
								<div class="col-md-6">
									<div class="form-group">
										<label>Codici</label>
										<input type="text" class="form-control" name="code" tabindex="4" autocomplete="off" required/>
										<small class="hidden text-danger">Per favore inserisci almeno un Codice ClickMaster</small>
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
	<script src="<? echo base_url('assets/js/managecm.js'); ?>"></script>

</body>
</html>
