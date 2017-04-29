<div class="row sheet">
	<div class="cover">
		<img src="<?php echo $coverImage['sizes']['large']; ?>" alt="<?php echo $post->post_title; ?>" />
	</div>

	<div class="col-sm-12 col-md-12 content">
		<h2 class="title"><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
</div>