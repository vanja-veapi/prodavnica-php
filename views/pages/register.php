<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<div class="container">
    <div class="row mb-3">
        <p class="h1">Registracija</p>
    </div>
    <div class="row">
        <form action="" id="registracija" method="POST" class="form-check">
            <label class="h5">Ime *</label>
            <p id="imeGreska" class="invisible mb-2">Ime nije napisano u dobrom formatu</p>
            <input type="text" id="ime" name="ime" class="form-control" placeholder="Ime"/>

            <label class="h5 mt-3">Prezime *</label>
            <p id="prezimeGreska" class="invisible mb-2">Ime nije napisano u dobrom formatu</p>
            <input type="text" id="prezime" name="prezime" class="form-control" placeholder="Prezime"/>

            <label class="h5 mt-3">Mail *</label>
            <p id="mailGreska" class="invisible mb-2">Ime nije napisano u dobrom formatu</p>
            <input type="text" id="mail" name="mail" class="form-control" placeholder="Mail"/>

            <label class="h5 mt-3">Lozinka *</label>
            <p id="lozinkaGreska" class="invisible mb-2">Ime nije napisano u dobrom formatu</p>
            <input type="password" id="lozinka" name="lozinka" class="form-control" placeholder="Lozinka"/>

            <label class="h5 mt-3">Pol *</label>
            <div class="form-check">
                <input type="radio" name="pol" class="form-check-input" value="1"/><label class="form-check-label">Muški</label>
            </div>
            <div class="form-check">
                <input type="radio" name="pol" class="form-check-input" value="2"/><label class="form-check-label">Ženski</label>
            </div>
            <input type="button" id="btnRegister" name="btnRegister" value="Registruj se" class="btn btn-success mt-4"/>
        </form>
        <div id="obavestenje"></div>
    </div>
</div>