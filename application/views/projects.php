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

	echo "<script>window.navActive = 'projects';</script>";
	include_once 'navbar_dash.php';

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
