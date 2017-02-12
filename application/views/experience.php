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
					<li><a class="sing2" href="#leFoto">Momenti dell'edizione Click Day 2015</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right text-center">

                </ul>
            </div>
        </div>
    </nav>
</div>

	<div class="main">
		<div class="container-fluid">
			<div class="row t1-section exp">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p id="leFoto">Alcuni momenti dell'edizione Click Day 2015 che si è svolta all'interno delle sedi di ATS - Consulenti Associati a Reggio Emilia.</p>
						</div>
					</div>
					<div class="row">
						<div class="wrap">
							<div class="column1 col">
								<img class="img-responsive" src="<? echo base_url('assets/img/exp1.png'); ?>">
								<img class="img-responsive" src="<? echo base_url('assets/img/exp2.png'); ?>">
								<img class="img-responsive" src="<? echo base_url('assets/img/exp3.png'); ?>">
								<img class="img-responsive" src="<? echo base_url('assets/img/exp4.png'); ?>">
								<img class="img-responsive" src="<? echo base_url('assets/img/exp5.png'); ?>">
							</div>

							<div class="column2 col">
								<div class="column3 col">
									<img class="img-responsive" src="<? echo base_url('assets/img/exp6.png'); ?>">
									<img class="img-responsive" src="<? echo base_url('assets/img/exp7.png'); ?>">
								</div>

								<div class="column4 col">
									<img class="img-responsive" src="<? echo base_url('assets/img/exp8.png'); ?>">
									<img class="img-responsive" src="<? echo base_url('assets/img/exp9.png'); ?>">
									<img class="img-responsive" src="<? echo base_url('assets/img/exp10.png'); ?>">
									<img class="img-responsive" src="<? echo base_url('assets/img/exp11.png'); ?>">
									<img class="img-responsive" src="<? echo base_url('assets/img/exp12.png'); ?>">
								</div>
								<div class="column5 col">
									<img class="img-responsive" src="<? echo base_url('assets/img/exp13.png'); ?>">
								</div>
							</div>
							<div class="column6 col">
								<img class="img-responsive" src="<? echo base_url('assets/img/exp14.png'); ?>">
							</div>
							<div class="column7 col">
								<img class="img-responsive" src="<? echo base_url('assets/img/exp15.png'); ?>">
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row footerAlt">
			<div class="col-md-6 text-center row1left">
				<h3 class="call">Non perdere tempo, <b>iscriviti subito!</b></h3>
				<a href="<? echo base_url('signup'); ?>"><img class="center-block scale" id="iscrivitiSubito" src="<? echo base_url('assets/img/iscrivitiSubito.png'); ?>" alt="Iscriviti Subito!" /></a>
			</div>
			<div class="col-md-6 text-center row1right">
				<div id="bg06">
					<div class="row">
						<div class="col-md-2 col-md-offset-2 text-right fix1i">
							<img class="scale" id="write" src="<? echo base_url('assets/img/write.png'); ?>" alt="write" />
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
							<img class="scale" id="phone" src="<? echo base_url('assets/img/phone.png'); ?>" alt="phone" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<?
			include_once 'footer2.php';
		?>

<script src="<? echo base_url('assets/js/signup.js'); ?>"></script>
<script src="<? echo base_url('assets/js/masonry.pkgd.min.js'); ?>"></script>
<script src="<? echo base_url('assets/js/imagesloaded.pkgd.min.js'); ?>"></script>
<script src="<? echo base_url('assets/js/experience.js'); ?>"></script>
</body>
</html>