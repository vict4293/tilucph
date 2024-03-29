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
        <section id="singleProdukt">
            <div class="tilbage_knapp_container">
                <button class=" tilbage"><img src="http://victorialoekke.dk/kea/tilbage.png"></button>
            </div>
            <article class="indhold">
                <div class="col1">
                    <h1 class="titel"></h1>
                    <div class="box_container">
                        <div class="box">
                            <p>Pris</p>
                            <p class="pris venstre"></p>
                        </div>
                        <div class="box">
                            <p>Størrelse</p>
                            <p class="storrelse venstre"></p>
                        </div>
                        <div class="box">
                            <p>Type</p>
                            <p class="type venstre"></p>
                        </div>
                    </div>
                    <div class="col3_container">


                        <button class=" col3 tilfoj"><img src="http://victorialoekke.dk/kea/tilfoj.png" alt="tilfoj"></button>
                    </div>
                </div>
                <div class="col">
                    <img src="" alt="" class="billede1">
                    <div class="col2">
                        <img src="" alt="" class="billede2"><img src="" alt="" class="billede3"><img src="" alt="" class="billede4">
                    </div>
                </div>

            </article>
        </section>
    </main>
    <!-- #site-content -->
</div>
<!-- #primary -->









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
        console.log("getJason");
        const data = await fetch(dbUrl);
        produkt = await data.json();

        //        let jsonData3 = await fetch("http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/produkt?categories=" + mereSomDette);
        // mereSom = await jsonData3.json();

        visProdukt();
        //			visMere();
    }

    function visProdukt() {
        console.log("vis produkt");
        console.log(produkt.billede.guid);

        document.querySelector(".billede1").src = produkt.billede[0].guid;
        document.querySelector(".titel").textContent = produkt.title.rendered;

        document.querySelector(".pris").innerHTML = produkt.pris + " kr";

        document.querySelector(".storrelse").innerHTML = produkt.strrelse;

        document.querySelector(".type").innerHTML = produkt.produkttype;

        document.querySelector(".billede2").src = produkt.billede[1].guid;

        document.querySelector(".billede3").src = produkt.billede[2].guid;

        document.querySelector(".billede4").src = produkt.billede[3].guid;
    }
    //foto album
    // sætter eventlistener to all the small images in col2

    document.querySelectorAll(".col .col2 img").forEach(img => {
        img.addEventListener("click", imgKlik);

    })
    //tempSrc er billedet i store pladsen
    // hvis de er klikket på de små billede bytter de plads med tempSrc og this er pladsen hvor de små billede liggede for og den bliver skipted ud med den store billede "tempScr"
    function imgKlik() {
        console.log("Klik", this);
        let tempSrc = document.querySelector(".billede1").src;

        document.querySelector(".billede1").src = this.src;
        this.src = tempSrc;
    }
    //tilbage knap
    document.querySelector(".tilbage").style.display = "block";
    document.querySelector(".tilbage").addEventListener("click", tilbageTilProdukter);

    function tilbageTilProdukter() {
        console.log("tilbageTilProdukter")
        history.back();
    }
    //tilbage knap

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

</script>


<?php
get_footer();
