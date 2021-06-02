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
		<article class="kollektion">
			<img src="" alt="" class="billede">
			<h2 class="titel"></h2>
		</article>
	</template>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<nav id="filtrering">
				<button data-genre="alle">Alle</button>
			</nav>

			<section id="kollektion-oversigt"></section>
		</main>
		<!-- #main -->
	</div>
	<!-- #primary -->


	<script>
		let kollektioner;
		let categories;
		let filterKollektion = "alle";

		//Henter data gennem WP rest API url med fetch funktion//
		const dburl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/kollektion?per_page=100";
		const caturl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/categories";


		//Når alt content på siden er loaded sætter vi functionen start igang og henter json//
		document.addEventListener("DOMContentLoaded", start);

		function start() {
			getJson();
		}

		async function getJson() {
			const data = await fetch(dburl);
			const catdata = await fetch(caturl);
			kollektioner = await data.json();
			categories = await catdata.json();
			console.log(categories);
			visKollektioner();
			opretKnapper();
		}

		function opretKnapper() {
			categories.forEach(cat => {
				document.querySelector("#filtrering").innerHTML += `<button class="filter" data-kollektion="${cat.id}">${cat.name}</button>`

			})

			addEventListenersToButtons();
		}

		function addEventListenersToButtons() {
			document.querySelectorAll("#filtrering button").forEach(elm => {
				elm.addEventListener("click", filtrering);
			})
		};

		function filtrering() {
			filterKollektion = this.dataset.kollektion;
			visKollektioner();
		}

		//Viser produkterne gennem et forEach loop//
		function visKollektioner() {
			let temp = document.querySelector("template");
			let container = document.querySelector("#kollektion-oversigt");
			container.innerHTML = "";
			kollektioner.forEach(kollektion => {
				if (kollektion.categories.includes(parseInt(filterKollektion))) {
					let klon = temp.cloneNode(true).content;

					klon.querySelector(".titel").textContent = kollektion.title.rendered;

					klon.querySelector("img").src = kollektion.billede[0].guid;

					klon.querySelector("article").addEventListener("click", () => {
						location.href = kollektion.link;
					})
					container.appendChild(klon);
				}
			})
		}

		getJson();

	</script>

	<?php
get_footer();
