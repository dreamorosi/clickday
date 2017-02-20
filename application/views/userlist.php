<script type="text/javascript">
	window.role = "<?php echo $this->data['role'] = $this->session->userdata('role'); ?>";
	window.ID = "<?php echo $this->data['role'] = $this->session->userdata('ID'); ?>";
</script>
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head_dash.php';
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
		if($role == 'admin') echo '<li><a href="'. base_url('dashboard/managecm') .'">ClickMasters</a></li>';
		echo '<li class="active"><a href="'. base_url('dashboard/userlist') .'">Liste Utenti</a></li>
			  <li><a href="'. base_url('dashboard/screens') .'">Screenshots</a></li>';
		if($role == 'clickMaster') echo '<li><a href="'.base_url('dashboard/codes').'">Assegna Codici</a></li>';
	endif;
	echo '<li><a href="#"  data-toggle="modal" data-target=".winners">Lista Cliccatori vincenti</a></li>';
	echo '<li><a href="' . base_url('login/signout/') . '">Logout</a></li>
			</ul>
			</div>';

	echo "<script>window.users = " . $users . ";</script>";
	echo "<script>window.pageSpan = " . $pageSpan . ";</script>";
	echo "<script>window.maxOffset = " . $maxOffset . ";</script>";
	echo "<script>window.projects_classic = " . json_encode($projects_classic) . ";</script>";
	echo "<script>window.projects_sc = " . json_encode($projects_sc) . ";</script>";
	echo "<script>window.fixcode = " . $fixcode . ";</script>";

	include_once 'message_modals.php';
?>
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

	<div class="modal fade sendmessage confirm2" tabindex="-1" role="dialog" aria-labelledby="confirm2" data-backdrop="static">
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
					<button type="button" data-loading-text="Caricamento" class="btn btn-primary delcode">Conferma</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade sendmessage deletecode" tabindex="-1" role="dialog" aria-labelledby="confirm" data-backdrop="static">
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
	if($role=='clickMaster'):
?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default userlistWidget">
					<div class="panel-heading text-right"><span class="pull-left">Lista utenti</span> <a href="<? echo base_url('dashboard/printList'); ?>" target="_blank" class="btn btn-sm btn-default"><span class="print glyphicon glyphicon-print"></span> Stampa</a></div>
					<div class="panel-body table-responsive">
						<input type="text" class="form-control"   placeholder="Cerca" tabindex="1" id="search"/>
						<table class="table table-striped">
							<thead>
								<tr>
									<th></th>
									<th>User</th>
									<th>Data registrazione</th>
									<th>ClickMaster Associato</th>
									<th>Conferma registrazione</th>
									<th>Codice ricevuto</th>
									<th>Screenshot</th>
									<th>Contratto</th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody class="se">
								<?
									$k = 0;
									while(($k < $pageSpan)&&($k <count($rawUsers))) :
										$region = "";
										$sent = "";
										if($rawUsers[$k]['code_rec']=="No")
											$select_projects_classic = "<select id='select". $rawUsers[$k]['ID'] ."' class='select_code_classic'><option value='Progetto CL'>Progetto CL</option>";
										else {
											$select_projects_classic = "<select id='select". $rawUsers[$k]['ID'] ."' class='select_code_classic' disabled><option value='Progetto CL'>Progetto CL</option>";
											$sent = "sent";
										}
										foreach($projects_classic as $file) {
											if($rawUsers[$k]['code']!=$file["file"])
												$select_projects_classic .=  "<option value='". $file["region"] ."'>". $file["file"] ."</option>";
											else {
												$select_projects_classic .=  "<option value='". $file["region"] ."' selected>". $file["file"] ."</option>";
												$region = $rawUsers[$k]['region'];
											}
										}
										$select_projects_classic .= "</select>";

										echo '<tr class="user-line" data-id="'. $rawUsers[$k]['ID'] .'" data-name="'. $rawUsers[$k]['name'] .'" ><td><div class="status-circle status'. $rawUsers[$k]['status'] .'"></div></td><td class="cName"><b>'. $rawUsers[$k]['name'] .'</b></td><td>'. $rawUsers[$k]['join'] .'</td><td>'. $rawUsers[$k]['clickM'] .'</td><td>'. $rawUsers[$k]['approved'] .'</td><td>'. $rawUsers[$k]['code_rec'] .'</td><td>'. $rawUsers[$k]['screen'] .'</td><td>'.$rawUsers[$k]['contract'].'</td><td '.$fixcode.' class="select_td">'.$select_projects_classic.'</td><td '.$fixcode.' class="select_region">'. $region .'<td '.$fixcode.' class="sendcode '.$sent.'"><span class="glyphicon glyphicon-arrow-right"></span></td></td><td class="setsendmessage2"><span class="glyphicon glyphicon-envelope"></span></td><td class="noDet"><span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td></tr>';
										$k++;
									endwhile;
								?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer text-center">
						<nav>
							<ul class="pagination" id="usrPages">
								<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
								<?
									echo '<li id="pag1" class="active" data-offset="0"><a href="#">1</a></li>';
									$k = 1;
									while($k < $pages):
										echo '<li id="pag'. ($k+1) .'" data-offset="'. $k*$pageSpan .'"><a href="#">'. ($k+1) .'</a></li>';
										$k++;
									endwhile;
								?>
								<li class="<? if($pages==1) echo 'disabled'; ?> ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
