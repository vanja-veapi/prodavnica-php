<?php
    // session_start();
?>
<div class="container pt-5">
    <div class="row d-flex justify-content-between mt-4">
            <?php @$korisnik = $_SESSION['korisnik'];?>
        <select id="kategorije" name="kategorije" class="form-select p-3">
            <option value="selected" selected>Izaberi kategoriju</option>
            <?php
                $kategorije = vratiSve("kategorije");
                foreach($kategorije as $kategorija)
                {
                    echo "<option value='$kategorija->idKategorije'>$kategorija->naziv</option>";
                }
            ?>
        </select>
        <select id="sort" name="kategorije" class="form-select p-3">
            <option value="ASC">Rastuće</option>
            <option value="DESC">Opadajuće</option>
        </select>
        <input type="hidden" id="korisnikId" value="<?=@$korisnik->idKorisnik?>"/>
    </div>
    <div id="proizvodi" class="row mt-4">
        <!-- <div id="shop" class="w-100 d-flex"> -->
            <!-- <div class="col-lg-4 border shadow rounded pt-3 pb-3 ">
                <div class="img border shadow mb-3">
                    <img src="assets/images/shop/ACER-Aspire.png" alt="ACER" class="img-fluid"/>
                </div>
                <p class="mb-2">Naziv: Laptop</p>
                <p class="mb-2">Cena: 400e</p>
                <p class="mb-2">Boja: crna</p>
                <p class="mb-4 mt-4">Opis lorem ipsum ide gas majku ti tvoj, crni gruja, komunizam i renesansa</p>
                <input type="button" value="Add to cart" class="btn btn_cart"/>
            </div> -->
            <?php
                if($conn)
                {
                    $proizvodi = prikaziSveProizvode();
                    ispisiSveProizvode($proizvodi);
                }
            ?>
        <!-- </div> -->
    </div>
</div>