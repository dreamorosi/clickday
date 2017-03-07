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

  echo "<script>window.projects_classic = " . json_encode($projects_classic) . ";</script>";
	echo "<script>window.projects_sc = " . json_encode($projects_sc) . ";</script>";
?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
        <div class="panel panel-default projectsWidget">
					<div class="panel-heading">
            <span>Lista Progetti</span>
          </div>
					<div class="panel-body table-responsive">
            <input type="text" class="form-control" placeholder="Cerca" tabindex="1" id="search" autocomplete="off" />
						<button class="btn btn-default resetQuery hidden">&times; Resetta ricerca</button>
            <table class="table table-striped">
							<thead>
								<tr>
									<th class='leftCol'>
                    <span class='projectHandle active' data-project='1'>Progetti</span>
                     |
                    <span class='projectHandle' data-project='0'>Progetti Click</span>
                  </th>
									<th class='rightCol'>Info</th>
								</tr>
							</thead>
							<tbody>
                <tr>
                  <td class='leftCol'>
                    <ul>
                      <li>Caricando progetti</li>
                    </ul>
                  </td>
                  <td class='rightCol projectInfo'>
                    <p class="text-center blankInfo">Seleziona un progetto per visualizzare le informazioni.</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
			</div>
		</div>
<?
	include_once 'footer_dash.php';
	echo '</div>';
?>

<script src="<? echo base_url('assets/js/projectsList.js'); ?>"></script>

</body>
</html>
