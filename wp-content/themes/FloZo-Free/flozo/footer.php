   

<div id="footer">
	<?php if(ot_get_option( 'about_footer' ) != ''){ ?>
	<div class="col3">
		<h3>About Us</h3>
		<?php echo ot_get_option( 'about_footer' ); ?>
	</div>
	<?php } ?>
	
	<?php if(ot_get_option( 'twitter_handle' ) != ''){ ?>
	<div class="col3">
		<h3>Twitter</h3>
		<div id="twitter-feed"></div>
		<script>loadLatestTweet('<?php echo ot_get_option( 'twitter_handle' ) ?>',3);</script>
	</div>
	<?php } ?>
	<?php if(ot_get_option( 'contact_footer' ) != ''){ ?>
	<div class="col3 last">
		<h3>Contact Us</h3>
		<?php echo ot_get_option( 'contact_footer' ); ?>
	</div>
	<?php } ?>
</div>

<?php wp_footer(); ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo bloginfo('template_directory'); ?>/assets/scripts/jquery-1.7.1.js"%3E%3C/script%3E'))</script>
<script src="<?php echo bloginfo('template_directory'); ?>/assets/scripts/general.js"></script>
<?php if ( is_singular() ) wp_print_scripts( 'comment-reply' ); ?>
</body>
</html>