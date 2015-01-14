<?php  
/**
 * The template for displaying the footer.
 *
 * @package classPlus
 */
?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="footer-area">
		<div class="footer-nav clearfix">
			<?php  
				dynamic_sidebar( 'sidebar-footer' );
			?>
		</div>
		<!-- END .footer-area -->
		<div class="site-info">
			<span class="copyright"><?php echo get_theme_mod( 'classplus_copyright', '&copy; 2014 20theme.' ); ?></span>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->
</div>
<!-- END .site -->
<?php wp_footer(); ?>
</body>
</html>