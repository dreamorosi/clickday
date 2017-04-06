<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head.php';

	echo '</head>';

	include_once 'header.php';
	if($success):
?>
<?
	else:
  endif;
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6 col-md-offset-3 jumbotron activate text-center">
        <div class="row">
  				<div class="form-group">
            <p>Ciao <? echo $name; ?></p>
  					<p>Inserisci una password per il tuo account.</p>
  				</div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 col-md-offset-3">
            <input class="form-control" name="password" type="password" placeholder="Nuova Password" tabindex="1" required />
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 col-md-offset-3">
            <input class="form-control" name="password2" type="password" placeholder="Conferma Nuova Password" tabindex="2" required />
          </div>
        </div>
        <div class="row hidden tips">
          <div class="form-group">
  					<small class="text-danger"></small>
  				</div>
        </div>
        <div class="row">
  				<div class="form-group">
  					<button class="btn btn-primary save" data-id="<? echo $ID; ?>">Salva</button>
  				</div>
        </div>
			</div>
		</div>
	</div>
<?
	include_once 'footer.php';
?>
</div>
<script src="<? echo base_url('assets/js/adminFirst.js'); ?>"></script>
</body>
</html>
