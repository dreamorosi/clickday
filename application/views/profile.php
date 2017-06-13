<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head_dash.php';
	echo '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/dashboard.css') . '"/>';
	echo '</head>';

	include_once 'header_dash.php';

	echo "<script>window.navActive = 'profile';</script>";
	include_once 'navbar_dash.php';
?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default profile">
					<div class="panel-heading">Modifica Dati Utente</div>
					<div class="panel-body">
						<form class="editForm">
							<div class="row">
								<div class="col-lg-5 col-lg-offset-1 col-md-6">
									<input type="hidden" name="ID" value="<? echo $user->ID; ?>" />
									<div class="form-group col-lg-9 col-md-12">
										<label>Nome</label>
										<input type="text" class="form-control" name="name" autocomplete="off" tabindex="1" title="Inserisci il tuo nome" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" value="<? echo $user->name ?>" required />
									</div>
									<div class="form-group col-lg-9 col-md-12">
										<label>Cognome</label>
										<input type="text" class="form-control" name="surname" autocomplete="off" tabindex="2" title="Inserisci il tuo cognome" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" value="<? echo $user->surname ?>" required />
									</div>
									<div class="form-group col-lg-9 col-md-12 bday">
										<div class="col-md-12 bday-day" data-birthDate="<? echo $user->dateBirth ?>">
											<label>Data di nascita</label>
										</div>
										<div class="col-xs-4 bday-day">
											<input type="number" class="form-control" name="bday-day" autocomplete="off" tabindex="3" title="Inserisci la tuo giorno di nascita" pattern="[1-9]{1,2}" min="1" max="31" step="1" required />
										</div>
										<div class="col-xs-4 bday-month">
											<input type="number" class="form-control" name="bday-month" autocomplete="off" min="1" max="12" step="1" tabindex="4" title="Inserisci la tuo mese di nascita" pattern="[1-9]{1,2}" required />
										</div>
										<div class="col-xs-4 bday-year">
											<input type="number" class="form-control" name="bday-year" autocomplete="off" min="1930" max="2000" step="1" tabindex="5" title="Inserisci il tuo anno di nascita" pattern="[1-9]{4,4}" required />
										</div>
									</div>
									<div class="form-group col-lg-9 col-md-12">
										<label>Nazione</label>
										<input type="text" class="form-control" name="country" autocomplete="off" tabindex="6" title="Inserisci la tua Nazione" value="<? echo $user->country ?>" required />
									</div>
									<div class="form-group col-lg-9 col-md-12">
										<label>Indirizzo</label>
										<input type="text" class="form-control" name="address" autocomplete="off" tabindex="7" title="Inserisci il tuo indirizzo" value="<? echo $user->address ?>" required />
									</div>
									<div class="form-group col-lg-9 col-md-12">
										<div class="col-xs-6 bday-month">
											<label>Provincia</label>
											<input type="text" class="form-control" maxlength="2" name="prov" autocomplete="off" tabindex="9" title="Inserisci la tua provincia" value="<? echo $user->prov ?>" required />
										</div>
										<div class="col-xs-6 bday-year">
											<label>CAP</label>
											<input type="text" class="form-control" name="cap" autocomplete="off" tabindex="10" maxlength="5" title="Inserisci il tuo Codice di avviamento postale" value="<? echo $user->cap ?>" required />
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-lg-offset-1 col-md-6">
									<div class="form-group col-lg-9 col-md-12">
										<label>Email</label>
										<input type="email" class="form-control" name="email" autocomplete="off" tabindex="11" title="Inserisci una password" value="<? echo $user->email ?>" required />
									</div>
									<div class="form-group col-lg-9 col-md-12">
										<label>N. Telefono</label>
										<input type="tel" class="form-control" name="phone" autocomplete="off" tabindex="12" maxlength="11" title="Inserisci il tuo numero di telefono" value="<? echo $user->phone ?>" required />
									</div>
									<div class="form-group col-lg-9 col-md-12">
										<label>Professione</label>
										<input type="text" class="form-control" name="work" autocomplete="off" tabindex="13" title="Inserisci la tua professione" value="<? echo $user->work ?>" required />
									</div>
									<div class="form-group col-lg-9 col-md-12">
										<label>Codice Fiscale</label>
										<input type="text" class="form-control" name="cf" autocomplete="off" tabindex="14" maxlength="16" title="Inserisci il tuo codice fiscale" value="<? echo $user->cf ?>" required />
									</div>
									<div class="form-group col-lg-9 col-md-12">
										<button class="btn btn-primary btn-block text-uppercase btn-lg">Salva</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<? if($settings[1]['active'] === '1'): ?>
					<div class="panel-heading">INVITA UN AMICO</div>
					<div class="panel-body">
						<div class="form-group col-md-6">
							<p>INVITA UN AMICO!</p>
							<div class="input-group">
								<input type="text" class="form-control referralCode" placeholder="Referral Url" value="<? echo base_url('signup/' . $referral); ?>">
								<span class="input-group-btn">
									<button class="btn btn-default referralBtn" type="button" data-clipboard-target=".referralCode">
										Copia
										<i class="glyphicon glyphicon-copy"></i>
									</button>
								</span>
							</div>
						</div>
						<div class="form-group col-md-6">
							<p>Utenti raccomandati con successo</p>
							<p class="lead"><? echo $referredUsers; ?></p>
						</div>
					</div>
					<? endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
	<script src="<? echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/jquery.noty.packaged.min.js') ?>"></script>
	<script src="<? echo base_url('assets/js/clipboard.min.js') ?>"></script>
	<script src="<? echo base_url('assets/js/notifications.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/form-utils.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/profile.js'); ?>"></script>

</body>
</html>
