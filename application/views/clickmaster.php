<script type="text/javascript">
	window.role = "<?php echo $this->data['role'] = $this->session->userdata('role'); ?>";
	window.ID = "<?php echo $this->data['role'] = $this->session->userdata('ID'); ?>";
</script>
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head_dash.php';
	echo '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/dashboard.css') . '"/>';
	echo '</head>';

	include_once 'header_dash.php';

	echo "<script>window.navActive = 'managecm';</script>";
	include_once 'navbar_dash.php';

  echo "<script>window.users = " . json_encode($users) . ";</script>";
?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
      <div class="col-md-4">
        <div class="well">
          <p class='lead text-center'>Totale Cliccatori</p>
          <h2 id='totUsers' class='text-center'>0</h2>
        </div>
      </div>
      <div class="col-md-4">
        <div class="well">
          <p class='lead text-center'>Cliccatori con progetto</p>
          <h2 id='totProj' class='text-center'>0</h2>
        </div>
      </div>
      <div class="col-md-4">
        <div class="well">
          <p class='lead text-center'>Cliccatori senza progetto</p>
          <h2 id='totNoProj' class='text-center'>0</h2>
        </div>
      </div>
    </div>
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-default" href="javascript:window.history.go(-1);">Torna indietro</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
        <div class="panel panel-default detailsClickWidget">
					<div class="panel-heading">
            <span>Lista Cliccatori associati</span>
          </div>
					<div class="panel-body table-responsive">
            <table class="table table-striped">
              <thead>
								<tr>
									<th></th>
									<th>Nome Completo</th>
									<th>Data registrazione</th>
									<th>Codice assegnato</th>
									<th>Codice ricevuto</th>
									<th>Screenshot</th>
									<th>Ultimo accesso</th>
								</tr>
							</thead>
							<tbody>
								<tr><td colspan='7'><p class="emptyDetails text-center">Sembra che questo ClickMaster non abbia ancora nessun utente associato.</p></td></tr>
							</tbody>
            </table>
          </div>
          <div class="panel-footer text-center">
						<nav>
							<ul class="pagination"></ul>
						</nav>
						<span class="pull-right">
							<small>Utenti per pagina</small>
							<select class="pageSpan">
								<option val="5" selected>5</option>
								<option val="10">10</option>
								<option val="20">20</option>
							</select>
						</span>
					</div>
        </div>
			</div>
		</div>
  </div>
</div>
<script src="<? echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
<script src="<? echo base_url('assets/js/jquery.animateNumber.min.js'); ?>"></script>
<script src="<? echo base_url('assets/js/pagination.js'); ?>"></script>
<script src="<? echo base_url('assets/js/clickmaster.js'); ?>"></script>

</body>
</html>
