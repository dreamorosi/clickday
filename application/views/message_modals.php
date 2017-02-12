<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
	
	<div class="modal fade sendmessage mess" tabindex="-1" role="dialog" aria-labelledby="sendmessage" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Nuovo messaggio</h4>
				</div>
				<div class="modal-body">
				
					<p class="text-danger hidden"></p>
					<form>
						<? if($role == 'user') :?>
							<label>Destinatari</label><br>
							<div class="checkbox checkbox-circle checkbox-orange">
								<input type="checkbox" id="admin-check" checked disabled>
								<label for="admin-check">
									Admins
								</label>
							</div>
							<? if(($clickM != -1)&&($this->clickmaster->getName($clickM)!='')): ?>
								<div class="checkbox checkbox-circle checkbox-orange">
									<input type="checkbox" id="cm-check" data-id="<? echo $clickM; ?>" checked disabled>
									<label for="cm-check">
										CM <?php echo $this->clickmaster->getName($clickM); ?>
									</label>
								</div>
							<? endif; ?>
						<? endif; ?>
						<? if($role == 'clickMaster') :?>
							<label>Destinatari</label><br>
							<div class="checkbox checkbox-circle checkbox-orange">
								<input type="checkbox" id="admin-check" checked>
								<label for="admin-check">
									Admins
								</label>
							</div>
							<? if(count($this->dashboard_model->getCMusers($ID,1)) > 0): ?>
								<div class="checkbox checkbox-circle checkbox-orange">
									<input type="checkbox" id="users-check" checked>
									<label for="users-check">
										Utenti
									</label>
								</div>
							<? endif; ?>
						<? endif; ?>
						<? if($role == 'admin') :?>
							<label>Destinatari</label><br>
							<div class="checkbox checkbox-circle checkbox-orange">
								<input type="checkbox" id="cm-check" checked>
								<label for="cm-check">
									ClickMasters
								</label>
							</div>
							<div class="checkbox checkbox-circle checkbox-orange">
								<input type="checkbox" id="users-check" checked>
								<label for="users-check">
									Utenti
								</label>
							</div>
						<? endif; ?>
						<div class="form-group">
							<label for="oggetto">Oggetto</label>
							<input type="text" class="form-control oggetto" name="oggetto">
						</div>
						<div class="form-group">
							<label for="testo">Testo</label>
							<textarea id="testo" class="form-control testo" rows="3" name="testo"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Chiudi</button>
					<button type="button" class="btn btn-primary sendmessageDo">Invia</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade sendmessage2 mess" tabindex="-1" role="dialog" aria-labelledby="sendmessage2" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Nuovo messaggio</h4>
				</div>
				<div class="modal-body">
				
					<p class="text-danger hidden"></p>
					<form>
						<div class="checkbox checkbox-circle checkbox-orange">
							<input type="checkbox" id="mess-check" disabled checked>
							<label id="messDest" for="mess-check">
								Admin
							</label>
						</div>
						<div class="form-group">
							<label for="oggetto">Oggetto</label>
							<input type="text" class="form-control oggetto" name="oggetto">
						</div>
						<div class="form-group">
							<label for="testo">Testo</label>
							<textarea id="testo" class="form-control testo" rows="3" name="testo"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Chiudi</button>
					<button type="button" class="btn btn-primary sendmessageDo2">Invia</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade readmessage mess" id="readmessage" tabindex="-1" role="dialog" aria-labelledby="readmessage" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Messaggi</h4>
				</div>
				<div class="modal-body">
					<div class="mex"></div>
					<div class="parents"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Chiudi</button>
					<button type="button" class="btn btn-primary setresponseDo" id="setresponseDo">Rispondi</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade responsemessage mess" id="responsemessage" tabindex="-1" role="dialog" aria-labelledby="responsemessage" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Rispondi</h4>
				</div>
				<div class="modal-body">
				
					<p class="text-danger hidden"></p>
					<form>
						<label>Destinatari</label><br>
						<div class="checkbox checkbox-circle checkbox-orange">
							<input type="checkbox" id="dest-check" disabled checked>
							<label id="respDest" for="dest-check">
								Admin
							</label>
						</div>
						<div class="form-group">
							<label for="oggetto">Oggetto</label>
							<input type="text" class="form-control oggetto" name="oggetto" id="respOgg">
						</div>
						<div class="form-group">
							<label for="testo">Testo</label>
							<textarea id="testo" class="form-control testo" rows="3" name="testo"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Chiudi</button>
					<button type="button" class="btn btn-primary responsemessageDo">Invia</button>
				</div>
			</div>
		</div>
	</div>