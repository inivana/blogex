<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>

    <script src="/~s6/nyxie/apps/views/js/settings.js"></script>
    <script src="/~s6/nyxie/apps/views/left-menu/route-menu.js"></script>
    <link rel="stylesheet" href="/~s6/nyxie/apps/views/left-menu/left-menu.css">
    <link rel="stylesheet" href="/~s6/nyxie/apps/views/styles/settings.css">
</head>

<body onload="load()">

    <div id="left-menu">
		<?php include($menu_bar); ?>
    </div>


		 <div id="container">
		 	
	     <div id="global-information-container">
		 <div class="header">Status konta</div>
		 
		 <table id="global-form">
		 	<tr>
			<td>Email/Login</td>
			<td><?= $email?></br></td>
			</tr>
			<tr>
			<td>Imie</td>
			<td><?= $firstname?></td>
			</tr>
			<tr>
			<td>Nazwisko</td>
			<td><?= $lastname?></td>
			</tr>

		 	<tr>
			<td>Status</td>
			<td><?= $premium?></td>
			</tr>
		 	<tr>
		 </table>
		 
		 <table id="stats-form">
		 	<tr>
			<td>Opublikowane artykuly</td>
			<td><?= $articles?></td>
		 	<tr>
			<td>Ilosc komenatrzy</td>
			<td><?= $comments ?></td>
			</tr>
		 </table>
		 
		 </div>
		 <div id="manage-container">
		 <div class="header">Zmien informacje</div>
		 <form action="settings" method="POST">
		 <table id="password-form">
			<tr>
			<td>Aktualne haslo</td>
			<td><input name="old-password" type="password" placeholder="stare haslo"/></br></td>
			</tr>
		 	<tr>
			<td>Nowe haslo</td>
			<td> <input name="new-password" type="password" placeholder="nowe haslo"/></br></td>
			</tr>
			<tr>
			<td>Powtorz haslo</td>
			<td> <input type="password" name="repeat-password" placeholder="nowe haslo"/></br></td>
			</tr>
			<tr>
			<td>Zatwierdz</td>
			<td><input class="submit-button"  disabled="true" id="change_password" type="submit" value="Zmien haslo"/></td>
			</tr>
		 </table>
			
		 </form>

		 
		 
		 
		 </div>		 
		 
		 <div id="settings-container">
		 <div class="header">Ustawienia Artykulow</div>
		 <form action="settings" method="POST">
		    <table id="settings-form">
			<form action="settings" method="POST">
			<tr>
			<td>Mozliwosc komentowania twoich artykulow przez odwiedzajacych</td>
			<td><input type="checkbox" <?php if($blocked == "0") echo 'checked'; ?> name="comment-permission" ></td>
			<td><input type="submit" class="submit-button" value="Zatwierdz" ></td>
			<td><input type="hidden" name="fix" value="fixed" ></td>
			</tr>
		 </table>
		 
		 </form>
		 </div>

		 </div>
	
</body>
</html>