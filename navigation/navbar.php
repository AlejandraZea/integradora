<?php 
session_start();//iniciar sesion
?>
<!-- barra superior de notificaciones  -->
	<!-- logout navbar -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					<li class="btn-exit" id="btn-exit">
						<i class="zmdi zmdi-power"></i>
						<div class="mdl-tooltip" for="btn-exit">Salir</div>
					</li>
					<li class="text-condensedLight noLink" ><small><?php echo $_SESSION['user']['name'] . " " . $_SESSION['user']['lastname']; ?></small></li>
					<li class="noLink">
						<figure>
						<?php
							if(empty($_SESSION['user']['avatar'])){
								echo '<i class="zmdi zmdi-account mdl-list__item-avatar"></i>';

							}else{
								echo '<img src="/assets/img/'. $_SESSION['user']['avatar'] .'" width="50px">';
							}
						?>
						</figure>
					</li>
				</ul>
			</nav>
		</div>
	</div>

