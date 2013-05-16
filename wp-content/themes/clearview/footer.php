<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the class=container div and all content after
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */
?>
	<div class="footer-wrapper">
			<div id="footer" class="row" role="contentinfo">
				<div class="nine columns">
					<p class="footer-credits">Clearview Wealth Management is a registered investment advisor with the Securities Exchange Commission. &nbsp;&nbsp;|&nbsp;&nbsp;  <a class="privacy-policy" href="privacy-policy">Privacy Policy</a></p>
					<p class="footer-copyright">Copyright 2013, All Rights Reserved. &nbsp;&nbsp;|&nbsp;&nbsp; PO Box 9384 &nbsp;&nbsp;|&nbsp;&nbsp; Charlotte, NC  28299 &nbsp;&nbsp;|&nbsp;&nbsp; (704) 837-4317 &nbsp;&nbsp;|&nbsp;&nbsp; <a href="mailto:clearview@cvwmgmt.com?subject=feedback" "email us">clearview@cvwmgmt.com</a></p>
				</div>
				<div class="three columns">
					<a class="button" href="http://visitor.r20.constantcontact.com/manage/optin/ea?v=001S9i1fVV620XwP4OFlEf8iR2dLoi5TllFtYUlIwBKOSAQQzcdefqVI2rUC-JLDx8HxUVf8bp8pqrgP03zATndkQ%3D%3D">Sign Up For Our Newsletter</a>
				</div>
			</div>

	</div><!-- End Footer Wrapper -->
	
	<div class="row">
		<div class="twelve columns">
			<div class="footer-logos">
					<a href="http://www.fpanet.org/" title="FPA" target="_blank" ><img class="fpa" src="<?php echo get_stylesheet_directory_uri(); ?>/images/fpa-logo.png" alt=""></a>
					<a href="http://www.napfa.org/" title="NAPFA" target="_blank" ><img class="napfa" src="<?php echo get_stylesheet_directory_uri(); ?>/images/napfa-logo.gif" alt=""></a>
			</div>
		</div>
	</div>


	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
	     chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7]>
		<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

	<?php wp_footer(); ?>
</body>
</html>
