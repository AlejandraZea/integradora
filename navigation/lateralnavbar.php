<?php 
session_start();
?>
<!-- navLateral.php -->
<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> Control Interno
			</div>
			<figure class="full-width" style="height: 77px;">
				<div class="navLateral-body-cl">
				<?php
					if(empty($_SESSION['user']['avatar'])){
						echo '<i class="zmdi zmdi-account mdl-list__item-avatar"></i>';

					}else{
						echo '<img src="/assets/img/'. $_SESSION['user']['avatar'] .'" width="50px">';
					}
				?>
				</div>
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span>
						<?php echo $_SESSION['user']['name'] . " " . $_SESSION['user']['lastname']; ?> <br>
						<small><?php echo $_SESSION['user']['role_id']; ?></small>
					</span>
				</figcaption>
			</figure>
			<div class="full-width tittles navLateral-body-tittle-menu">
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; PANEL DE CONTROL</span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">
					<li class="full-width">
						<a href="home.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INICIO
							</div>
						</a>
					</li>
					<!-- seccion de tickets -->
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="tickets.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-shopping-basket"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								TICKETS
							</div>
						</a>
					</li> 
					
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="admin.php" class="full-width ">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-face"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								USUARIOS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
						</ul>
					</li>

					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-case"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								ADMINISTRACIÓN
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
						
							<li class="full-width">
								<a href="providers.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										PROVEEDORES
									</div>
								</a>
							</li>       

							<li class="full-width">
								<a href="categories.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										CATEGORIAS
									</div>
								</a>
							</li>
						</ul>
					</li>


					

					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="products.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-washing-machine"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PRODUCTOS
							</div>
						</a>
					</li>
					<!-- seccion de ventas -->
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="sales.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								VENTAS
							</div>
						</a>
					</li> 

					<!-- seccion de inventarios -->
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="inventory.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-store"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INVENTARIOS
							</div>
						</a>
					</li> 
				</ul>
			</nav>
		</div>
	</section>