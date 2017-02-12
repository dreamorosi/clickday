<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body data-spy="scroll" data-target=".submenu" data-offset="230">
	<div class="modal fade login" tabindex="-1" role="dialog" aria-labelledby="Login">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label>eMail</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="email" class="form-control log" name="email" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label>Password</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="password" class="form-control" name="password" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-5">
								<p class="forgot visible-md visible-lg">Dimenticato la <a href="#">password</a>?</p>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<button class="btn btn-primary btn-block loginDo" data-loading-text="Accesso..">Accedi</button>
								</div>
								<div class="form-group hidden-md hidden-lg">
									<p class="forgot btn btn-primary btn-block">Dimenticato la password?</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right">
							<p class="text-danger hidden"></p>
						</div>
					</div>
				</div>
				<div class="modal-body hidden">
					<div class="row">
						<div class="col-md-12 text-justify">
							<p>Inserisci l'indirizzo eMail usato in fase di registrazione. Riceverai una eMail per reimpostare la tua password.</p>	
						</div>
					</div>
					<div class="row forgotForm">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label>eMail</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="email" class="form-control forgotMail" name="email" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-5">
								<span class="glyphicon visible-md visible-lg glyphicon-arrow-left forgot"></span>
							</div>
							<div class="col-md-7 forgotForm">
								<div class="form-group">
									<button class="btn btn-primary btn-block forgotDo" data-loading-text="Invio..">Invia</button>
								</div>
								<div class="form-group hidden-md hidden-lg">
									<button class="btn btn-primary btn-block forgot"><span class="glyphicon glyphicon-arrow-left"></span></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row forgotForm">
						<div class="col-md-12 text-right">
							<p class="text-danger hidden"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarItems" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<? echo base_url();?>">
					<img class="scale" src="<? echo base_url('assets/img/logo.png');?>"/>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="navbarItems">
				<ul class="nav navbar-nav navbar-left text-uppercase text-center">
					<li><a id="index" href="<? echo base_url(); ?>">Click Day<br>2016</a></li>
					<li><a id="experience" href="<? echo base_url('experience'); ?>">L'esperienza<br>Click Day</a></li>
					<li><a id="bando" href="<? echo base_url('bando'); ?>">Il bando<br>INAIL</a></li>
					<li><a id="chisiamo" href="<? echo base_url('chisiamo'); ?>">Chi<br>siamo</a></li>
					<li><a id="faq" href="<? echo base_url('faq'); ?>">FAQ</a></li>
					<? if(!$isLogged): ?>
					<li data-toggle="modal" data-target=".login"><a href="#">Area<br/>Personale</a></li>
					<li class="signButt"><a id="signup" class="btn btn-info" href="<? echo base_url('signup'); ?>">Diventa<br>cliccatore</a></li>
					<? else:?>
					<li><a href="<? echo base_url('dashboard/'); ?>">Area<br/>Personale</a></li>
					<li><a href="<? echo base_url('login/signout/'); ?>">Logout</a></li>
					<? endif;?>
				</ul>
				<ul class="nav navbar-nav navbar-right text-center">
					<li class="ats"><a target="_blank" href="http://www.atseco.it"><img src="<? echo base_url('assets/img/atslog.png'); ?>"/></a></li>
				</ul>
			</div>
		</div>
	</nav>