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
						<li><a href="#leFoto">Momenti dell'edizione Click Day 2015</a></li>
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
		<?
			include_once 'footer.php';
		?>
	</div>

<script src="<? echo base_url('assets/js/signup.js'); ?>"></script>
<script src="<? echo base_url('assets/js/masonry.pkgd.min.js'); ?>"></script>
<script src="<? echo base_url('assets/js/imagesloaded.pkgd.min.js'); ?>"></script>
<script src="<? echo base_url('assets/js/experience.js'); ?>"></script>
</body>
</html>
