<header>
	<?php 
	require 'php/CounterVisitings.php';
	 ?>
		<a href="index.php"><img class="logo" src="img/Logo.jpg" alt="Logo"></a>
		<nav>
			<div class="header-top">
				<div class="hotel-name">Grand-ele</div>
				<div class="header-right">
					<button class="language">Русский/English</button>
					<?php  
						if (!isset($_COOKIE['user'])):
					?>
					<div class="auth"><a href="authform.php">Войти</a></div>
					<div class="auth"><a href="regform.php">Регистрация</a></div>
					<?php else: 
						$cook_arr = unserialize($_COOKIE['user']);
					?>
						<div class="personal-area">
							<a  href="personal_area.php">
								<img class="userimg" src="<?=$cook_arr['imgpath']?>" alt="Ico">
								<div class="user-name"><?=$cook_arr['name']?></div>
							</a>
						</div>
						
					<?php endif; ?>
				</div>
			</div>
			<div class="nav-panel">
				<ul>
					<li><a class="nav-link" href="#">О НАС</a></li>
					<li><a class="nav-link" href="#">ОТЗЫВЫ</a></li>
					<li><a class="nav-link" href="rooms.php">НОМЕРА</a></li>
					<li><a class="nav-link" href="#">ФОТОГАЛЕРЕЯ</a></li>
					<li><a class="nav-link" href="#">БРОНИРОВАНИЕ</a></li>
					<li class="border-none"><a class="nav-link" href="#">КОНТАКТЫ</a></li>
				</ul>
			</div>
		</nav>
	</header>