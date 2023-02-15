<?php $this->view('includes/header') ?>

		<div class="container-fluid">
			<form method="post">
			<div class="p-4 mx-auto shadow rounded" style="margin-top: 50px;width: 100%; max-width: 340px;">
				<h2 class="text-center">My School</h2>
				<img src="<?= ROOT ?>/assets/logo.png" class="border border-primary d-block mx-auto rounded-circle" style="width: 100px;">
				<h3>Login</h3>
				<!-- Alerts -->
				<?php if (count($errors) > 0): ?>
					<div class="alert alert-warning alert-dismissible fade show p-2" role="alert">
				  	<strong>Errors!</strong>

				  	<?php foreach ($errors as $error): ?>

				  	<br><?= $error; ?>

				  	<?php endforeach; ?>

				  
				  	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>
				<!-- End Alert -->

				<input class="form-control" type="email" value="<?=get_var('email');?>" name="email" placeholder="Email" autofocus>
				<br>
				<input class="form-control" type="password" value="<?=get_var('password');?>" name="password" placeholder="Password">
				<br>
				<button class="btn btn-primary" type="submit">Login</button>
			</div>
		</form>
		</div>

<?php $this->view('includes/footer') ?>
	
