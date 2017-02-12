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
                    <li><a href="#clickDay2">Click Day<br/>2016</a></li>
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
                    <li><a href="#premi" class="sing2">Premi</a></li>
                    <li><div class="dot2"></div></li>
                    <li><a href="#percheClick">Perchè<br/>Click Day</a></li>
                    <li><div class="dot2"></div></li>
                    <li><a href="#chiGest">Chi gestisce<br/>il Progetto</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2 class="text-uppercase text-primary">Errore 401</h2>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6 col-md-offset-3 jumbotron missing_page">
				<div class="col-md-12 text-center">
					<p>Accesso non autorizzato.</p>
					<a class="btn btn-primary" href="javascript:window.history.go(-1);">Torna indietro</a>
				</div>
			</div>
		</div>
	</div>

	<?
		include_once 'footer.php';
	?>
</div>

</body>
</html>
