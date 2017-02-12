<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head.php';
	echo '</head>';

	include_once 'header.php';

	//Iscrizioni aperte/chiuse [true/false]
	$open = false;
?>
<div class="submenu">
    <nav class="navbar navbar-default">
        <div class="container container-menu">
            <div class="collapse navbar-collapse" id="subNavItems">
                <ul class="nav navbar-nav navbar-left text-center">

                </ul>
                <ul class="nav navbar-nav navbar-right text-center">

                </ul>
            </div>
        </div>
    </nav>
</div>
	<div class="container-fluid signup">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2 class="text-uppercase text-primary">Registrazione utenti</h2>
				<? if($open): ?>
				<p class="lead">Compila il form sottostante per registrarti a Click Day 2016</p>
				<? else: ?>
				<p class="lead">Ci dispiace, ma le iscrizioni per questa edizione sono terminate.</p>
				<? endif; ?>
			</div>
		</div>
		<? if($open): ?>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 col-md-offset-3 jumbotron">
					<div class="row hidden">
						<div class="col-md-12 text-center">
							<div class="form-group">
								<p class="lead">Grazie per esserti registrato, abbiamo inviato le istruzioni per attivare il tuo account al tuo indirizzo eMail.</p>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" data-toggle="modal" data-target=".login">Accedi</button>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>Nome*</label>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="text" class="form-control" name="name" autocomplete="off" tabindex="1">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>eMail*</label>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="email" class="form-control" name="emailS" autocomplete="off" tabindex="14">
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
									<input type="text" class="form-control" name="surname" autocomplete="off" tabindex="2">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>Conferma eMail*</label>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="email" class="form-control" name="emailS2" autocomplete="off" tabindex="15">
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
								<div class="birthDate">
									<div class="form-group" style="display: inline-block; width: 26%;">
										<input type="text" class="form-control" maxlength="2" name="dateBirth1" autocomplete="off" tabindex="3">
									</div>
									<div class="form-group" style="display: inline-block; width: 26%;">
										<input type="text" class="form-control" maxlength="2" name="dateBirth2" autocomplete="off" tabindex="4">
									</div>
									<div class="form-group fix1" style="display: inline-block;">
										<input type="text" class="form-control" maxlength="4" name="dateBirth3" autocomplete="off" tabindex="5">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>N. telefono*</label>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="tel" class="form-control" name="phone" autocomplete="off" tabindex="16">
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
									<input type="text" class="form-control" name="country" autocomplete="off" tabindex="6"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>Professione*</label>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="text" class="form-control" name="work" autocomplete="off" tabindex="17">
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
									<input type="text" class="form-control" name="address" autocomplete="off" tabindex="7"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>N. civico*</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" name="door" autocomplete="off" tabindex="8"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-12">
								<p>Inserisci il codice del tuo Click Master.<br>Se non ne hai uno, spunta la casella per proseguire!</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>CAP*</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" name="cap" autocomplete="off" tabindex="9"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>Provincia*</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" maxlength="2" name="prov" autocomplete="off" tabindex="10"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>Codice ClickMaster*</label>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="text" class="form-control" name="code" value="<? echo $code; ?>" autocomplete="off" tabindex="18" <? if(isset($code)): echo 'disabled'; endif; ?>>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>Codice Fiscale*</label>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="text" class="form-control" name="cf" autocomplete="off" tabindex="11"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-12">
								<div class="checkbox checkbox-circle checkbox-orange">
									<input id="not" type="checkbox" class="cm" tabindex="19" <? if(isset($code)): echo 'disabled'; endif; ?>/>
									<label for="not">Non sono in possesso di un codice Click Master</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>Imposta Password*</label>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="password" class="form-control" name="passwordS" autocomplete="off" tabindex="12">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-5 text-left">
								<label>Conferma Password*</label>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="password" class="form-control" name="passwordS2" autocomplete="off" tabindex="13">
								</div>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<div class="col-md-12">
								<p class="text-danger hidden">Attenzione! Il form non è stato compilato correttamente.<br>Correggere i campi contrassegnati per proseguire.</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-right">
							<div class="col-md-12">
								<div class="checkbox checkbox-circle checkbox-orange">
									<input id="check" type="checkbox" class="accept" tabindex="20" />
									<label for="check">Acconsento al <a target="_blank" href="<? echo base_url('assets/Privacy_Policy_CLICKDAYATS_2016.pdf'); ?>">trattamento dei dati personali</a></label>
								</div>
							</div>
						</div>
						<div class="col-md-5 col-md-offset-1">
							<button class="btn btn-primary btn-block text-uppercase btn-lg signup">Registrati</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<? else: ?>
		<div class="row" style="min-height: 300px;"></div>
		<? endif; ?>
		<?
			include_once 'footer2.php';
		?>
	</div>
	<script src="<? echo base_url('assets/js/signup.js'); ?>"></script>

</body>
</html>
