<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
	 
	 <script src="/nyxie/apps/views/js/settings.js"></script> 
	 <script src="/nyxie/apps/views/js/route-menu.js"></script> 
    <link rel="stylesheet" href="/nyxie/apps/views/styles/mode-style.css">
	 <link rel="stylesheet" href="/nyxie/apps/views/styles/settings.css">
</head>

<body onload="load()">

    <div id="left-menu">
         <ul>
		 <li><input type="button" class="menu-button" id="blogex" onclick="route()" value="Blogex"/></li>
		 <li><input type="button" class="menu-button" id="add" onclick="route()" value="Dodaj Artykul"/></li>
		 <li><input type="button" class="menu-button" id="mode" onclick="route()" value="Moderuj"/></li>
		 <li><input type="button" class="menu-button" id="settings" onclick="route()" value="Ustawienia"/></li>
		 <li><input type="button" class="menu-button" id="logout" onclick="route()" value="Wyloguj sie"/></li>
		 </ul>
    </div>


		 <div id="container">
		 	
	     <div id="global-information-container">
		 <div class="header">Status konta</div>
		 
		 <table id="global-form">
		 	<tr>
			<td>Login</td>
			<td>Janusz Kurwin Nikke</td>
			</tr>
		 	<tr>
			<td>Email</td>
			<td>kulaognia69@gmail.com</br></td>
			</tr>
			<tr>
			<td>Ranga</td>
			<td>Kałamarz</td>
			</tr>
		 	<tr>
			<td>Status</td>
			<td>Premium</td>
			</tr>
		 	<tr>
		 </table>
		 
		 <table id="stats-form">
		 	<tr>
			<td>Opublikowane artykuy</td>
			<td>4</td>
			</tr>
			<td>Ilosc artykolow na 5</td>
			<td>2</td>
			</tr>			
		 	<tr>
			<td>Opublikowane komenatrze</td>
			<td>45</br></td>
			</tr>
		 	<tr>
			<td>Srednia komentarzy na artykul</td>
			<td>6</td>
			</tr>
		 	<tr>
		 </table>
		 
		 </div>
		 <div id="manage-container">
		 <div class="header">Zmien informacje</div>
		 <form action="costam" method="POST">
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

		<form action="costam" method="POST">
		 <table id="email-form">
			<tr>
			<td>Nowy email</td>
			<td><input name="new-email" type="text" placeholder="nowy email"/></br></td>
			</tr>
		 	<tr>
			<td>Haslo</td>
			<td> <input name="password" type="password" placeholder="haslo"/></br></td>
			</tr>
			<tr>
			<td>Zatwierdz</td>
			<td><input class="submit-button" type="submit" value="Zmien email"/></td>
			</tr>
		 </table>
			
		 </form>
		 
		 
		 
		 </div>		 
		 
		 <div id="settings-container">
		 <div class="header">Ustawienia Artykulow</div>
		    <table id="settings-form">
			<form action="costam" method="POST">
			<tr>
			<td>Mozliwosc komentowania twoich artykulow przez odwiedzajacych</td>
			<td><input type="checkbox" name="vis-comment-permittion" ></td>
			</tr>
		 	<tr>
			<td>Mozliwosc komentowania twoich artykulow przez uzytkownikow zalogowanych</td>
			<td><input type="checkbox" name="user-comment-permittion" checked></td>
			</tr>
			<tr>
			<td>Wylacz mozliwosc oceny twoich artykulow</td>
			<td><input type="checkbox" name="user-score-permittion" checked></td>
			</tr>
			</form>
			<tr>
			<td>Szablon</td>
			<td><input type="button" class="submit-button" value="Edytuj"></td>
			</tr>
		 </table>

		 </div>

		 </div>
	
</body>
</html>