<?
	//Admin section
	else:
?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default userlistWidget">
					<div class="panel-heading text-right"><span class="pull-left">Lista utenti</span> <a href="<? echo base_url('dashboard/printList'); ?>" target="_blank" class="btn btn-sm btn-default"><span class="print glyphicon glyphicon-print"></span> Stampa</a><a href="<? echo base_url('assets/uploads/screenshots/'); ?>" target="_blank" class="btn btn-sm btn-default"><span class="print glyphicon glyphicon-picture"></span> Screenshots</a></div>
					<div class="panel-body table-responsive">
						<input type="text" class="form-control"   placeholder="Cerca" tabindex="1" id="search"/>
						<table class="table table-striped">
							<thead>
								<tr>
									<th></th>
									<th>User</th>
									<th>Data registrazione</th>
									<th>ClickMaster Associato</th>
									<th>Conferma registrazione</th>
									<th>Codice ricevuto</th>
									<th>Screenshot</th>
									<th>Contratto</th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?
									$k = 0;
									while(($k < $pageSpan)&&($k <count($rawUsers))) :
										$region = "";
										$sent = "";
										if($rawUsers[$k]['code_rec']=="No")
											$select_projects_classic = "<select id='select". $rawUsers[$k]['ID'] ."' class='select_code_classic'><option value='Progetto CL'>Progetto CL</option>";
										else {
											$select_projects_classic = "<select id='select". $rawUsers[$k]['ID'] ."' class='select_code_classic' disabled><option value='Progetto CL'>Progetto CL</option>";
											$sent = "sent";
										}
										foreach($projects_classic as $file) {
											if($rawUsers[$k]['code']!=$file["file"])
												$select_projects_classic .=  "<option value='". $file["region"] ."'>". $file["file"] ."</option>";
											else {
												$select_projects_classic .=  "<option value='". $file["region"] ."' selected>". $file["file"] ."</option>";
												$region = $rawUsers[$k]['region'];
											}
										}
										$select_projects_classic .= "</select>";

										echo '<tr class="user-line" data-id="'. $rawUsers[$k]['ID'] .'" data-name="'. $rawUsers[$k]['name'] .'" ><td><div class="status-circle status'. $rawUsers[$k]['status'] .'"></div></td><td class="cName"><b>'. $rawUsers[$k]['name'] .'</b></td><td>'. $rawUsers[$k]['join'] .'</td><td>'. $rawUsers[$k]['clickM'] .'</td><td>'. $rawUsers[$k]['approved'] .'</td><td>'. $rawUsers[$k]['code_rec'] .'</td><td>'. $rawUsers[$k]['screen'] .'</td><td>'.$rawUsers[$k]['contract'].'</td><td class="select_td">'.$select_projects_classic.'</td><td class="select_region">'. $region .'<td class="sendcode '.$sent.'"><span class="glyphicon glyphicon-arrow-right"></span></td></td><td class="setsendmessage2"><span class="glyphicon glyphicon-envelope"></span></td><td class="noDet"><span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td></tr>';
										$k++;
									endwhile;
								?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer text-center">
						<nav>
							<ul class="pagination" id="usrPages">
								<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
								<?
									echo '<li id="pag1" class="active" data-offset="0"><a href="#">1</a></li>';
									$k = 1;
									while($k < $pages):
										echo '<li id="pag'. ($k+1) .'" data-offset="'. $k*$pageSpan .'"><a href="#">'. ($k+1) .'</a></li>';
										$k++;
									endwhile;
								?>
								<li class="<? if($pages==1) echo 'disabled'; ?> ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
<?
	endif;
?>
	<div class="modal fade sendmessage userDetails" id="userDetails" tabindex="-1" role="dialog" aria-labelledby="User Details" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Dettagli Utente</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<p class="detName"><strong>Nome:</strong> <span></span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="detEmail"><strong>eMail:</strong> <span></span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="detAddr"><strong>Indirizzo:</strong> <span></span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="detBirth"><strong>Data di Nascita:</strong> <span></span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="detCf"><strong>Codice Fiscale:</strong> <span></span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="detPhone"><strong>Telefono:</strong> <span></span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="detWork"><strong>Lavoro:</strong> <span></span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="detJoin"><strong>Utente dal:</strong> <span></span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="detLast"><strong>Ultimo accesso:</strong> <span></span></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12 detScreen">

								</div>
							</div>
							<div class="row">
								<div class="col-md-12 detCont">
								</div>
							</div>
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
	<script src="<? echo base_url('assets/js/jlinq.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/userlist.js'); ?>"></script>

</body>
</html>
