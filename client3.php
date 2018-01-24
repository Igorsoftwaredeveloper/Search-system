<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"> 
		<title> My client </title>
		<style>
		P {
			line-height: 0.1em;
		  }
		h1 {
			font-family: 'Times New Roman', Times, serif; /* Шрифт с засечками */
			font-style: italic; /* Курсивное начертание */
			color: #CC3333;
		   }
		body {
			background: #FFFFFF	; /* Цвет фона */
			color: #FFFFCC; /* Цвет текста */
			 }
		#user {
				width: 470px; /* Ширина поля в пикселах */
				height: 30px;
			  }
		#btn {
				width: 100px; /* Ширина поля в пикселах */
				height: 30px;
			  }	  
		</style>
	</head>
	
	<body>
			<p align="center"><img src="pic.png" alt="100%"></p>
	
			<!--p><h1><p align="center">Поиск<br></p></h1></p--> 			
			
			<form  action="server7.php">
				<h2><p align="center"><input type="text" placeholder="Введите запрос" name="1" id="user" required></p></h2>
				<h2><p align="center"><input type="submit" value="Найти" name="vvod" id="btn"></p></h2>
			</form>

			
			
	</body>
</html>