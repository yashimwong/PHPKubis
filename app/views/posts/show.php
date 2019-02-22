<?php require APP_ROOT . "/views/inc/header.php"; ?>
<a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i>Back</a>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<p><?php echo $data['post']->body; ?></p>
<hr>
<div class="bg-secondary text-white p-2 mb-3">
	Written by <?php echo $data['user']->username; ?> on <?php echo $data['post']->created_at; ?>
	</div>

<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
	<h2>
		<a href="<?php echo URL_ROOT;?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark"> Edit Post </a>
		<form class="float-right" action="<?php echo URL_ROOT; ?>/posts/delete/<?php echo $data['post']->id ?>" method="post">
			<input type="submit" value="Delete" class="btn btn-danger">
		</form>
<?php endif; ?>

<?php require APP_ROOT . "/views/inc/footer.php"; ?>