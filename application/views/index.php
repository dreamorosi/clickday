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
					<li><a href="#clickDay2">Click Day<br/>2017</a></li>
          <li><div class="dot2"></div></li>
          <li><a href="#chiSono">Chi sono<br/>i Cliccatori</a></li>
          <li><div class="dot2"></div></li>
          <li><a href="#requisiti" class="sing2">Requisiti</a></li>
          <li><div class="dot2"></div></li>
          <li><a href="#comeFunziona">Come<br/>Funziona</a></li>
      	</ul>
      	<ul class="nav navbar-nav navbar-right text-center">
          <li><a href="#comeGuadagni">Come<br/>Guadagni</a></li>
          <li><div class="dot2"></div></li>
          <li><a href="#premi" class="sing2">Compensi</a></li>
          <li><div class="dot2"></div></li>
          <li><a href="#percheClick">Perchè<br/>Click Day</a></li>
          <li><div class="dot2"></div></li>
          <li><a href="#chiGest">Chi gestisce<br/>il Progetto</a></li>
      	</ul>
      </div>
    </div>
  </nav>
</div>

<div class="modal fade modalw" id="modrequisiti" tabindex="-1" role="dialog" aria-labelledby="modrequisiti">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
	  		<h3>REQUISITI<br>TECNICI</h3>
      	<p>Avere a disposizione un PC di recente produzione, meglio se in ambiente Windows, con browser <b><b>Google Chrome</b></b> ed Internet Explorer (consigliamo di utilizzare Google Chrome) <b><b>installati ed aggiornati</b></b> all’ultima versione ed una <b><b>connessione internet ad alta velocità</b></b> (ADSL 20 MB o superiori). Consigliamo una <b><b>connessione via cavo LAN</b></b> e non WiFi in quanto aumenta le prestazioni nella velocità di invio e quindi le vostre possibilità di ottenere il compenso.</p>
      </div>
      <div class="modal-footer">
				<img class="modLogo" src="<? echo base_url('assets/img/logo.png');?>"/>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modalw" id="modguadagni" tabindex="-1" role="dialog" aria-labelledby="modrequisiti">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
	  		<h3>COME<br>GUADAGNI</h3>
				<p>Se il tuo click risulterà vincente, ovvero se il progetto da te inviato otterrà l’ammissibilità al finanziamento dell’INAIL, guadagnerai un compenso pari a <b><b>€300,00 netti</b></b> (che si concretizzano in un formale <b><b><a href="<? echo base_url('contratto.pdf'); ?>" target="_blank">Contratto di Collaborazione</a></b></b> da €375,00 lordi con ritenuta d’acconto di legge).</p>
				<p>Per far si che il progetto da te inviato ottenga l'ammissibilità al finanziamento, <b><b>dovrai fare click nel più breve tempo possibile</b></b>, in quanto solo i progetti inviati per primi sul sito INAIL verranno ammessi al contributo.</p>
				<p>Il compenso di €300,00 netti sarà erogato a seguito della pubblicazione degli elenchi dei progetti ammessi al contributo sul sito dell’INAIL, presumibilmente una settimana dopo la data del Click Day</p>
				<p>Sono inoltre previsti dei <b><b>compensi speciali</b></b> per i tre cliccatori più veloci.</p>
      </div>
      <div class="modal-footer">
				<img class="modLogo" src="<? echo base_url('assets/img/logo.png');?>"/>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modalw" id="modperche" tabindex="-1" role="dialog" aria-labelledby="modrequisiti">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
	  		<h3 class="text-uppercase">Perchè<br>Clickday</h3>
	  		<p>L’<b><b>INAIL</b></b> (Istituto Nazionale Assicurazione contro gli Infortuni sul Lavoro) è l’Ente Pubblico italiano che si occupa di tutelare, dal punto di vista assicurativo, le vittime degli infortuni sul lavoro. L’Ente ha infatti introdotto e realizzato diverse iniziative rivolte alle imprese, con particolare attenzione al mondo delle medie e piccole, fornendo consulenza, orientamento e formazione in materia di prevenzione degli infortuni, incentivando inoltre, a mezzo di <b><b>contributi ed agevolazioni, anche quelle PMI che hanno investito ed investono in sicurezza</b></b>.<br />
				Anche quest’anno, l’INAIL mette a disposizione delle imprese dei contributi per progetti di miglioramento dei livelli di salute e sicurezza nei luoghi di lavoro. Essendo limitati i contributi a disposizione, l’INAIL li concede ad un numero ristretto di domande, che sono appunto quelle che si posizioneranno per prime in ordine cronologico sul loro portale il giorno del Click Day.</p>
	 		</div>
      <div class="modal-footer">
				<img class="modLogo" src="<? echo base_url('assets/img/logo.png');?>"/>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modalw" id="modats" tabindex="-1" role="dialog" aria-labelledby="modrequisiti">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
	  		<h3 class="text-uppercase">CHI GESTISCE<br>IL PROGETTO</h3>
	  		<p><b><b><a href="<? echo base_url('chisiamo'); ?>">ATS – CONSULENTI ASSOCIATI S.r.l</a></b></b> si occupa, per conto dei propri clienti, oltre alla gestione amministrativa e tecnica dei progetti, di inviare le domande all'INAIL il giorno del Click Day.</p>
      	<p>Dato il numero elevato di domande da inviare, oltre ad impiegare i propri dipendenti e collaboratori, <b><b>seleziona ogni anno dei cliccatori su tutto il territorio nazionale</b></b>, per meglio fronteggiare il numero elevato di pratiche presentate.</p>
      </div>
      <div class="modal-footer">
				<img class="modLogo" src="<? echo base_url('assets/img/logo.png');?>"/>
      </div>
    </div>
  </div>
