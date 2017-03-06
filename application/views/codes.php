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
		echo '<li><a href="'. base_url('dashboard/userlist') .'">Liste Utenti</a></li>
	  <li><a href="'. base_url('dashboard/screens') .'">Screenshots</a></li>';
		echo '<li><a href="' . base_url('dashboard/projects') . '">Elenco Progetti</a></li>';
		if($role == 'clickMaster') echo '<li class="active"><a href="'.base_url('dashboard/codes').'">Assegna Codici</a></li>';
	endif;
	echo '<li><a href="' . base_url('login/signout/') . '">Logout</a></li>
			</ul>
			</div>';

	if($role=='clickMaster'):
?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default codesWidget">
					<div class="panel-heading text-right"><span class="pull-left">Assegna Codici</span> <button class="btn btn-sm btn-default addRow"><span class="print glyphicon glyphicon-plus"></span> Aggiungi codice</button></div>
					<div class="panel-body">
						<? foreach($codes as $code): ?>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<input class="form-control" value="<? echo $code[0]; ?>" placeholder="Codice" />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<input class="form-control perc" value="<? echo $code[1]; ?>" placeholder="% Utenti" />
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group text-right">
									<button data-action="delete" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
								</div>
							</div>
						</div>
						<? endforeach; ?>
					</div>
					<div class="panel-footer text-center">
						<button data-loading-text="Caricamento" class="btn btn-default save">Conferma</button>
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
	include_once 'footer_dash.php';
	echo '</div>';
?>
	<script src="<? echo base_url('assets/js/codes.js'); ?>"></script>

</body>
</html>
