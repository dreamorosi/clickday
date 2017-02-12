<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width"/>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<style type="text/css">

</style>	
</head>
<body>
	<div style="width: 99%; height: 100px"><img style="display:block;width: 200px; margin-left:250px;" src="<? echo 'http://andreamorosi.com/click/assets/img/logo.png';#echo base_url('assets/img/logo.png'); ?>"/></div>
	<div style="border: 1px solid #000; width: 99%; padding: 10px 5px 0px 5px; margin-top: 15px; height: 50px">
		<div style="width: 17%; float: left; height: 50px"><p style="font-family: 'Montserrat', sans-serif; font-weight: bold; padding-left: 10px; font-size: 10px;">User</p></div>
		<div style="width: 17%; float: left; height: 50px"><p style="font-family: 'Montserrat', sans-serif; font-weight: bold;  padding-left: 9px; font-size: 10px;">eMail</p></div>
		<div style="width: 12%; float: left; height: 50px"><p style="font-family: 'Montserrat', sans-serif; font-weight: bold;  padding-left: 10px; font-size: 10px;">Data Registrazione</p></div>
		<div style="width: 17%; float: left; height: 50px"><p style="font-family: 'Montserrat', sans-serif; font-weight: bold;  padding-left: 10px; font-size: 10px;">ClickMaster Associato</p></div>
		<div style="width: 12%; float: left; height: 50px"><p style="font-family: 'Montserrat', sans-serif; font-weight: bold;  padding-left: 10px; font-size: 10px;">Conferma registrazione</p></div>
		<div style="width: 12%; float: left; height: 50px"><p style="font-family: 'Montserrat', sans-serif; font-weight: bold;  padding-left: 10px; font-size: 10px;">Codice ricevuto</p></div>
		<div style="width: 12%; float: left; height: 50px"><p style="font-family: 'Montserrat', sans-serif; font-weight: bold;  padding-left: 9px; font-size: 10px;">Screenshot</p></div>
	</div>
	<?
		foreach($users as $us):
	?>
			<div style="border: 1px; solid #000; width: 99%; padding: 10px; 10px; 0px; 10px;height: 50px; text-align: center">
				<div style="width: 17%; float: left; height: 50px; font-size: 10px;">
					<p style="font-family: Montserrat, sans-serif;"><? echo $us['name']; ?></p>
				</div>
				<div style="width: 17%; float: left; height: 50px; font-size: 10px;">
					<p style="font-family: Montserrat, sans-serif;"><? echo $us['email']; ?></p>
				</div>
				<div style="width: 12%; float: left; height: 50px; font-size: 10px;">
					<p style="font-family: Montserrat, sans-serif;"><? echo $us['join']; ?></p>
				</div>
				<div style="width: 17%; float: left; height: 50px; font-size: 10px;">
					<p style="font-family: Montserrat, sans-serif;"><? echo $us['clickM']; ?></p>
				</div>
				<div style="width: 12%; float: left; height: 50px; font-size: 10px;">
					<p style="font-family: Montserrat, sans-serif;"><? echo $us['approved']; ?></p>
				</div>
				<div style="width: 12%; float: left; height: 50px; font-size: 10px;">
					<p style="font-family: Montserrat, sans-serif;"><? echo $us['code']; ?></p>
				</div>
				<div style="width: 12%; float: left; height: 50px; font-size: 10px;">
					<p style="font-family: Montserrat, sans-serif;"><? echo $us['screen']; ?></p>
				</div>
			</div>
	<?
		endforeach;
	?>
</body>