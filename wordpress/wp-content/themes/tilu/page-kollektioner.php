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
        <p class="pris"></p>
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
    const caturl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/categories?per_page=100";


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
    let menuBilleder = ["http://www.victorialoekke.dk/kea/tilu/wordpress/wp-content/uploads/2021/06/DSC01374-scaled.jpg", "http://www.victorialoekke.dk/kea/tilu/wordpress/wp-content/uploads/2021/06/DSCF3102-scaled.jpg", "http://www.victorialoekke.dk/kea/tilu/wordpress/wp-content/uploads/2021/06/DSC01326-scaled.jpg", "http://www.victorialoekke.dk/kea/tilu/wordpress/wp-content/uploads/2021/06/DSC01246-scaled.jpg"]

    function opretKnapper() {
        console.log("opret knapper");

        //Oppretter knapper med data produkt fra hvert og et cat.id og skrever navned på knappen
        let index = 0;
        categories.forEach((cat) => {
            if (cat.id >= 11 && cat.id <= 15) {
                document.querySelector("#filtrering").innerHTML += `<img src="${menuBilleder[index]}" alt="" ><button class="filter" data-produkt="${cat.id}">${cat.name}</button>`
                index++;
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


    /*  let catName;

      switch (cat.id) {
          case 12:
              catName = 'simple'
              break;
          case 13:
              catName = 'nordisk'
              break;
          case 14:
              catName = 'minimalsistik'
              break;
          default:
              catName = 'quad'
              break;

              var simple = document.createElement("IMG");*/

    function addEventListenersToButtons() {
        document.querySelectorAll("#filtrering button").forEach(elm => {
            elm.addEventListener("click", filtrering);
        })
    };

    function filtrering() {
        console.log("filtering");
        filterProdukt = this.dataset.produkt;
        visProdukter();
    }

    //Viser produkterne gennem et forEach loop//
    function visProdukter() {
        console.log("vis produkter");
        let temp = document.querySelector("template");
        let container = document.querySelector("#produkt-oversigt");
        container.innerHTML = "";
        produkter.forEach(produkt => {
            if (produkt.categories.includes(parseInt(filterProdukt))) {
                let klon = temp.cloneNode(true).content;

                klon.querySelector(".titel").textContent = produkt.title.rendered;
                klon.querySelector("p").textContent = produkt.pris + " kr";
                klon.querySelector("img").src = produkt.billede[0].guid;

                klon.querySelector("article").addEventListener("click", () => {
                    location.href = produkt.link;
                })
                container.appendChild(klon);
            }
        })
    }

</script>

<?php
get_footer();
