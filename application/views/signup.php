<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head.php';
	echo '</head>';

	include_once 'header.php';

	//Iscrizioni aperte/chiuse [true/false]
	$open = $isOpen;
?>
<div class="submenu">
  <nav class="navbar navbar-default">
	  <div class="container container-menu">
      <div class="collapse navbar-collapse" id="subNavItems">
        <ul class="nav navbar-nav navbar-left text-center"></ul>
        <ul class="nav navbar-nav navbar-right text-center"></ul>
      </div>
	  </div>
  </nav>
</div>

<div class="container-fluid signup">
	<div class="row">
		<div class="col-md-12 text-center">
			<h2 class="text-uppercase text-primary">Registrazione utenti</h2>
			<? if($open): ?>
				<p class="lead">Compila il form sottostante per registrarti a Click Day 2017</p>
			<? else: ?>
				<p class="lead">Ci dispiace, ma le iscrizioni per questa edizione sono terminate.</p>
			<? endif; ?>
		</div>
	</div>
<? if($open): ?>
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 jumbotron">
			<div class="row confirm hidden">
				<div class="col-md-12 text-center">
					<div class="form-group">
						<p class="lead">Grazie per esserti registrato, abbiamo inviato le istruzioni per attivare il tuo account al tuo indirizzo email.</p>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" data-toggle="modal" data-target=".login">Accedi</button>
					</div>
				</div>
			</div>
			<form class="signupForm">
				<div class="row">
					<div class="col-lg-5 col-lg-offset-1 col-md-6">
						<div class="form-group col-lg-9 col-md-12">
							<label>Nome</label>
							<input type="text" class="form-control" name="name" autocomplete="off" tabindex="1" title="Inserisci il tuo nome" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{1,20}$" required />
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>Cognome</label>
							<input type="text" class="form-control" name="surname" autocomplete="off" tabindex="2" title="Inserisci il tuo cognome" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{1,20}$" required />
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<div class="col-md-12 bday-day">
								<label>Data di nascita</label>
							</div>
							<div class="col-xs-4 bday-day">
								<input type="number" class="form-control" name="bday-day" autocomplete="off" tabindex="3" title="Inserisci la tuo giorno di nascita" pattern="[1-9]{1,2}" min="1" max="31" step="1" required />
							</div>
							<div class="col-xs-4 bday-month">
								<input type="number" class="form-control" name="bday-month" autocomplete="off" min="1" max="12" step="1" tabindex="4" title="Inserisci la tuo mese di nascita" pattern="[1-9]{1,2}" required />
							</div>
							<div class="col-xs-4 bday-year">
								<input type="number" class="form-control" name="bday-year" autocomplete="off" min="1930" max="2001" step="1" tabindex="5" title="Inserisci il tuo anno di nascita"  pattern="[1-9]{4,4}" required />
							</div>
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>Nazione</label>
							<input type="text" class="form-control" name="country" autocomplete="off" tabindex="6" title="Inserisci la tua Nazione" required />
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>Indirizzo</label>
							<input type="text" class="form-control" name="address" autocomplete="off" tabindex="7" title="Inserisci il tuo indirizzo" required />
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<div class="col-xs-4 bday-day">
								<label>Civico</label>
								<input type="text" class="form-control" name="door" autocomplete="off" tabindex="8" />
							</div>
							<div class="col-xs-4 bday-month">
								<label>Provincia</label>
								<input type="text" class="form-control" maxlength="2" name="prov" autocomplete="off" tabindex="9" title="Inserisci la tua provincia" required />
							</div>
							<div class="col-xs-4 bday-year">
								<label>CAP</label>
								<input type="text" class="form-control" name="cap" autocomplete="off" tabindex="10" maxlength="5" title="Inserisci il tuo Codice di avviamento postale" required />
							</div>
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>Codice Fiscale</label>
							<input type="text" class="form-control" name="cf" autocomplete="off" tabindex="11" maxlength="16" title="Inserisci il tuo codice fiscale" required />
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>Password</label>
							<input type="password" class="form-control" name="password" autocomplete="off" tabindex="12" title="Inserisci una password" required />
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>Conferma Password</label>
							<input type="password" class="form-control" name="password" autocomplete="off" tabindex="13" title="Conferma la password" required />
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-1 col-md-6">
						<div class="form-group col-lg-9 col-md-12">
							<label>Email</label>
							<input type="email" class="form-control" name="email" autocomplete="off" tabindex="14" title="Inserisci il tuo indirizzo email" required />
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>Conferma Email</label>
							<input type="email" class="form-control" name="email" autocomplete="off" tabindex="15" title="Conferma il tuo indirizzo" required />
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>N. Telefono</label>
							<input type="tel" class="form-control" name="phone" autocomplete="off" tabindex="16" maxlength="11" title="Inserisci il tuo numero di telefono" required />
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>Professione</label>
							<input type="text" class="form-control" name="work" autocomplete="off" tabindex="17" title="Inserisci la tua professione" required />
						</div>
						<div class="form-group col-lg-9 col-md-12 <? if(isset($code)): echo 'hidden'; endif; ?>">
							<p>Inserisci il codice del tuo ClickMaster se ne hai uno, altrimenti spunta la casella per proseguire!</p>
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<label>Codice ClickMaster*</label>
							<input type="text" class="form-control" name="code" value="<? echo $code; ?>" autocomplete="off" tabindex="18" />
						</div>
						<div class="form-group col-lg-9 col-md-12 <? if(isset($code)): echo 'hidden'; endif; ?>">
							<div class="checkbox checkbox-circle checkbox-orange">
								<input id="not" name="notCode" type="checkbox" class="cm" tabindex="19" <? if(isset($code)): echo 'disabled'; else: echo 'checked'; endif; ?>/>
								<label for="not">Non sono in possesso di un codice Click Master</label>
							</div>
						</div>
						<div class="form-group col-lg-9 col-md-12">
							<div class="checkbox checkbox-circle checkbox-orange">
								<input id="check" type="checkbox" class="accept" tabindex="20" title="Accetta per continuare" required />
								<label for="check">Acconsento al <a target="_blank" href="<? echo base_url('Privacy_Policy_CLICKDAYATS_2017.pdf'); ?>">trattamento dei dati personali</a></label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<p class="feedback text-danger"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<button class="btn btn-primary btn-block text-uppercase btn-lg signup">Registrati</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?
	endif;
	include_once 'footer2.php';
?>
</div>

<script src="<? echo base_url('assets/js/form-utils.js'); ?>"></script>
<script src="<? echo base_url('assets/js/signup.js'); ?>"></script>

</body>
</html>
