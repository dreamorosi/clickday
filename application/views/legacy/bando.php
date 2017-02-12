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
						<li><a href="#ilBando">Il bando INAIL</a></li>
						<li><a href="#cosa">Cos'è</a></li>
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
			<div class="row t1-section inail">
				<div class="container">
					<div class="col-md-6">
						<h2 id="ilBando">IL BANDO INAIL</h2>
						<p>Con il BANDO ISI 2015/2016 l’INAIL rinnova ancora una volta il proprio
						impegno per il welfare del Paese, mettendo a disposizione delle imprese
						<b>276.269.986 Euro</b> di contributi a fondo perduto per progetti di miglioramento dei
						livelli di salute e sicurezza nei luoghi di lavoro.</p>
						<p>Tale stanziamento è ripartito in budget regionali ed i contributi vengono assegnati fino
						ad esaurimento, secondo l’ordine cronologico di arrivo delle domande inviate il giorno del Click Day.</p>
						<div class="btn-cont">
							<a href="http://www.inail.it/internet/default/INAILincasodi/Incentiviperlasicurezza/BandoIsi2015/index.html" target="_blank"><button type="button" class="btn btn-primary">VISUALIZZA</button></a>
						</div>
					</div>
					<div class="col-md-6">
						<img class="img-responsive scale" src="<? echo base_url('assets/img/inail.png'); ?>" alt="inail" />
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row t5-section">
				<div class="container">
					<div class="col-md-3">
					<img class="img-responsive scale" src="<? echo base_url('assets/img/quest.png'); ?>" alt="quest" />
					</div>
					<div class="col-md-9">
						<h2 id="cosa">COS'È</h2>
						<p>L'INAIL finanzia in conto capitale le spese sostenute per progetti di miglioramento dei livelli di salute e sicurezza
						nei luoghi di lavoro. I destinatari degli incentivi sono le imprese, anche individuali, iscritte alla Camera di
						commercio, industria, artigianato ed agricoltura.<br>
						Il contributo è pari al <b>65% delle spese sostenute dall’impresa</b> per la realizzazione del progetto, al netto dell’iva.
						Il contributo massimo erogabile è pari a <b>€ 130.000</b> e viene erogato all’azienda a seguito del superamento del Click
						Day e della verifica tecnico-amministrativa conseguente alla realizzazione del progetto.
						</p>
					</div>
				</div>
			</div>
		</div>
		<?
			include_once 'footer.php';
		?>
	</div>
<script src="<? echo base_url('assets/js/signup.js'); ?>"></script>
<script src="<? echo base_url('assets/js/bando.js'); ?>"></script>
</body>
</html>
