<?php get_header(); ?>


<section class="headline headline__news-single">
    <div class="headline__logo-corner">
        <img src="<?php echo get_template_directory_uri() . '/assets/img/logo/corner.svg'; ?>" alt="">
        <a href="<?php echo home_url('/'); ?>"></a>
    </div>
</section>

<div class="post__image">
	<img class="lazy" data-src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
	<div class="post__image-des_1"></div>
	<div class="post__image-des_2"></div>
    <div class="post__image-des_3"></div>
</div>

<div class="article-wrapper">
	<div class="article">
		<div class="article-des_1"></div>
		<article>
			<div class="post__cat">
				<?php foreach (get_the_category() as $cat): ?>
					<span><?php echo $cat->name; ?></span>
				<?php endforeach; ?>
			</div>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
		<div class="post__share">
			<span>share</span>
			<ul>
                <li>
                    <a href="#" class="share_fb">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/news/icon-fb.svg'; ?>" alt="share facebook">
                    </a>
                </li>
                <li>
                    <a href="#" class="share_tw">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/news/icon-tw.svg'; ?>" alt="share twitter">
                    </a>
                </li>
                <li>
                    <a href="#" class="share_in">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/news/icon-in.svg'; ?>" alt="share linkedin">
                    </a>
                </li>
            </ul>
		</div>
	</div>
</div>

<?php get_footer(); ?>