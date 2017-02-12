<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	include_once 'head.php';

	echo '</head>';
	
	include_once 'header.php';
	echo '<div class="container-fluid">';
	if($success):
?>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6 col-md-offset-3 jumbotron activate">
				<div class="col-md-12 text-center">
					<div class="form-group">
						<p>Il tuo profilo è stato attivato con successo.</p>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" data-toggle="modal" data-target=".login">Accedi</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?
	else:
?>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-8 col-md-offset-2 jumbotron activate">
				<div class="col-md-12 text-center">
					<div class="form-group">
						<p class="text-danger">Il codice di attivazione fornito non è valido, riprovare e se il problema persiste contattaci.</p>
					</div>
				</div>
			</div>
		</div>
	</div>	
<?
	endif;
	include_once 'footer.php';
	echo '</div>';
?>
	
</body>
</html>