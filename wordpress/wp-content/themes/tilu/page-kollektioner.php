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

        <nav id="filtrering" class="filtering_kollektion">
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
    const dburl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/produkt?per_page=100";
    const caturl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/categories?per_page=100";


    //Når alt content på siden er loaded sætter vi functionen start igang og henter json//
    document.addEventListener("DOMContentLoaded", start);

    function start() {
        console.log("get json");
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
            if (cat.id >= 11 && cat.id <= 15) {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-kollektion="${cat.id}">${cat.name}</button>`
            }
        })


        addEventListenersToButtons();
    }

//    let catName;
  //
  // function simpleBillede() {
  // console.log("simpleBillede");
  // catName = "simple";
  // var simple = document.createElement("IMG");
  // simple.setAttribute("src", "img_pulpit.jpg");
  // }
  // catName = "nordisk";
  // catName = "minimalistisk";
  // catName = "blomster";

    function addEventListenersToButtons() {
        document.querySelectorAll("#filtrering button").forEach(elm => {
            elm.addEventListener("click", filtrering);
        })
    };

    function filtrering() {
        filterKollektion = this.dataset.kollektion;
        visKollektioner;
    }

    //Viser produkterne gennem et forEach loop//
    function visKollektioner() {
        console.log("visKollektioner");
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

</script>

<?php
get_footer();
