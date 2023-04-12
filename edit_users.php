<?php
session_start();
require_once ('conexion.php'); 

$id = $_GET['id'];

$query = $conn->query('SELECT * FROM users WHERE id = ' . $id.' LIMIT 1');
$row = $query->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Actualizar Usuario</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" type="image/png" href="/assets/img/favicon.store2.png"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="js/main.js" ></script>
</head>
<body>
	<!-- notificaciones y logout navbar.php -->
	<?php require('navigation/navbar.php')?>	
	
	<!-- navLateral.php -->
	<?php require('navigation/lateralnavbar.php')?> 

	<!-- Contenido de la página -->
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<img src="/assets/img/logo.store.png" alt="logo" width="250px">
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					Editar usuario
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewAdmin" class="mdl-tabs__tab is-active">EDITAR USUARIO</a>
			</div>
			<div class="mdl-tabs__panel  is-active" id="tabNewAdmin">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								EDITAR Usuario
							</div>
							<div class="full-width panel-content">
								<form action="process_edit_user.php" method="POST" >
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Datos de usuario</h5>
											<input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />

											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input name="name" 
												class="mdl-textfield__input" 
												type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" 
												id="NameAdmin" value="<?php echo $row["name"]; ?>">
												<label class="mdl-textfield__label" for="NameAdmin">Nombre</label>
												<span class="mdl-textfield__error">Nombre inválido</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input name="lastname" 
												class="mdl-textfield__input" 
												type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" 
												id="LastNameAdmin" value="<?php echo $row["lastname"]; ?>">
												<label class="mdl-textfield__label" for="LastNameAdmin">Apellidos</label>
												<span class="mdl-textfield__error">Apellido inválido</span>
											</div>
												<!-- select de id  -->
												<div class="mdl-textfield mdl-js-textfield">
													<h5>Selecciona un rol</h5>
													<select name="role_id" class="mdl-textfield__input">
														<?php
                                                            $query=$conn->query('SELECT id, name FROM roles');
														?>
														<?php foreach($query->fetchAll() as $role): ?>
															<option 
                                                            value="<?php echo $role['id'] ?>" 
                                                            <?php if ($role['id'] == $row['role_id']) echo "selected"; ?>>
																<?php echo $role['name'] ?>
															</option>
														<?php endforeach; ?>
													</select>
												</div><!-- select de id  -->
										</div>
          
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Detalles de cuenta de usuario</h5>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input  name="username"
												class="mdl-textfield__input" 
												type="text" 
												pattern="-?[A-Za-z0-9áéíóúÁÉÍÓÚ]*(\.[0-9]+)?" 
												id="UserNameAdmin" 
												value="<?php echo $row["username"]; ?>">
												<label class="mdl-textfield__label" for="UserNameAdmin">Nombre de usuario</label>
												<span class="mdl-textfield__error">Nombre de usuario inválido</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input name="password" 
												type="password" 
												 class="mdl-textfield__input" />
												<label class="mdl-textfield__label" for="passwordAdmin">Contraseña</label>
												<span class="mdl-textfield__error">Contraseña inválida</span>
											</div>
											<h5 class="text-condensedLight">Selecciona tu imagen de Perfil</h5>

											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
												<input type="radio" 
                                                    name="avatar"
                                                    id="option-1" 
                                                    class="mdl-radio__button" 
                                                    value="avatar-male.png"
                                                    <?php if ('avatar-male.png' == $row["avatar"]) echo 'checked'; ?> />
												<img src="assets/img/avatar-male.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Perfil 1</span>
											</label>
											<br><br>

											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
												<input type="radio" 
                                                name="avatar"
                                                id="option-2" 
                                                class="mdl-radio__button"  
                                                value="avatar-female.png"
                                                <?php if ('avatar-female.png' == $row["avatar"]) echo 'checked="checked"'; ?> />
												<img src="assets/img/avatar-female.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Perfil 2</span>
											</label>
											<br><br>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
												<input type="radio"
                                                name="avatar"
                                                id="option-3" 
                                                class="mdl-radio__button"  
                                                value="avatar-male2.png"
                                                <?php if ('avatar-male2.png' == $row["avatar"]) echo 'checked'; ?> />
												<img src="assets/img/avatar-male2.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Perfil 3</span>
											</label>
											<br><br>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
												<input type="radio"  
                                                name="avatar"
                                                id="option-4" 
                                                class="mdl-radio__button"
                                                value="avatar-female2.png"
                                                <?php if ('avatar-female2.png' == $row["avatar"]) echo 'checked'; ?> />
												<img src="assets/img/avatar-female2.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Perfil 4</span>
											</label>
										</div>
									</div>
									<p class="text-center">
                                    <button type="submit" value="edit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                          Actualizar
                                    </button>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>