<?php
/*
Template Name: Home
*/
?>


<?php get_header(); ?>
<?php if(ot_get_option( 'feature_image_1' ) != ''){ ?>
<script class="secret-source">
        jQuery(document).ready(function($) {
          $('.feature').bjqs({
            height      : 410,
            width       : 960,
            responsive  : true,
            showmarkers : false,
            usecaptions : false,
            animtype : 'slide',
            randomstart :false
          });
        });
</script>
<div class="feature">
	<ul class="bjqs">
		<li><img src="<?php echo ot_get_option( 'feature_image_1' ); ?>"/><p><?php echo ot_get_option( 'feature_text_1' ); ?></p></li>
		<?php if(ot_get_option( 'feature_image_2' ) != ''){ ?><li><img src="<?php echo ot_get_option( 'feature_image_2' ); ?>"/><p><?php echo ot_get_option( 'feature_text_2' ); ?></p></li><?php } ?>
		<?php if(ot_get_option( 'feature_image_3' ) != ''){ ?><li><img src="<?php echo ot_get_option( 'feature_image_3' ); ?>"/><p><?php echo ot_get_option( 'feature_text_3' ); ?></p></li><?php } ?>
		<?php if(ot_get_option( 'feature_image_4' ) != ''){ ?><li><img src="<?php echo ot_get_option( 'feature_image_4' ); ?>"/><p><?php echo ot_get_option( 'feature_text_4' ); ?></p></li><?php } ?>
		<?php if(ot_get_option( 'feature_image_5' ) != ''){ ?><li><img src="<?php echo ot_get_option( 'feature_image_5' ); ?>"/><p><?php echo ot_get_option( 'feature_text_5' ); ?></p></li><?php } ?>
	</ul>
	
</div>
<?php } ?>
<div id="content">
	<div class="info">
		<?php get_template_part( 'loop', 'index' ); ?>
		</div>

		<div class="work">
		<h2><span style="background-color:<?php echo ot_get_option( 'main_colour' ); ?>;">Our Work</span></h2>
		<ul>
		<?php
		$args = array( 'post_type' => 'work', 'posts_per_page' => 3 );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			echo '<li>';			
			echo '<a href="';
			the_permalink();
			echo '" alt="">';
			echo '<div class="overlay" style="background-color:'.ot_get_option( 'main_colour' ).';"></div>';
			the_post_thumbnail('flozo-thumb');			
			echo '<h3 style="border-bottom:2px solid '.ot_get_option( 'main_colour' ).';">';
			the_title();
			echo '</h3>';
			echo limit_words(get_the_excerpt(), '30');
			echo '...</a>';
			echo '</li>';
		endwhile;
		?>
		</ul>
		</div>
		
		<div class="blog">
		<h2><span>Our Blog</span></h2>
		<ul>
		<?php
		if (is_page()) {
		 
		  $posts = get_posts ("cat=$cat&showposts=3");
		  if ($posts) {
		    foreach ($posts as $post):
		      setup_postdata($post); ?>
		      <li><h3><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3><p class="date"></p><?php the_time("j M Y"); ?><p><?php the_excerpt(); ?></p></li>
		    <?php endforeach;
		  }
		}
		
		?>
		</ul>
		</div>
		
		
	</div>
<?php get_footer(); ?>