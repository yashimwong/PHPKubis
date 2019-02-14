<?php require APP_ROOT . "/views/inc/header.php"; ?>

<div class="row">
	<div class="col-md-6 mx-auto">
		<div class="card card-body bg-light mt-5">
			<h2>Login</h2>
			<p>Please enter your credentials to login.</p>

			<form action="<?php echo URL_ROOT; ?>/users/register" method="post">

				<div class="form-group">
					<label for="email">Email: </label>
					<input type="email" name="email" class="form-control form-control-lg 
					<?php echo (!empty($data['email_error'])) ? 'is_invalid' : ''; ?>" 
					value="<?php echo $data['email_error']; ?>">
					<span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
				</div>

				<div class="form-group">
					<label for="username">Password: </label>
					<input type="password" name="password" class="form-control form-control-lg 
					<?php echo (!empty($data['password_error'])) ? 'is_invalid' : ''; ?>" 
					value="<?php echo $data['password_error']; ?>">
				</div>

				<div class="row">
					<div class="col">
						<input type="submit" value="Login" class="btn btn-success btn-block">
					</div>
					<div class="col">
						<a href="<?php echo URL_ROOT; ?>/users/register" class="btn btn-light btn-block">Don't have an account? Register here.</a>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>


<?php require APP_ROOT . "/views/inc/footer.php"; ?>
