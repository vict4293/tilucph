<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

?>
	<html>

	<body>


		<div>
			<!-- #content -->

			<head>
				<meta name="viewport" content="width=device-width, initial-scale=1" />
			</head>
			<footer id="colophon" class="site-footer">


				<div id="footer-wrapper">
					<div class="col1">
						<form>
							<h3>TILMELD NYHEDSBREVE</h3>
							<p>Hold dig opdateret på det nyeste</p>
							<label for="email">E-mail</label>
							<input id="email" name="email" type="email">
							<button>Tilmeld</button>
						</form>
					</div>

					<div class="col2">
						<a href="https://www.instagram.com/tilucph/?hl=da">@tilucph</a>
						<br> <a href="mailto:Info@tilucph.dk">Info@tilucph.dk</a>
						<br> <a href="tel:+4528441900">+45 28 44 19 00</a>
						<br> <a href="http://www.victorialoekke.dk/kea/tilu/wordpress/forsendelse-og-retur/">Forsendelse og retur</a>
					</div>
				</div>

			</footer>
			<!-- #colophon -->

		</div>
		<!-- #page -->

		<?php wp_footer(); ?>

	</body>

	</html>
