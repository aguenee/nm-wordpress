<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<!--<div class="site-info"></div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

<script type="text/javascript">
	$(document).ready(function() {
	    // Masonry
	    $('.grid').masonry({
	        itemSelector: '.grid-item'
	    });

	    // Loader
	    $('select').change(function() {
	    	$('.loader').removeClass('hidden');
	    });

	    // Sorting
    	$('form.sorting > select').change(function() {
			$('form.sorting').submit();
		});

	    // Section "accordion style"
		$('.section-title').click(function() {
		    var section = $(this).parent();

		    if ( section.hasClass('section-disabled') ) {
		        return;
		    }

		    $(this).parent().toggleClass('section-open');
		});
	});
</script>

</body>
</html>
