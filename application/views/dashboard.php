<script type="text/javascript">
	window.role = "<?php echo $this->data['role'] = $this->session->userdata('role'); ?>";
	window.name = "<?php if($this->data['role'] == 'admin') echo 'Admin '; if($this->data['role'] == 'clickMaster') echo 'CM '; echo  $this->session->userdata('name'); ?>";
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

	echo "<script>window.navActive = 'dash';</script>";
	include_once 'navbar_dash.php';
	
	echo "<script>window.mails = " . $mails . ";</script>";
	echo "<script>window.pageSpan = " . $pageSpan . ";</script>";
	echo "<script>window.maxOffset = " . $maxOffset . ";</script>";
	echo "<script>window.pages = " . $pages . ";</script>";
	echo "<script>window.nots = " . $nots . ";</script>";

	include_once 'message_modals.php';
?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default messageWidget">
					<div class="panel-heading">Messaggi</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3 left-section text-center">
								<a href="#" data-toggle="modal" data-target=".sendmessage"><button type="button" class="btn btn-primary">Nuovo Messaggio</button></a>
							</div>
							<div class="col-md-9 text-center right-section">
								<a href=<? echo '"'. base_url('dashboard').'"'; ?>><button type="button" class="btn btn-primary">Aggiorna</button></a>
							</div>
						</div>
						<div class="row intbox">
							<div class="col-md-3 left-section">
								<ul class="list-group dir">
									<li class="list-group-item no-border active" id="received"><span class="glyphicon glyphicon-inbox"></span> Ricevuti<span id="cnots" class="badge"><? if($cnots > 0) echo $cnots; ?></span></li>
									<li class="list-group-item no-border" id="sent"><span class="glyphicon glyphicon-envelope"></span> Inviati</li>
								</ul>
								<? if($role == 'admin'): ?>
								<ul class="divider list-unstyled">
									<li>Conversazioni CM</li>
								</ul>
								<ul class="list-group cmslist">
									<? foreach($cmlist as $cm): ?>
									<li class="list-group-item no-border cm-line" data-id="<? echo $cm->ID; ?>"><? echo 'CM '.$cm->name.' '.$cm->surname; ?></li>
									<? endforeach; ?>
								</ul>
								<? endif; ?>
							</div>
							<div class="col-md-9 message-list table-responsive">
								<table class="table table-hover table-striped">
									<thead><tr><th>Mittente</th><th>Oggetto</th><th>Data</th></tr></thead>
									<tbody>
									<?php
									if(count($rawMails)==0):
										echo '<tr class="mail-line text-center noMessages"><td>Nessun messaggio ricevuto</td></tr>';
									else:
										$k = 0;
										while(($k < $pageSpan)&&($k <count($rawMails))) :
										?>
											<tr class="mail-line" data-id="<? echo $rawMails[$k]['ID']; ?>" data-pos="<? echo $rawMails[$k]['pos']; ?>">
												<td><? echo $rawMails[$k]['mitt']; ?></td>
												<td><? echo $rawMails[$k]['title']; ?></td>
												<td class="message-time"><? echo $rawMails[$k]['time']; ?></td>
											</tr>
										<?php $k++; endwhile; endif;?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="panel-footer text-center">
						<nav>
							<ul class="pagination" id="mailPages">
								<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
								<?
									echo '<li id="pag1" class="active" data-offset="0"><a href="#">1</a></li>';
									$k = 1;
									while($k < $pages):
										echo '<li id="pag'. ($k+1) .'" data-offset="'. $k*$pageSpan .'"><a href="#">'. ($k+1) .'</a></li>';
										$k++;
									endwhile;
								?>
								<li class="<? if($pages==0) echo 'disabled'; ?> ext next"><a data-toggle="tooltip" data-trigger="manual" data-html="true" data-placement="bottom" title='<span class="glyphicon glyphicon-ok"></span>' href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>

	<? if($role == 'user'): ?>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default uploadWidget">
					<div class="panel-heading">Screenshot</div>
					<div class="panel-body">
						<? if($screen_uploaded==0): ?>
							<div class="form-group uploadbtn2">
								<span class="btn btn-default btn-file uploadbtn">
									<span>Carica screenshot</span>
									<input type="file" name="userfile" id="userfile" size="20" />
								</span>
							</div>
						<? elseif($screen_uploaded==1): ?>
							<div class="form-group uploadbtn2">
								<span class="btn btn-default btn-file uploadbtn">
									<span>Cambia screenshot</span>
									<input type="file" name="userfile" id="userfile" size="20" />
								</span></br></br>
								<img src="<? echo base_url('assets/uploads/screenshots'). "/" . $screenshot; ?>">
							</div>
						<? elseif($screen_uploaded==-1): ?>
							<div class="form-group uploadbtn2">
								ATTENZIONE: il tuo screenshot non è stato approvato, prova a caricarne uno nuovo e attendi una nuova approvazione.
								<span class="btn btn-default btn-file uploadbtn">
									<span>Cambia screenshot</span>
									<input type="file" name="userfile" id="userfile" size="20" />
								</span></br></br>
								<img src="<? echo base_url('assets/uploads/screenshots'). "/" . $screenshot; ?>">
							</div>
						<? elseif($screen_uploaded==2): ?>
							<div class="form-group uploadbtn2">
								Complimenti, il tuo screen è stato approvato.
								<br></br>
								<img src="<? echo base_url('assets/uploads/screenshots'). "/" . $screenshot; ?>">
							</div>
						<? endif ?>
					<div class="errorBox"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
		    <div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Scarica contratto</div>
					<div class="panel-body">
						<div class="form-group">
							<button data-userID="<? echo $ID; ?>" class="btn btn-default downloadC">Download</button>
						</div>
					</div>
				</div>
		    </div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Carica contratto firmato</div>
					<div class="panel-body">
							<? if($contract_uploaded==0): ?>
								<div class="form-group uploadbtn3">
									<span class="btn btn-default btn-file uploadbtn4">
										<span>Carica Contratto</span>
										<input type="file" name="userfile2" id="userfile2" size="20"/>
									</span>
								</div>
							<? elseif($contract_uploaded==1): ?>
								<div class="form-group uploadbtn3">
									<span class="glyphicon glyphicon-ok green"></span> Contratto caricato.
									<br>Clicca sul pulsante per caricare nuovamente il contratto.
									<br><br>
									<span class="btn btn-default btn-file uploadbtn4">
										<span>Ricarica Contratto</span>
										<input type="file" name="userfile2" id="userfile2" size="20"/>
									</span>
								</div>
							<? endif; ?>
						<div class="errorBox2"></div>
					</div>
				</div>
			</div>
		</div>

<?
	//Click Master section
	elseif($role=='clickMaster'):
?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default recentWidget">
					<div class="panel-heading">Attività recenti</div>
					<div class="panel-body table-responsive">
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
									while($k <count($rawUsers)) :
										echo '<tr class="user-line" data-ID="'. $rawUsers[$k]['ID'] .'"><td><div class="status-circle status'. $rawUsers[$k]['status'] .'"></div></td><td><b>'. $rawUsers[$k]['name'] .'</b></td><td>'. $rawUsers[$k]['join'] .'</td><td>'. $rawUsers[$k]['clickM'] .'</td><td>'. $rawUsers[$k]['approved'] .'</td><td>'. $rawUsers[$k]['code'] .'</td><td>'. $rawUsers[$k]['screen'] .'</td></tr>';
										$k++;
									endwhile;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
<?
	//Admin section
	else:
?>
<?
	endif;
?>
	</div>
<?
	include_once 'footer_dash.php';
	echo '</div>';
?>

	<script src="<? echo base_url('assets/js/ajaxfileupload.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/dashboard.js'); ?>"></script>
</body>
</html>