</div>

<div id="fullpage" class="fullpage-wrapper">
  <div class="section">
    <div class="slide">
      <div class="container-fluid sezione1">
        <div class="row">
					<div class="col-md-6 col-xs-12 col-sm-12 text-center row1left" id="clickDay2">
						<div class="row ent hidden">
						  <div class="col-xs-12 text-justify">
						    <h3 class="text-uppercase text-center">ANCHE QUEST’ANNO CLICK DAY<br />SELEZIONA ABILI CLICCATORI!</h3>
						  </div>
						</div>
            <div class="row ent hidden">
							<div class="col-md-6 col-sm-12 col-xs-12 a1">
	              <img class="scale" id="hand" data-src="<? echo base_url('assets/img/hand.png'); ?>" alt="hand" />
	            </div>
	            <div class="col-md-6 col-sm-12 col-xs-12 text-left testo1">
	              <p>Giunto alla sua VII Edizione, <b>Click Day</b> è il progetto organizzato da ATS - CONSULENTI ASSOCIATI, che raccoglie cliccatori da tutta Italia per inoltrare all’INAIL le domande di tutte quelle aziende che vogliono ottenere contributi a fondo perduto volti a <b>migliorare la sicurezza e il livello di salute sui propri luoghi di lavoro</b>.</p>
	            </div>
            </div>
						<div class="row">
							<div class="col-xs-12 text-center hidden" id="bg01">
	              <p>Tu fai un semplice click per inviare la domanda sul sito dell’INAIL e, se il tuo click sarà tra i più veloci, un’azienda otterrà i contributi.</p>
	            </div>
						</div>
            <div class="row ent hidden">
							<div class="col-md-12 col-sm-12 col-xs-12 text-justify" id="bigPad">
	              <p>Per ripagare il tuo tempo e il tuo impegno, sono previsti <b><b><a href="#comeGuadagni">compensi e premi</a></b></b> per i click più veloci!</p>
	            </div>
            </div>
          </div>
          <div class="col-md-6 col-xs-12 text-center row1right">
						<div class="row hidden hide" id="bg02">
							<div id="bg">
								<h4 class="text-uppercase">È partito il countdown per clickday giovedì 26 maggio 2016</h4>
	    					<div class="col-md-12 yourCountdownContainer">
	    						<h3>500</h3>
	    					</div>
								<div class="col-md-12 text-center text-uppercase">
									<p style="margin-top:0px; color:#fff; line-height:15px; font-size: 1.1em">Countdown a -5 min dall'orario di apertura della pagina</p>
								</div>
							</div>
    				</div>
						<div class="row text-center hidden" id="iscriviti">
							<h3>Vuoi diventare anche tu un<br><span>cliccatore?</span></h3>
              <a href="<? echo base_url('signup'); ?>"><img class="center-block scale" id="iscri" data-src="<? echo base_url('assets/img/iscrivitiSubito.png'); ?>" alt="Iscriviti Subito!" /></a>
						</div>
          </div>
				</div>
      </div>
    </div>
  </div>
  <div class="section">
		<div class="hidden" id="bg03i"></div>
    <div class="slide">
      <div class="container-fluid sezione2">
        <div class="row">
          <div class="col-md-6 text-justify row1left" id="chiSono">
            <h3 class="text-uppercase text-center hidden">Chi sono i cliccatori?</h3>
            <p class="text-center hidden">Potresti essere <b><b>proprio tu!</b></b></p>
            <img class="center-block scale hidden" id="people" data-src="<? echo base_url('assets/img/people.png'); ?>" alt="people" />
          	<p class="testo2 hidden">I cliccatori sono tutte quelle persone che hanno tempo e voglia di partecipare al progetto Click Day.</p>
						<p class="testo2 hidden">Uomini e donne, che vogliono e possono dedicare <b>mezz’ora del proprio tempo</b> il giorno del Click Day per fare il click.</p>
          </div>
          <div class="col-md-6 text-justify row1right" id="requisiti">
						<div id="bg03">
							<h3 class="text-uppercase text-center hidden">Requisiti</h3>
							<img class="center-block scale hidden" id="tools" data-src="<? echo base_url('assets/img/tools.png'); ?>" alt="tools" />
							<h3 class="text-center smod hidden">IMPORTANTE</h3>
							<p class="text-center hidden">Leggi i requisiti tecnici <b>necessari per partecipare</b> a Click Day 2017</p>
							<div data-toggle="modal" data-target="#modrequisiti" id="button1" class="modbutton hidden">CONTINUA<br>A LEGGERE</div>
						</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
    <div class="slide">
      <div class="container-fluid sezione3">
        <div class="row" id="comeFunziona">
          <div class="col-md-12 text-center">
            <h3 class="text-uppercase hidden">Come funziona il click?</h3>
          </div>
        </div>
        <div class="row">
        	<div class="col-md-6 text-justify row1left">
          	<p class="testo3 hidden">Il giorno del Click Day, i cliccatori che avranno aderito al progetto, dovranno procedere con l’<b>invio delle domande sul sito web dell’INAIL</b>.</p>
            <p class="testo3 hidden">Una volta connessi al sito, in ora e giorno da definirsi (l’Inail comunicherà la data e l’orario esatto del click day a partire dal 12 giugno 2017), i cliccatori dovranno incollare un codice alfanumerico da noi fornito preventivamente, all’interno di una finestra dedicata ed infine cliccare un pulsante “invia” nel più breve tempo possibile (3-4 secondi).</p>
            <img class="center-block scale hidden" id="monitor" data-src="<? echo base_url('assets/img/monitor.png'); ?>" alt="monitor" />
          </div>
          <div class="col-md-6 text-justify row1right">
            <h4 class="text-left hidden">È più facile di ciò che pensi!</h4>
            <p class="testo3 hidden">Ti invieremo via email le semplici istruzioni e un video tutorial che ti illustreranno passo dopo passo cosa dovrai fare precisamente quel giorno e saremo comunque a disposizione, anche telefonicamente al numero 0522 701079, per qualunque dubbio o informazione aggiuntiva.</p>
            <p class="testo3 hidden">La data esatta del giorno del Click Day verrà comunicata a partire dal 12 giugno 2017. È richiesta la partecipazione dei cliccatori, davanti al proprio pc, mezz’ora prima dell’orario che comunicheremo.</p>
            <p class="testo3 hidden">Ogni cliccatore effettuerà il click <b><b>comodamente da casa propria</b></b>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
		<div class="hidden" id="bg04i"></div>
      <div class="slide">
        <div class="container-fluid sezione4">
          <div class="row" >
            <div class="col-md-6 text-justify row1left" id="comeGuadagni">
							<img class="center-block scale hidden" id="coG" data-src="<? echo base_url('assets/img/comeGuadagni.png'); ?>" alt="Come Guadagni?" />
							<h3 class="text-center smod hidden">COME GUADAGNI</h3>
							<p class="text-center hidden">Se il tuo click passa, <b>300€ per te!</b></p>
							<div data-toggle="modal" data-target="#modguadagni" id="button2" class="modbutton hidden">CONTINUA<br>A LEGGERE</div>
            </div>
            <div class="col-md-6 text-center row1right" id="premi">
							<div id="bg04">
								<div class="row">
									<h3 class="text-uppercase text-center hidden">Compensi migliori cliccatori</h3>
									<p class="testo3 hidden">(in base alla velocità di invio del progetto sul totale dei cliccatori di ATS – CONSULENTI ASSOCIATI S.r.l.)</p>
								</div>
								<div class="row marg2i">
									<div class="col-md-4">
										<img class="center-block banner scale hidden" data-src="<? echo base_url('assets/img/second.png'); ?>" alt="second" />
										<h3>€ 2.500,00 lordi</h3>
									</div>
									<div class="col-md-4">
										<img class="center-block banner scale hidden" data-src="<? echo base_url('assets/img/first.png'); ?>" alt="first" />
										<h3>€ 4.500,00 lordi</h3>
									</div>
									<div class="col-md-4">
										<img class="center-block banner scale hidden" data-src="<? echo base_url('assets/img/third.png'); ?>" alt="third" />
										<h3>€ 1.500,00 lordi</h3>
									</div>
								</div>
							</div>
            </div>
          </div>
        </div>
      </div>
  	</div>
    <div class="section">
			<div class="hidden" id="bg05i"></div>
      <div class="slide">
        <div class="container-fluid sezione5">
          <div class="row">
            <div class="col-md-6 text-justify row1left" id="percheClick">
							<div id="bg05">
								<img class="center-block scale" id="manwork" data-src="<? echo base_url('assets/img/manwork.png'); ?>" alt="ATS Consulenti Associati" />
								<h3 class="text-uppercase text-center hidden">Perché click day?</h3>
								<p class="testo3 text-center hidden">Il fine è quello di <b>ridurre sui luoghi di lavoro il numero e la gravità degli infortuni</b>. Continua a leggere sotto sui finanziamenti che L’INAIL mette a disposizione.</p>
								<div data-toggle="modal" data-target="#modperche" id="button3" class="modbutton hidden">CONTINUA<br>A LEGGERE</div>
							</div>
            </div>
            <div class="col-md-6 text-justify row1right" id="chiGest">
              <img class="center-block scale hidden" id="atsBig" data-src="<? echo base_url('assets/img/atslog.png'); ?>" alt="ATS Consulenti Associati" />
              <h3 class="text-uppercase text-center hidden">Chi gestisce il progetto click day?</h3>
							<div data-toggle="modal" data-target="#modats" id="button4" class="modbutton hidden">CONTINUA<br>A LEGGERE</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
			<div class="hidden" id="bg06i"></div>
        <div class="slide">
          <div class="container-fluid sezione1 sezione5">
            <div class="row">
              <div class="col-md-6 text-center row1left">
                <h3 class="call hidden">Non perdere tempo, <b>iscriviti subito!</b></h3>
                <a href="<? echo base_url('signup'); ?>"><img class="center-block scale hidden" id="iscrivitiSubito" data-src="<? echo base_url('assets/img/iscrivitiSubito.png'); ?>" alt="Iscriviti Subito!" /></a>
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

