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

	<template>
		<article class="produkt">
			<img src="" alt="" class="billede">
			<h2 class="titel"></h2>
		</article>
	</template>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">



			<section id="produkt-oversigt"></section>


			<script>
				let produkter = [];
				let filterProdukt = "alle";

				const oversigt = document.querySelector("#produkt-oversigt");
				const skabelon = document.querySelector("template");

				//Henter data gennem WP rest API url med fetch funktion//
				const url = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/produkt?per_page=100";
				const caturl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/categories";


				//Når alt content på siden er loaded sætter vi functionen start igang og henter json//
				document.addEventListener("DOMContentLoaded", start);

				function start() {
					getJson();
				}


				async function getJson() {
					const data = await fetch(url);
					const catdata = await fetch(caturl);
					produkter = await data.json();
					categories = await catdata.json();
					console.log(categories);
					visProdukter();
					opretKnapper();
				}

				function opretKnapper() {
					categories.forEach(cat => {
						document.querySelector("#filtrering").innerHTML += `<button class="filter" data-kategori="${cat.id}">${cat.name}</button>`

					})

					addEventListenersToButtons();

				}


				//Viser produkterne gennem et forEach loop//
				function visProdukter() {
					console.log(produkter);
					produkter.forEach(produkt => {
						const klon = skabelon.cloneNode(true).content;
						klon.querySelector(".titel").textContent = produkt.title.rendered;
						klon.querySelector(".billede").src = produkt.billede.guid;
					})
				}

			</script>
		</main>
		<!-- #main -->
	</div>
	<!-- #primary -->

	<?php
get_footer();
