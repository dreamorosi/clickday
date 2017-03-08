<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head_dash.php';
	echo '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/dashboard.css') . '"/>';
	echo '</head>';

	if($role=='admin'):
		$name = 'Admin '. $name;
	endif;

	include_once 'header_dash.php';

	echo "<script>window.navActive = 'profile';</script>";
	include_once 'navbar_dash.php';

	if($role=='clickMaster'):
?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Click Master</div>
					<div class="panel-body">

					</div>
				</div>
			</div>
		</div>
	</div>
<?
	elseif($role=='user'):
?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Dati Utente</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>Nome*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="text" class="form-control" value="<? echo $name; ?>" name="name" autocomplete="off" tabindex="1">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>eMail*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="email" class="form-control" value="<? echo $email; ?>" name="emailS" autocomplete="off" tabindex="14">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>Cognome*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="text" class="form-control" value="<? echo $surname; ?>" name="surname" autocomplete="off" tabindex="2">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>N. telefono*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="tel" class="form-control" value="<? echo $user->phone; ?>" name="phone" autocomplete="off" tabindex="16">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>Data di nascita*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="text" class="form-control" value="<? echo $user->dateBirth; ?>" name="dateBirth" autocomplete="off" tabindex="2">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>Codice Fiscale*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="text" class="form-control" value="<? echo $user->cf; ?>" name="cf" autocomplete="off" tabindex="11"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>Nazione*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="text" class="form-control"  value="<? echo $user->country; ?>"name="country" autocomplete="off" tabindex="6"/>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>Professione*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="text" class="form-control" value="<? echo $user->work; ?>" name="work" autocomplete="off" tabindex="17">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>Indirizzo*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="text" class="form-control"  value="<? echo $user->address; ?>"name="address" autocomplete="off" tabindex="7"/>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>CAP*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="text" class="form-control"  value="<? echo $user->cap; ?>"name="cap" autocomplete="off" tabindex="9"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="col-md-5 text-left">
									<label>Provincia*</label>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="text" class="form-control"  value="<? echo $user->prov; ?>"name="prov" autocomplete="off" tabindex="7"/>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-6">
									<p class="text-danger hidden">Attenzione! Il form non è stato compilato correttamente.</br>Correggere i campi contrassegnati per proseguire.</p>
								</div>
								<div class="col-md-6">
									<button class="btn btn-primary btn-block text-uppercase btn-lg signup">Modifica</button>
								</div>
							</div>
						</div>
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
					<div class="panel-heading text-right"><span class="pull-left">Lista utenti</span> <a href="<? echo base_url('dashboard/test'); ?>" target="_blank" class="btn btn-sm btn-default"><span class="print glyphicon glyphicon-print"></span> Stampa</a</div>
					<div class="panel-body">
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
								</tr>
							</thead>
							<tbody>
								<?
									$k = 0;
									while(($k < $pageSpan)&&($k <count($rawUsers))) :
										echo '<tr class="user-line" data-ID="'. $rawUsers[$k]['ID'] .'"><td><div class="status-circle status'. $rawUsers[$k]['status'] .'"></div></td><td><b>'. $rawUsers[$k]['name'] .'</b></td><td>'. $rawUsers[$k]['join'] .'</td><td>'. $rawUsers[$k]['clickM'] .'</td><td>'. $rawUsers[$k]['approved'] .'</td><td>'. $rawUsers[$k]['code'] .'</td><td>'. $rawUsers[$k]['screen'] .'</td>';
										$k++;
									endwhile;
								?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer text-center">
						<nav>
							<ul class="pagination">
								<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
								<?
									echo '<li class="active" data-offset="0"><a href="#">1</a></li>';
									$k = 1;
									while($k < $pages):
										echo '<li data-offset="'. $k*$pageSpan .'"><a href="#">'. ($k+1) .'</a></li>';
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
	include_once 'footer_dash.php';
	echo '</div>';
?>

	<script src="<? echo base_url('assets/js/profile.js'); ?>"></script>

</body>
</html>
