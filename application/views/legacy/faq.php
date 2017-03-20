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
						<li><a href="#clickDay2">Domande Frequenti</a></li>
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
					<div class="col-md-12">
						<h2 id="clickDay2" class="text-uppercase">Informazioni Generali</h2>
						<ul class="listF list-unstyled">
							<li><a role="button" data-toggle="collapse" href="#col1" aria-expanded="false">Quando ci sarà il Click Day?</a><div id="col1" class="collapse">Il giorno del Click Day sarà comunicato dall’INAIL a partire dal 12 giugno 2017, plausibilmente in una data compresa nelle due settimane successive. Vi aggiorneremo costantemente.</div></li>
							<li><a role="button" data-toggle="collapse" href="#col2" aria-expanded="false">Dove sarà realizzato il Click Day?</a><div id="col2" class="collapse">Da nessuna parte! Potrai fare il tuo click comodamente da casa!</div></li>
							<li><a role="button" data-toggle="collapse" href="#col3" aria-expanded="false">Quanto tempo dovrò impiegare per fare la procedura del click?</a><div id="col3" class="collapse">
								Circa 30 minuti.
							</div></li>
							<li><a role="button" data-toggle="collapse" href="#col4" aria-expanded="false">Cosa c’entra il mio click con l’INAIL?</a><div id="col4" class="collapse">
								Nulla. I cliccatori non hanno alcun tipo di relazione con l’INAIL, ma solo con l’organizzatore del progetto.
								L’INAIL è semplicemente l’Ente Pubblico che si occupa di tutelare le vittime degli infortuni sul lavoro e che mette a disposizione delle imprese dei contributi finanziari per progetti di miglioramento dei livelli di salute e sicurezza nei luoghi di lavoro.
Le aziende che sono interessate ad ottenere tali contributi si rivolgono a degli studi di consulenza – in questo caso ATS – Consulenti Associati – per svolgere tutte le pratiche per ottenerli, compreso l’invio della domanda tramite un click.
							</div></li>
							<li><a role="button" data-toggle="collapse" href="#col5" aria-expanded="false">Cosa devo fare il giorno del Click Day?</a><div id="col5" class="collapse">
								Accendere il tuo pc, seguire le istruzioni che ti avremo inviato via mail, fare click ed infine inviare lo screenshot/stamp della schermata d’invio loggandosi con le proprie credenziali sul portale clickdayats.it, attraverso la sezione “screenshots”.
							</div></li>
							<li><a role="button" data-toggle="collapse" href="#col6" aria-expanded="false">Quando riceverò il mio compenso?</a><div id="col6" class="collapse">
								Riceverai il tuo compenso, a mezzo di bonifico bancario, entro 30 giorni dalla pubblicazione degli elenchi cronologici dell’INAIL che individuano i progetti ammissibili a contributo.
							</div></li>
							<li><a role="button" data-toggle="collapse" href="#col7" aria-expanded="false">Posso partecipare anche se ho la partita IVA?</a><div id="col7" class="collapse">
								Certo! Anziché un contratto di collaborazione occasionale, il cliccatore in possesso di p.IVA emetterà regolare fattura.
							</div></li>
							<li><a role="button" data-toggle="collapse" href="#col8" aria-expanded="false">Posso visionare il contratto di collaborazione?</a><div id="col8" class="collapse">
								Certo! Lo trovi a questo <a href="<? echo base_url('contratto.pdf'); ?>" target="_blank">link</a>!
							</div></li>
							<li><a role="button" data-toggle="collapse" href="#col9" aria-expanded="false">Chi sono i Click Master?</a><div id="col9" class="collapse">
								I Click Master sono i tutor dei cliccatori.<br>
								Ogni Click Master gestisce un determinato numero di cliccatori inviando loro le comunicazioni relative al progetto (come iscriversi, come funziona il Click Day, quale giorno avverrà il click, ecc) e rispondendo alle loro eventuali domande.
							</div></li>
							<li><a role="button" data-toggle="collapse" href="#col10" aria-expanded="false">Cosa succede se non hai un Click Master?</a><div id="col10" class="collapse">
								Se ti iscrivi direttamente dal sito senza avere un codice Click Master, non preoccuparti, ti verrà assegnato in automatico al termine della registrazione.
							</div></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<?
			include_once 'footer.php';
		?>
	</div>
<script src="<? echo base_url('assets/js/signup.js'); ?>"></script>
<script src="<? echo base_url('assets/js/faq.js'); ?>"></script>
</body>
</html>
