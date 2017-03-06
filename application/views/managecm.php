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
	echo '<div class="container-fluid"><div class="row"><div class="col-sm-3 col-md-2 sidebar"><ul class="nav nav-sidebar noHover">
			<li><a href="' . base_url('dashboard') . '">' . $name . ' ' . $surname;
	if($cnots > 0) echo '<span class="badge pull-right" id="cnots2">' . $cnots . ' <span class="glyphicon glyphicon-envelope"></span>';
	echo '</span></a></li></ul><ul class="nav nav-sidebar items">';
	if($role != 'user'):
		echo '<li><a href="' . base_url('dashboard') . '">Home</a></li>';
		if($role == 'admin') echo '<li class="active"><a href="'. base_url('dashboard/managecm') .'">ClickMasters</a></li>';
		echo '<li><a href="'. base_url('dashboard/userlist') .'">Liste Utenti</a></li>';
		echo '<li><a href="'. base_url('dashboard/screens') .'">Screenshots</a></li>';
		echo '<li><a href="' . base_url('dashboard/projects') . '">Elenco Progetti</a></li>';
	endif;
	echo '<li><a href="#"  data-toggle="modal" data-target=".winners">Lista Cliccatori vincenti</a></li>';
	echo '<li><a href="' . base_url('login/signout/') . '">Logout</a></li>
			</ul>
			</div>';

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
									<th>Click Master</th>
									<th>Codice ClickMaster</th>
									<th>Email</th>
									<th>Utenti associati</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?
									$k = 0;
									while(($k < $pageSpan)&&($k <count($rawCMs))) :
										echo '<tr class="user-line" data-ID="'. $rawCMs[$k]['ID'] .'"><td class="cmName"><b>'. $rawCMs[$k]['name'] .'</b></td><td class="cmCode">'. $rawCMs[$k]['code'] .'</td><td class="cmEmail">'. $rawCMs[$k]['email'] .'</td><td class="cmUsers"><span>'. $rawCMs[$k]['users'] .'</span><span class="glyphicon glyphicon-search"></span></td><td class="cmActions"><span class="label label-info"><span class="glyphicon glyphicon-pencil"></span></span> <span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td></tr>';
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
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Aggiungi Click Master</div>
					<div class="panel-body addCM">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nome</label>
									<input type="text" class="form-control" name="name" tabindex="1" autocomplete="off" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Cognome</label>
									<input type="text" class="form-control" name="surname" tabindex="2" autocomplete="off" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>eMail</label>
									<input type="email" class="form-control" name="email" tabindex="3" autocomplete="off" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Codice</label>
									<input type="text" class="form-control" name="code" tabindex="4" autocomplete="off" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-right">
								<p class="text-danger hidden"></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<button class="btn btn-primary btn-block newCm"><span>Aggiungi</span></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default detailsClickWidget">
					<div class="panel-heading">Dettagli Click Master</div>
					<div class="panel-body table-responsive">
						<p class="emptyDetails"><span class="glyphicon glyphicon-search"></span> Clicca su un Click Master per visualizzare i suoi utenti associati.</p>
						<table class="table table-striped hidden">
							<thead>
								<tr>
									<th></th>
									<th>User</th>
									<th>Data registrazione</th>
									<th>ClickMaster Associato</th>
									<th>Conferma registrazione</th>
									<th>Codice ricevuto</th>
									<th>Screenshot</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="panel-footer text-center hidden">
						<nav>
							<ul class="pagination" id="usrPages">
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade sendmessage confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" data-backdrop="static">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title">Attenzione</h4>
				</div>
				<div class="modal-body">
					<p></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
					<button type="button" data-loading-text="Caricamento" class="btn btn-primary">Conferma</button>
				</div>
			</div>
		</div>
	</div>
<?
	include_once 'footer_dash.php';
	echo '</div>';
?>

	<script src="<? echo base_url('assets/js/managecm.js'); ?>"></script>

</body>
</html>
