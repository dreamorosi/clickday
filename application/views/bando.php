<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head.php';
	echo '</head>';

	include_once 'header.php';
?>
<div class="submenu">
  <nav class="navbar navbar-default">
    <div class="container container-menu">
      <div class="collapse navbar-collapse" id="subNavItems">
        <ul class="nav navbar-nav navbar-left text-center">
					<li><a class="sing2" href="#cosa">Il bando INAIL</a></li>
					<li><div class="dot2"></div></li>
					<li><a class="sing2" href="#cosa">Cos'è</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right text-center"></ul>
      </div>
    </div>
  </nav>
</div>

<div id="fullpage" class="fullpage-wrapper">
	<div class="section">
		<div class="hidden" id="bg04i"></div>
      <div class="slide">
        <div class="container-fluid sezione4">
          <div class="row" id="cosa">
            <div class="col-md-6 text-justify row1left more-margin" id="comeGuadagni">
							<h3 class="text-uppercase text-center hidden">Il bando inail</h3>
							<img class="center-block scale hidden" id="inail" data-src="<? echo base_url('assets/img/inail.png'); ?>" alt="INAIL" />
					    <p class="testo3 hidden">Con il BANDO ISI 2016, Click Day 2017, l’INAIL rinnova ancora una volta il proprio impegno per il welfare del Paese, mettendo a disposizione delle imprese <b><b>244.507.756 Euro</b></b> di contributi a fondo perduto per progetti di miglioramento dei livelli di salute e sicurezza nei luoghi di lavoro.</p>
              <p class="testo3 hidden">Tale stanziamento è ripartito in budget regionali ed i contributi vengono assegnati fino ad esaurimento, secondo l’ordine cronologico di arrivo delle domande inviate il giorno del Click Day.</p>
						<div class="text-center">
							<a href="https://www.inail.it/cs/internet/attivita/prevenzione-e-sicurezza/agevolazioni-e-finanziamenti/incentivi-alle-imprese/bando-isi-2016.html" target="_blank" id="visbtn" class="btn btn-primary text-uppercase hidden">Visualizza</a>
						</div>
        	</div>
          <div class="col-md-6 text-center row1right" id="premi">
						<div id="bg04">
							<div class="row">
								<h3 class="text-uppercase text-center">Cos'è</h3>
								<img class="center-block scale" id="quest" data-src="<? echo base_url('assets/img/quest.png'); ?>" alt="Cos'è?" />
								<p class="testo3 more-padding text-justify">L'INAIL finanzia in conto capitale le spese sostenute per progetti di miglioramento dei livelli di salute e sicurezza nei luoghi di lavoro. I destinatari degli incentivi sono le imprese, anche individuali, iscritte alla Camera di commercio, industria, artigianato ed agricoltura.<br />
								Il contributo è pari al 65% delle spese sostenute dall’impresa per la realizzazione del progetto, al netto dell’iva. Il contributo massimo erogabile è pari a € 130.000 e viene erogato all’azienda a seguito del superamento del Click Day e della verifica tecnico-amministrativa conseguente alla realizzazione del progetto.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div id="bg06i"></div>
      <div class="slide">
        <div class="container-fluid sezione1 sezione5">
          <div class="row">
            <div class="col-md-6 text-center row1left">
              <h3 class="call">Non perdere tempo, <b>iscriviti subito!</b></h3>
              <a href="<? echo base_url('signup'); ?>"><img class="center-block scale" id="iscrivitiSubito" data-src="<? echo base_url('assets/img/iscrivitiSubito.png'); ?>" alt="Iscriviti Subito!" /></a>
            </div>
            <div class="col-md-6 text-center row1right">
							<div id="bg06">
								<div class="row">
							    <div class="col-md-2 col-md-offset-2 text-right fix1i">
						        <img class="scale" id="write" data-src="<? echo base_url('assets/img/write.png'); ?>" alt="write" />
							    </div>
									<div class="col-md-6 text-right fix1i">
										<h5 class="text-uppercase">Vuoi maggiori informazioni?</h5>
										<h1 class="text-uppercase">Scrivici!</h1>
										<h2><a href="mailto:info@clickdayats.it">info@clickdayats.it</a></h2>
									</div>
								</div>
								<div class="row marg1i fix1i">
									<div class="col-md-6 col-md-offset-2 text-right fix1i">
										<h5 class="text-uppercase">Oppure chiamaci al numero:</h5>
										<h6 class="text-uppercase">0522-701079</h6>
							    </div>
									<div class="col-md-2 text-left fix1i">
										<img class="scale" id="phone" data-src="<? echo base_url('assets/img/phone.png'); ?>" alt="phone" />
									</div>
								</div>
							</div>
						</div>
					</div>
				<?
					include_once 'footer.php';
				?>
			</div>
		</div>
	</div>
</div>

<style>
	#bg04i{
		-webkit-clip-path: polygon(0% 0%, 100% 3%, 100% 97%, 3% 100%);
		clip-path: polygon(0% 0%, 100% 3%, 100% 97%, 3% 100%);
		-webkit-clip-path: url("../../bando#clip-shape4");
		clip-path: url("../../bando#clip-shape4");
	}
	#bg06i{
		-webkit-clip-path: polygon(3% 3%, 100% 0, 100% 100%, 0 97%);
		clip-path: polygon(3% 3%, 100% 0, 100% 100%, 0 97%);
		-webkit-clip-path: url("../../#clip-shape6");
		clip-path: url("../../bando#clip-shape6");
	}
	@media (max-width: 991px){
		#bg04 {
			-webkit-clip-path: polygon(0% 0%, 100% 3%, 100% 97%, 3% 100%);
			clip-path: polygon(0% 0%, 100% 3%, 100% 97%, 3% 100%);
			-webkit-clip-path: url("../../bando#clip-shape4");
			clip-path: url("../../bando#clip-shape4");
		}
		#bg06 {
			-webkit-clip-path: polygon(3% 3%, 100% 0, 100% 100%, 0 97%);
			clip-path: polygon(3% 3%, 100% 0, 100% 100%, 0 97%);
			-webkit-clip-path: url("../../#clip-shape6");
			clip-path: url("../../bando#clip-shape6");
		}
	}
</style>

<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape4" clipPathUnits="objectBoundingBox">
	  <polygon points="0 0, 1 0.03, 1 0.97, 0.03 1" />
	</clipPath>
  </defs>
</svg>
<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape6" clipPathUnits="objectBoundingBox">
	  <polygon points="0.03 0.03, 1 0, 1 1, 0 0.97" />
	</clipPath>
  </defs>
</svg>

<script src="<? echo base_url('assets/js/bando.js'); ?>"></script>
</body>
</html>
