<?php get_header(); ?>
	<div id="content">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="info">
	        <article id="post-<?php the_ID(); ?>" class="primary-content">
	            <header>
	                <h1><?php the_title(); ?></h1>
	                <?php /*?><p class="reading-time">The following <?php echo show_post_word_count(); ?> words should take about <?php echo est_read_time(); ?> to read.</p><?php */?>
	                
	            </header>

		<?php
		// Move this, and only show if there's no gallery
		// the_post_thumbnail('full');
		?>
				
	            <div class="the-content">
	            
					<?php the_content(); ?>
	            </div>
	            
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:' ), 'after' => '</div>' ) ); ?>
	
	
	            <div class="navigation">
	                <span class="older"><?php previous_post_link( '%link', '&larr; %title' ); ?></span> <span class="newer"><?php next_post_link( '%link', '%title &rarr;' ); ?></span>
	            </div>
	    
	            <?php endwhile; // end of the loop. ?>
	        </article>
	    </div> 

<?php get_footer(); ?>