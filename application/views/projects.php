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
		echo '<li><a href="'. base_url('dashboard/userlist') .'">Liste Utenti</a></li>';
		echo '<li><a href="'. base_url('dashboard/screens') .'">Screenshots</a></li>';
		echo '<li class="active"><a href="' . base_url('dashboard/projects') . '">Elenco Progetti</a></li>';
	endif;
	echo '<li><a href="#"  data-toggle="modal" data-target=".winners">Lista Cliccatori vincenti</a></li>';
	echo '<li><a href="' . base_url('login/signout/') . '">Logout</a></li>
			</ul>
			</div>';
?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
			    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</div>
<?
	include_once 'footer_dash.php';
	echo '</div>';
?>

<script src="<? echo base_url('assets/js/projectsList.js'); ?>"></script>

</body>
</html>
