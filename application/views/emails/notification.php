<? include_once 'head_mail.php'; ?>
							<table class="row">
								<tr>
									<td class="wrapper last">
										<table class="twelve columns">
											<tr>
												<td class="text-pad">
													<h2 style="border-bottom: 1px solid #f6a723" class="text-ora">Profilo ClickMaster creato</h2>
												</td>
												<td class="expander"></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table class="row">
								<tr>
									<td class="wrapper last">
										<table class="twelve columns">
											<tr>
												<td class="text-pad">
													<p>Il tuo profilo ClickMaster è stato creato. Le tue credenziali di accesso sono:</p>
													<table>
														<tr>
															<td style="width: 100px;">User:</td>
															<td><a class="text-ora" href="mailto:<? echo $email; ?>"><? echo $email; ?></a></td>
														</tr>
														<tr>
															<td style="width: 100px;">Password:</td>
															<td><? echo $pass; ?></td>
														</tr>
													</table>
												</td>
												<td class="expander"></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table class="row">
								<tr>
									<td class="wrapper last">
										<table class="twelve columns">
											<tr>
												<td class="text-pad">
													<a class="text-ora" style="text-decoration: underline" href="<? echo $base_url; ?>"><h6 style="font-family: 'Montserrat', sans-serif;" class="text-ora">Accedi al Profilo ClickMaster</h6></a>
												</td>
												<td class="expander"></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table class="row">
								<tr>
									<td class="wrapper last">
										<table class="twelve columns">
											<tr>
												<td style="padding-bottom: 0px" class="text-pad">
													<p style="border-bottom: 1px solid #f6a723; padding-bottom: 100px">Altrimenti copia questo url nel tuo browser:<br/><a style="text-decoration: underline; font-size: 14px" class="text-ora" href="<? echo $base_url; ?>"><? echo $base_url; ?></a></p>
										
												</td>
												<td class="expander"></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table class="row">
								<tr>
									<td class="wrapper last">
										<table class="twelve columns">
											<tr>
												<td style="padding-bottom: 0px" class="text-pad">
													<p>Potrai quindi gestire le tue comunicazioni da e verso gli utenti, rivedere le liste degli iscritti e il loro status, stampare le liste cliccatori e rivedere gli screenshot di avvenuta presa in carico del codice progetto.</p>
										
												</td>
												<td class="expander"></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table class="row">
								<tr>
									<td class="wrapper last">
										<table class="twelve columns">
											<tr>
												<td class="text-pad">
													<p>Hai bisogno di aiuto? Scrivici a <a style="text-decoration: underline; font-size: 14px" class="text-ora" href="mailto:info@clickdayats.it">info@clickdayats.it</a></p>
												</td>
												<td class="expander"></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
<? include_once 'footer_mail.php'; ?>