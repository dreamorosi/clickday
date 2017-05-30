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

	echo "<script>window.navActive = 'settings';</script>";
	include_once 'navbar_dash.php';
?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default codesWidget">
					<div class="panel-heading">
						<span>Impostazioni Piattaforma</span>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<p>Spunta una funzione per renderla attiva e disponibile per gli utenti.</p>
								<form>
									<div class="form-group">
										<label>
											<input type="checkbox" name="screenshots" <? if($settings[0]['active'] === '1') echo 'checked'; ?>> Screenshots
										</label>
									</div>
									<div class="form-group">
										<label>
											<input type="checkbox" name="subclickmaster" <? if($settings[1]['active'] === '1') echo 'checked'; ?>> Subclickmaster
										</label>
									</div>
									<br />
									<button type="submit" class="btn btn-sm btn-default">
										<span>Salva</span>
										<i class="glyphicon glyphicon-refresh hidden"></i>
									</button>
								</form>
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
	<script src="<? echo base_url('assets/js/jquery.noty.packaged.min.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/form-utils.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/admin_settings.js'); ?>"></script>
</body>
</html>
