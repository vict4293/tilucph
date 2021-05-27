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



			<section id="kollektion-container"></section>


			<script>
				let kollektioner = [];
				let categories;
				let filterKollektioner = "alle";

				const skabelon = document.querySelector("template");
				const alleKollek = document.querySelector("#kollektion-oversigt");
				const url = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/kollektioner?per_page=100";
				const caturl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/categories";


				document.addEventListener("DOMContentLoaded", start)

				function start() {
					console.log("start");
					getJson();
				}

				async function getJson() {
					const data = await fetch(url);
					const catdata = await fetch(caturl);
					kollektioner = await data.json();
					categories = await catdata.json();

					console.log(categories);
					visKollektioner();
					opretknapper();
				}

				function opretknapper() {

					categories.forEach(cat => {
						document.querySelector("#filtrering").innerHTML += `<button class="filter" data-genre="${cat.id}">${cat.name}</button>`

					})

					addEventListenersToButtons();
				}

				function addEventListenersToButtons() {
					document.querySelectorAll("#filtrering button").forEach(elm => {
						elm.addEventListener("click", filtrering);
					})
					console.log("clickknap");
				};

				function filtrering() {
					filterPodcast = this.dataset.genre;
					console.log(filterPodcast);
					visPodcasts();
				}




				function visPodcasts() {
					console.log("visPodcasts");
					allePods.innerHTML = "";
					podcasts.forEach(podcast => {
							if (filterPodcast == "alle" || podcast.categories.includes(parseInt(filterPodcast))) {
								let klon = skabelon.cloneNode(true).content;
								console.log(klon);
								klon.querySelector(".container img").src = podcast.billede.guid;
								klon.querySelector("h3").textContent = podcast.title.rendered;
								klon.querySelector("article").addEventListener("click", () => {
									location.href = podcast.link;
								})
								allePods.appendChild(klon);
							}
						} //tuborg fra if sætning lukke
					)
				}

			</script>

		</main>
		<!-- #main -->
	</div>
	<!-- #primary -->

	<?php
get_footer();
