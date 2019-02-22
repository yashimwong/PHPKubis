<?php require APP_ROOT . "/views/inc/header.php"; ?>
		<a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i>Back</a>
		<div class="card card-body bg-light mt-5">
			<h2>Edit Post</h2>
			<p>You are currenlty editing Post titled <strong>[ <?php echo $data['title']; ?> ]</strong></p>

			<form action="<?php echo URL_ROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">

				<div class="form-group">
					<label for="title">Title: </label>
					<input type="text" name="title" class="form-control form-control-lg 
					<?php echo (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" 
					value="<?php echo $data['title']; ?>">
					<span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
				</div>

				<div class="form-group">
					<label for="body">Text Body: </label>
					<textarea name="body" class="form-control form-control-lg 
					<?php echo (!empty($data['body_error'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
					<span class="invalid-feedback"><?php echo $data['body_error']; ?></span>
				</div>

					<div class="col">
						<input type="submit" value="Submit Post" class="btn btn-success btn-block">
					</div>
			</form>

		</div>


<?php require APP_ROOT . "/views/inc/footer.php"; ?>
