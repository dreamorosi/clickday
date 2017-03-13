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
					<li><a class="sing2" href="#chi">Chi Siamo</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right text-center">

                </ul>
            </div>
        </div>
    </nav>
</div>
<div id="fullpage" class="fullpage-wrapper">
	<div class="section">
		<div id="bg04i"></div>
        <div class="slide">
            <div class="container-fluid sezione4">
                <div class="row" id="chi">
                    <div class="col-md-6 text-justify row1left" id="comeGuadagni">
						<img class="center-block scale" id="atslogBig" data-src="<? echo base_url('assets/img/atslog.png'); ?>" alt="ATS Consulenti Associati" />
						<div class="text-center">
							<a href="http://www.atseco.it/" target="_blank" class="btn btn-primary text-uppercase">Visualizza</a>
						</div>
                    </div>
                    <div class="col-md-6 text-center row1right" id="chiSiamo">
						<div id="bg04">
							<div class="row">
								<h3 class="text-uppercase text-center">Chi siamo</h3>
								<p class="testo3 text-justify">Siamo una società di consulenza fondata nel 1995
								con sede a Reggio Emilia.<br>
								Per il BANDO INAIL ci occupiamo, oltre che dell'invio delle domande il giorno del Click
								Day, di <b>tutte le pratiche tecniche ed amministrative</b> necessarie alla presentazione dei
								progetti all'INAIL per l'ottenimento dei contributi.<br>
								Dato il numero elevato di domande da inviare all’INAIL il giorno del Click Day, ATS - CONSULENTI ASSOCIATI S.r.l. - oltre ad impiegare i propri dipendenti e collaboratori diretti sul progetto - seleziona ogni anno dei cliccatori su tutto il territorio nazionale per fronteggiare al meglio il numero elevato di pratiche presentate.</p>
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
		-webkit-clip-path: url("../../chisiamo#clip-shape4");
		clip-path: url("../../chisiamo#clip-shape4");
	}
	#bg06i{
		-webkit-clip-path: polygon(3% 3%, 100% 0, 100% 100%, 0 97%);
		clip-path: polygon(3% 3%, 100% 0, 100% 100%, 0 97%);
		-webkit-clip-path: url("../../#clip-shape6");
		clip-path: url("../../chisiamo#clip-shape6");
	}
	@media (max-width: 991px){
		#bg04 {
			-webkit-clip-path: polygon(0% 0%, 100% 3%, 100% 97%, 3% 100%);
			clip-path: polygon(0% 0%, 100% 3%, 100% 97%, 3% 100%);
			-webkit-clip-path: url("../../chisiamo#clip-shape4");
			clip-path: url("../../chisiamo#clip-shape4");
		}
		#bg06 {
			-webkit-clip-path: polygon(3% 3%, 100% 0, 100% 100%, 0 97%);
			clip-path: polygon(3% 3%, 100% 0, 100% 100%, 0 97%);
			-webkit-clip-path: url("../../#clip-shape6");
			clip-path: url("../../chisiamo#clip-shape6");
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

<script src="<? echo base_url('assets/js/signup.js'); ?>"></script>
<script src="<? echo base_url('assets/js/bando.js'); ?>"></script>
</body>
</html>