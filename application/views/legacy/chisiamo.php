<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head.php';
	echo '</head>';

	include_once 'header.php';
?>
	<div class="submenu">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="subNavItems">
					<ul class="nav navbar-nav navbar-left text-uppercase text-center">
						<li><a href="#chiSiamo">Chi Siamo</a></li>
						<li><a href="#successi">I nostri successi</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="https://www.facebook.com/clickday" target="_blank"><img src="<? echo base_url('assets/img/fb.png'); ?>"></a></li>
						<li class="text-contact"><a href="mailto:info@clickdayats.it" ><span class="glyphicon glyphicon-envelope"></span> info@clickdayats.it</a><a href="#" ><span class="glyphicon glyphicon-phone-alt"></span> 0522/701079</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<div class="main">
		<div class="container-fluid">
			<div class="row t1-section chiSiamo">
				<div class="container">
					<div class="col-md-6">
						<h2 id="chiSiamo">CHI SIAMO</h2>
						<p><b>ATS - CONSULENTI ASSOCIATI S.r.l.</b> è una società di consulenza fondata nel 1995
						con sede a Reggio Emilia.<br>
						Lo Studio si occupa principalmente di <b>Consulenze e Formazione</b> in ambito di Sicurezza
						sul Lavoro ed Ambiente, <b>Certificazioni di Qualità, Finanza Agevolata e Pianificazione Territoriale</b>.<br>
						Per il BANDO INAIL ci occupiamo, oltre che dell'invio delle domande il giorno del Click
						Day, di <b>tutte le pratiche tecniche ed amministrative</b> necessarie alla presentazione dei
						progetti all'INAIL per l'ottenimento dei contributi.<br>
						Dato il numero elevato di domande da inviare all’INAIL il giorno del Click Day, ATS - CONSULENTI ASSOCIATI S.r.l. - oltre ad impiegare i propri dipendenti e collaboratori diretti sul progetto - seleziona ogni anno dei cliccatori esterni per fronteggiare al meglio il numero elevato di pratiche presentate.</p>
						<div class="btn-cont">
							<a href="http://www.atseco.it/" target="_blank"><button type="button" class="btn btn-primary">VISITA PAGINA</button></a>
						</div>
					</div>
					<div class="col-md-6">
						<img class="img-responsive scale" src="<? echo base_url('assets/img/atslog.png'); ?>" alt="atslogo" />
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row t3-section">
				<div class="container">
					<div id="successi" class="row">
						<div class="col-md-3">
							<h3 class="number1 scale">500</h3>
							<hr>
							<h4>CLICCATORI</h4>
						</div>
						<div class="col-md-3">
							<h3 class="number2 scale">38%</h3>
							<hr>
							<h4>DI PROGETTI AMMESSI A CONTRIBUTO</h4>
						</div>
						<div class="col-md-3">
							<h3 class="number3 scale">3.4</h3>
							<hr>
							<h4>MILIONI DI EURO DI CONTRIBUTI STANZIATI</h4>
						</div>
						<div class="col-md-3">
							<h3 class="number4 scale">3.2</h3>
							<hr>
							<h4>CLICK PIÙ VELOCE</h4>(IN SECONDI)
						</div>
					</div>
				</div>
			</div>
		</div>

		<?
			include_once 'footer.php';
		?>
	</div>
<script src="<? echo base_url('assets/js/signup.js'); ?>"></script>
<script src="<? echo base_url('assets/js/jquery.animateNumber.min.js'); ?>"></script>
<script src="<? echo base_url('assets/js/bando.js'); ?>"></script>
</body>
</html>
