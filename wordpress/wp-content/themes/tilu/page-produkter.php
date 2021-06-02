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

			<nav id="filtrering">
				<button data-genre="alle">Alle</button>
			</nav>

			<section id="produkt-oversigt"></section>
		</main>
		<!-- #main -->
	</div>
	<!-- #primary -->


	<script>
		let produkter;
		let categories;
		let filterProdukt = "alle";

		//Henter data gennem WP rest API url med fetch funktion//
		const dburl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/produkt?per_page=100";
		const caturl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/categories";


		//Når alt content på siden er loaded sætter vi functionen start igang og henter json//
		document.addEventListener("DOMContentLoaded", start);

		function start() {
			getJson();
		}

		async function getJson() {
			const data = await fetch(dburl);
			const catdata = await fetch(caturl);
			produkter = await data.json();
			categories = await catdata.json();
			console.log(categories);
			visProdukter();
			opretKnapper();
		}

		function opretKnapper() {
			categories.forEach(cat => {
				document.querySelector("#filtrering").innerHTML += `<button class="filter" data-produkt="${cat.id}">${cat.name}</button>`

			})

			addEventListenersToButtons();
		}

		function addEventListenersToButtons() {
			document.querySelectorAll("#filtrering button").forEach(elm => {
				elm.addEventListener("click", filtrering);
			})
		};

		function filtrering() {
			filterProdukt = this.dataset.produkt;
			visProdukter();
		}

		//Viser produkterne gennem et forEach loop//
		function visProdukter() {
			let temp = document.querySelector("template");
			let container = document.querySelector("#produkt-oversigt");
			container.innerHTML = "";
			produkter.forEach(produkt => {
				if (produkt.categories.includes(parseInt(filterProdukt))) {
					let klon = temp.cloneNode(true).content;

					klon.querySelector(".titel").textContent = produkt.title.rendered;

					klon.querySelector("img").src = produkt.billede[0].guid;

					klon.querySelector("article").addEventListener("click", () => {
						location.href = produkt.link;
					})
					container.appendChild(klon);
				}
			})
		}

		getJson();

	</script>
	<?php
get_footer();
