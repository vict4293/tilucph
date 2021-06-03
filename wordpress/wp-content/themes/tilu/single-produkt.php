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
                        <button class=" col3 tilbage"><img src="http://victorialoekke.dk/kea/tilbage.png"></button>

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

        document.querySelector(".pris").innerHTML = produkt.pris.rendered + " kr";

        document.querySelector(".storrelse").innerHTML = produkt.strrelse.rendered;

        document.querySelector(".type").innerHTML = produkt.produkttype.rendered;

        document.querySelector(".billede2").src = produkt.billede[1].guid;

        document.querySelector(".billede3").src = produkt.billede[2].guid;

        document.querySelector(".billede4").src = produkt.billede[3].guid;
    }
    //   add event listener to alle billdederne
    document.querySelector(".billede2").addEventListener("click", andenBillede);

    document.querySelector(".billede3").addEventListener("click", trejdeBillede);

    document.querySelector(".billede4").addEventListener("click", fjerdeBillede);
    //hvis klikked er på billedet så skipter den plads med billede1
    function andenBillede() {
        console.log("anden billede");

        document.querySelector(".billede1").src = produkt.billede[1].guid;
        document.querySelector(".billede2").src = produkt.billede[0].guid;
    }

    function trejdeBillede() {
        console.log("3 billede");

        document.querySelector(".billede1").src = produkt.billede[2].guid;
        //        document.querySelector(".billede3").src = produkt.billede[0].guid;
    }

    function fjerdeBillede() {
        console.log("4 billede");

        document.querySelector(".billede1").src = produkt.billede[3].guid;
        //        document.querySelector(".billede4").src = produkt.billede[0].guid;
    }
    document.querySelector(".tilbage").addEventListener("click", tilbageTilProdukter);

    function tilbageTilProdukter() {
        console.log("tilbageTilProdukter")
        history.back();
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

</script>


<?php
get_footer();
