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
                   
                </ul>
                <ul class="nav navbar-nav navbar-right text-center">
                  
                </ul>
            </div>
        </div>
    </nav>
</div>

	<div class="container-fluid forgotPage">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2 class="text-uppercase text-primary">Reimposta password</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 col-md-offset-3 jumbotron">
					<div class="row hidden">
						<div class="col-md-12 text-center">
							<p>La tua password è stata reimpostata con successo!</p>
							<button data-toggle="modal" data-target=".login" class="btn btn-primary">Accedi</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label>Imposta Password*</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="password" class="form-control" name="passwordF" autocomplete="off" <? if($code!=200): echo 'disabled'; endif;?>/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label>Conferma Password*</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="password" class="form-control" name="passwordR" autocomplete="off" <? if($code!=200): echo 'disabled'; endif;?>/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-8">
								<p class="text-danger <? if($code==200): ?>hidden<? endif; ?>">
									<? if($code!=200): echo $message; endif; ?>
								</p>		
							</div>
							<div class="col-md-4">
								<button tab_index="<? echo $reset; ?>" data-role="<? echo $role; ?>" class="btn btn-block btn-primary resetDo" <? if($code!=200): echo 'disabled'; endif;?>>Conferma</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	</div>
	<?
		include_once 'footer2.php';
	?>
	<script src="<? echo base_url('assets/js/resetPass.js'); ?>"></script>
	
</body>
</html>