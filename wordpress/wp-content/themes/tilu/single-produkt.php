<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section id="singleProdukt"></section>
		</main>
		<!-- #site-content -->
	</div>
	<!-- #primary -->


	<article class="indhold">
		<img src="" alt="" class="billede">
		<h1 class="titel"></h1>
		<p class="beskrivelse"></p>

		<button id="knap">Tilbage</button>
	</article>
	<section id="meresom">

		<template id="fleretemp">
			<article class="fleretemp1">
				<div class="container">
					<img src="" alt="" class="mere">
					<div class="mellem">
						<div class="text">
							<p class="meretitel"></p>
							<p class="merebeskrivelse"></p>
						</div>
					</div>
				</div>
			</article>
		</template>
	</section>


	<script>
		let produkt;
		let aktuelprodukt = <?php echo get_the_ID() ?>;
		let mereSomDette;
		let mereSom;


		const dbUrl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/produkt/" + aktuelprodukt;
		const container = document.querySelector(".indhold");

		const flereTemp = document.querySelector("#fleretemp");

		document.addEventListener("DOMContentLoaded", getJSON);

		async function getJSON() {
			const data = await fetch(dbUrl);
			produkt = await data.json();

			let jsonData3 = await fetch("http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/produkt?categories=" + mereSomDette);
			mereSom = await jsonData3.json();

			visProdukt();
			//			visMere();
		}

		function visProdukt() {
			console.log("vis produkt");
			console.log(produkt.billede.guid);
			document.querySelector(".billede").src = produkt.billede[0].guid;
			document.querySelector(".titel").textContent = produkt.title.rendered;
			document.querySelector("#knap").addEventListener("click", tilbageTilProdukter);
		}

		//		function visMere() {
		//
		//			mereSom.forEach(produkt => {
		//				if (aktuelprodukt != produkt.id) {
		//
		//					const klon = flereTemp.cloneNode(true).content;
		//
		//					klon.querySelector(".mere").src = produkt.billede.guid;
		//					klon.querySelector(".meretitel").textContent = produkt.title.rendered;
		//					klon.querySelector(".fleretemp1").addEventListener("click", () => {
		//						location.href = produkt.link;
		//					})
		//					mereTemp.appendChild(klon);
		//				}
		//			})
		//
		//			//episoder skal være mereSom
		//			//episode skal være podcast
		//		}

		function tilbageTilProdukter() {
			history.back();
		}

	</script>


	<?php
get_footer();