<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape1" clipPathUnits="objectBoundingBox">
	  <polygon points="0 0, 0.95 0.25, 0.93 1, 0 0.85" />
	</clipPath>
  </defs>
</svg>
<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape2" clipPathUnits="objectBoundingBox">
	  <polygon points="0.04 0.07, 1 0, 1 1, 0 0.85" />
	</clipPath>
  </defs>
</svg>
<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape3" clipPathUnits="objectBoundingBox">
	  <polygon points="0.03 0.03, 1 0, 1 1, 0 0.97" />
	</clipPath>
  </defs>
</svg>
<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape4" clipPathUnits="objectBoundingBox">
	  <polygon points="0 0, 1 0.03, 1 0.97, 0.03 1" />
	</clipPath>
  </defs>
</svg>
<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape5" clipPathUnits="objectBoundingBox">
	  <polygon points="0 0, 0.97 0.03, 1 0.97, 0 1" />
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
<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape7" clipPathUnits="objectBoundingBox">
	  <polygon points="0.05 0.1, 1 0, 1 1, 0 0.90" />
	</clipPath>
  </defs>
</svg>
<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape8" clipPathUnits="objectBoundingBox">
	  <polygon points="0 0.15, 1 0, 1 0.9, 0.06 1" />
	</clipPath>
  </defs>
</svg>
<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape9" clipPathUnits="objectBoundingBox">
	  <polygon points="0.1 0, 0.9 0.1, 1 1, 0 1" />
	</clipPath>
  </defs>
</svg>
<svg width="0" height="0">
  <defs>
	<clipPath id="clip-shape10" clipPathUnits="objectBoundingBox">
	  <polygon points="0.05 0.1, 0.95 0, 1 1, 0 0.9" />
	</clipPath>
  </defs>
</svg>

<script src="<? echo base_url('assets/js/index.js'); ?>"></script>
</body>
</html>
