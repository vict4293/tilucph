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

        <article id="indhold">

            <h1></h1>



            <img src="" alt="" class="billede">
            <h1 class="titel"></h1>
            <p class="beskrivelse"></p>

            <button id="knap">Tilbage</button>

        </article>
    </main>
    <!-- #site-content -->
</div>
<!-- #primary -->


<script>
    let produkter;
    let aktuelprodukt = <?php echo get_the_ID() ?>;

    const dbUrl = "http://victorialoekke.dk/kea/tilu/wordpress/wp-json/wp/v2/produkt?per_page=100" + aktuelprodukt;
    const container = document.querySelector("#indhold");

    document.addEventListener("DOMContentLoaded", getJSON);

    async function getJSON() {
        const data = await fetch(dbUrl);
        produkt = await data.json();

        visProdukt();
    }

    function visProdukt() {
        console.log(produkt.title.rendered);
        document.querySelector(".titel").innerHTML = produkt.title.rendered;
        document.querySelector(".billede").src = produkt.billede.guid;
        document.querySelector("#knap").addEventListener("click", tilbageTilProdukter);
    }

    function tilbageTilProdukter() {
        history.back();
    }

</script>


<?php
get_footer();
