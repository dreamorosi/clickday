<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
	<nav class="navbar navbar-fixed-top dashboardNav">
		<div class="container-fluid navcontainer">
			<div class="navbar-header col-sm-3 col-md-2">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<? echo base_url(); ?>">
					<img src="<? echo base_url('assets/img/logo.png'); ?>"/>
				</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right hidden-sm hidden-md hidden-lg">
					<?
					if ($role === 'user') {
						echo $user->name . ' ' . $user->surname;
					} else {
						$title = $role=='admin' ? 'Admin ' : '';
						echo $title . ' ' . $fullName;
					}
					if($cnots > 0):
						?>
						<span class="badge pull-right" id="cnots2">
							<? echo $cnots; ?>
							<span class="glyphicon glyphicon-envelope"></span>
						</span>
					<? endif;
					echo '</span></a></li><li role="separator" class="divider"></li>';
					if($role != 'user'):
						echo '<li><a href="#">Home</a></li>';
						if($role == 'admin'):
							echo '<li><a href="'. base_url('dashboard/managecm') .'">ClickMasters</a></li>';
						endif;
						echo  '<li><a href="'. base_url('dashboard/userlist/') .'">Liste Utenti</a></li>
								<li><a href="'. base_url('dashboard/screens') .'">Screenshots</a></li>';
					endif;
					if($role=='user'){
						echo '<li><a href="' . base_url('dashboard/profile') .'">Modifica dati personali</a></li>';
					}
					if($role=='clickMaster'){
						echo '<li><a href="'.base_url('dashboard/codes').'">Assegna Codici</a></li>';
					}
					echo '<li><a href="' . base_url('login/signout/') . '">Logout</a></li>'
?>
				</ul>
			</div>
		</div>
	</nav>

	<div class="modal fade winners" tabindex="-1" role="dialog" aria-labelledby="Winners">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<p>Ai sensi e per gli effetti del D.Lgs. 196/03 “Codice in materia di protezione dei dati personali”, accettando di scaricare il qui presente file, dichiaro che i dati personali quali Nomi e Cognomi dei cliccatori che saranno presenti nel documento, nonché qualunque altro dato, non saranno né comunicati né diffusi a soggetti terzi di qualunque genere, mantenendone così la riservatezza assoluta. Dichiaro inoltre di essere consapevole delle sanzioni previste dalla normativa Privacy sopra citata in caso di trasgressione della stessa.</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Rifiuto</button>
        	<a target="_blank" href="<? echo base_url('assets/LISTA_PROGETTI_INVIATI_2016.pdf'); ?>" class="btn btn-primary">Accetto</a>
      </div>
			</div>
		</div>
	</div>
