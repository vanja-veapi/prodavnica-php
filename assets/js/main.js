$(document).ready(function(){

    let lokacija = window.location.href;
    let stranica = lokacija.split("/").pop();
    // console.log(stranica);
    if(stranica === "index.php?page=shop")
    {
        let kategorije = document.querySelector("#kategorije");
        
        let sort = document.querySelector("#sort");
        sort.addEventListener("change", function(){
            $.ajax({
                url: "models/sort.php",
                method: "GET",
                dataType: "json",
                // contentType:false,
                // processData: false,
                data: {
                    sort: sort.value,
                    kategorija: kategorije.value
                },
                success: function(result)
                {
                    
                    if(result.length === 0)
                    {
                        let idProizvod = document.querySelector("#idProizvod");
                        if(idProizvod === null)
                        {
                            idProizvod.innerHTML = `<p class="alert alert-danger">Proizvod koji ste uneli ne posotji u našoj bazi.</p>`;
                        }
                    }
                    console.log(result);
                    ispisProizvoda(result);

                    btnCartFunc();
                },
                error: function(xhr)
                {
                    // console.log(xhr);
                }
            });
        });
        kategorije.addEventListener("change", function(){
            console.log(kategorije.value);
            $.ajax({
                url: "models/filter.php",
                method: "GET",
                dataType: "json",
                // contentType:false,
                // processData: false,
                data: {
                    kategorijaPhp: kategorije.value,
                    sortPhp: sort.value
                },
                success: function(result)
                {
                    console.log(result);
                    ispisProizvoda(result);
                    btnCartFunc();
                },
                error: function(xhr)
                {
                    console.log(xhr);
                }
            });
        });

        btnCartFunc();
    }

    if(stranica === "index.php?page=register")
    {
        let ime, prezime, mail, lozinka;
        let btnRegister = document.querySelector("#btnRegister");

        
        btnRegister.addEventListener("click", function(){
            ime = document.querySelector("#ime");
            prezime = document.querySelector("#prezime");
            mail = document.querySelector("#mail");
            lozinka = document.querySelector("#lozinka");
            
            let pol = $("input[name=pol]:checked").val();
            proveraRegistracije(ime, prezime, mail, lozinka, pol);
        });

    }

    if(stranica === "index.php?page=login")
    {
        let mail, lozinka;
        
        let btnLogin = document.querySelector("#btnLogin");
        btnLogin.addEventListener("click", function(){
            mail = document.querySelector("#mail");
            lozinka = document.querySelector("#lozinka");

            proveraLogovanja(mail, lozinka);
        });
    }

    if(stranica === "index.php?page=admin")
    {
        let ime, prezime, lozinka, mail;

        ime = document.querySelector("#ime");
        prezime = document.querySelector("#prezime");
        lozinka = document.querySelector("#lozinka");
        mail = document.querySelector("#mail");
        let pol = document.querySelector("#pol");
        let uloga = document.querySelector("#uloga");

        let btnReg = document.querySelector("#btnDodaj");
        btnReg.addEventListener("click", function()
        {
            proveraUnos(ime, prezime, mail, lozinka, pol, uloga);
        });

        //Obrisi korisnika
        let btnDelete = document.querySelectorAll(".btnDelete");
        for(let i = 0; i < btnDelete.length; i++)
        {
            btnDelete[i].addEventListener("click", function(){
                let idKorisnik = this.name;
                $.ajax({
                    url: "models/brisanje.php",
                    type: "POST",
                    data: {id: idKorisnik},
                    dataType: "json",
                    success: function(result)
                    {
                        console.log(result);
                        btnDelete[i].parentElement.parentElement.remove();
                        alert("Uspesno ste obrisali korisnika");
                    },
                    error: function(xhr)
                    {
                        console.log(xhr);
                    }
                });

            });
        }

        //Update proizvoda
        let btnUpdate = document.querySelectorAll(".btnUpdate");
       
        for(let i = 0; i < btnUpdate.length; i++)
        {
            btnUpdate[i].addEventListener("click", function(){
                let idProizvod = this.name;
                let cena = btnUpdate[i].parentElement.previousElementSibling.firstChild.value;
                // console.log(btnUpdate[i].parentElement.previousElementSibling.firstChild.value);
                $.ajax({
                    url: "models/update.php",
                    type: "POST",
                    data: {id: idProizvod, 
                    cena: cena},
                    dataType: "json",
                    success: function(result)
                    {
                        alert(result.poruka);
                        setTimeout(location.reload(), 3000);
                    },
                    error: function(xhr)
                    {
                        alert("Greska!");
                        console.log(xhr);
                    }
                });
            });
        }

        //Forma za unos novog proizvoda
        let naziv = document.querySelector("#naziv");
        let cena = document.querySelector("#cena");
        let opis = document.querySelector("#opis");

        let boja = document.querySelectorAll(".boja");
        let kategorija = document.querySelectorAll(".kategorija");

        let slika = document.querySelector("#slika");

        // let btnDodajProizvod = document.querySelector("#btnDodajProizvod");
        
        // btnDodajProizvod.addEventListener("click", function(){
        //     let selected = [];
        //     boja.forEach(b => {
        //     if(b.checked === true)
        //     {
        //         // console.log(b.value)
        //         selected.push(b.value);
        //     }
        //     });
        //     console.log(selected);

        //     let kategorijaArr = [];
        //     kategorija.forEach(k => {
        //     if(k.checked === true)
        //     {
        //         kategorijaArr.push(k.value);
        //     }
        //     });
        //     console.log(kategorijaArr);

        //     console.log(naziv.value, cena.value, opis.value);

        //     $.ajax({
        //         url: "models/dodajProizvod.php",
        //         method: "POST",
        //         dataType: "json",
        //         data: {
        //             boje: selected,
        //             kategorije: kategorijaArr,
        //             naziv: naziv.value,
        //             cena: cena.value,
        //             opis: opis.value,
        //             slika: slika
        //         }
        //     });
        // });
    }

    if(stranica === "index.php?page=korisnik")
    {
        let btnPorudzbina = document.querySelector("#btnPorudzbina");

        let idKorisnik = document.querySelector("#idKorisnik");
        let idKorpa = document.querySelector("#idKorpa");
        btnPorudzbina.addEventListener("click", function(){
            // alert("Poslato");
            $.ajax({
                url: "models/posaljiPorudzbinu.php",
                type: "POST",
                data: {idKorisnik: idKorisnik.value,
                idKorpa: idKorpa.value},
                dataType: "json",
                success: function(result)
                {
                    alert(result);
                    location.reload();
                },
                error: function(xhr)
                {
                    alert("Greska!");
                    console.log(xhr);
                }
            });
        });
    }
});
function proveraRegistracije(ime, prezime, mail, lozinka, pol)
{
    let counter = 0;
    let valid = true;

    let regExpNameSurname = /^[A-ZŠĐŽČĆ][a-zšđžčć]{2,12}$/;
    let imeGreska = document.querySelector("#imeGreska");
    let prezimeGreska = document.querySelector("#prezimeGreska");
    let mailGreska = document.querySelector("#mailGreska");
    let lozinkaGreska = document.querySelector("#lozinkaGreska");

    //Ime
    if(ime.value === "")
    {
        valid = false;
        imeGreska.classList.remove("invisible");
        imeGreska.textContent = "Polje ime je obavezno!";
        ime.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regExpNameSurname.test(ime.value))
        {
            valid = false;
            imeGreska.remove("invisibile");
            imeGreska.textContent = "Ime mora početi prvim velikim slovom (MIN 2, MAX 12 karaktera)";
            ime.style.border = "1px solid #ff0000";
        }
        else
        {
            valid = true;
            counter++;

            imeGreska.classList.add("d-none");
            ime.style.border = "1px solid #00ff00";
        }
    }
    //Prezime
    if(prezime.value === "")
    {
        valid = false;

        prezimeGreska.textContent = "Polje prezime je obavezno!";
        prezimeGreska.classList.remove("invisible");

        prezime.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regExpNameSurname.test(prezime.value))
        {
            valid = false;
            prezimeGreska.textContent = "Niste lepo uneli prezime. Mora početi prvim velikim slovom(MIN 2, MAX 12 karaktera)";
            prezimeGreska.classList.remove("invisible");
            prezime.style.border = "1px solid #ff0000";
        }
        else
        {
            valid = true;
            counter++;

            prezimeGreska.classList.add("d-none");
            prezime.style.border = "1px solid #00ff00";
        }
    }

    //Email
    let regExpMail = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;

    if(mail.value === "")
    {
        valid = false;
        mailGreska.textContent = "Polje mail je obavezno!";
        mailGreska.classList.remove("invisible");
        mail.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regExpMail.test(mail.value))
        {
            valid = false;
            mailGreska.textContent = "Niste lepo napisali mail!";
            mailGreska.classList.remove("invisible");
            mail.style.border = "1px solid #ff0000";   
        }
        else
        {
            valid = true;
            counter++;
            mailGreska.classList.add("d-none");
            mail.style.border = "1px solid #00ff00";
        }
    }

    //Sifra
    let regPass = /^[A-z]{4,20}[0-9]{1}/;
    if(lozinka.value === "")
    {
        valid = false;
        lozinkaGreska.textContent = "Polje lozinka je obavezno!";
        lozinkaGreska.classList.remove("invisible");
        lozinka.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regPass.test(lozinka.value))
        {
            valid = false;
            lozinkaGreska.textContent = "Niste lepo napisali lozinku. Mora da ima najmanje 4 karaktera i jedan broj";
            lozinkaGreska.classList.remove("invisible");
            lozinka.style.border = "1px solid #ff0000";
        }
        else
        {
            valid = true;
            counter++;
            lozinkaGreska.classList.add("d-none");
            lozinka.style.border = "1px solid #00ff00";
        }
    }

    //POL
    // console.log(pol);
    if(pol === undefined)
    {
        valid = false;
        alert("Pol je obavezan");
    }
    else
    {
        valid = true;
        counter++;
    }
    
    if(counter === 5)
    {
        $.ajax({
            url: "models/registracija.php",
            method: "POST",
            dataType: "json",
            // contentType:false,
            // processData: false,
            data: {
                ime: ime.value,
                prezime: prezime.value,
                mail: mail.value,
                lozinka: lozinka.value,
                pol: pol
            },
            success: function(result)
            {
                let obavestenje = document.querySelector("#obavestenje");
                console.log(result);
                // console.log(10);
                if(result.kod === false)
                {
                    obavestenje.innerHTML = `<p class='alert alert-danger my-3'>${result.poruka}</p>`;
                }
                else if(result.kod === true)
                {
                    // labelmail.innerHTML = "mail";
                    window.location.replace("index.php?page=login");
                    obavestenje.innerHTML = `<p class='alert alert-success my-3'>${result.poruka}</p>`;
                }
                // obavestenje.innerHTML = `<p class='alert alert-success'>${result.poruka}</p>`
            },
            error: function(xhr)
            {
                // console.log(xhr);
            }
        });
    }
}
function proveraUnos(ime, prezime, mail, lozinka, pol, uloga)
{
    let counter = 0;
    let valid = true;

    let regExpNameSurname = /^[A-ZŠĐŽČĆ][a-zšđžčć]{2,12}$/;
    //Ime
    if(ime.value === "")
    {
        valid = false;
        ime.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regExpNameSurname.test(ime.value))
        {
            valid = false;
            ime.style.border = "1px solid #ff0000";
        }
        else
        {
            valid = true;
            counter++;
            ime.style.border = "1px solid #00ff00";
        }
    }
    //Prezime
    if(prezime.value === "")
    {
        valid = false;
        prezime.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regExpNameSurname.test(prezime.value))
        {
            valid = false;
            prezime.style.border = "1px solid #ff0000";
        }
        else
        {
            valid = true;
            counter++;
            prezime.style.border = "1px solid #00ff00";
        }
    }

    //Email
    let regExpMail = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;

    if(mail.value === "")
    {
        valid = false;
        mail.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regExpMail.test(mail.value))
        {
            valid = false;
            mail.style.border = "1px solid #ff0000";   
        }
        else
        {
            valid = true;
            counter++;
            mail.style.border = "1px solid #00ff00";
        }
    }

    //Sifra
    let regPass = /^[A-z]{4,20}[0-9]{1}/;
    if(lozinka.value === "")
    {
        valid = false;
        lozinka.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regPass.test(lozinka.value))
        {
            valid = false;
            lozinka.style.border = "1px solid #ff0000";
        }
        else
        {
            valid = true;
            counter++;
            lozinka.style.border = "1px solid #00ff00";
        }
    }

    //POL
    // console.log(pol);
    if(pol.value === undefined)
    {
        valid = false;
        alert("Pol je obavezan");
    }
    else
    {
        valid = true;
        counter++;
    }
    
    if(counter === 5)
    {
        $.ajax({
            url: "models/dodavanje.php",
            method: "POST",
            dataType: "json",
            // contentType:false,
            // processData: false,
            data: {
                ime: ime.value,
                prezime: prezime.value,
                mail: mail.value,
                lozinka: lozinka.value,
                pol: pol.value,
                uloga: uloga.value
            },
            success: function(result)
            {
                let obavestenje = document.querySelector("#odgovor");
                console.log(result);
                // console.log(10);
                if(result.kod === false)
                {
                    obavestenje.innerHTML = `<p class='alert alert-danger my-3'>${result.poruka}</p>`;
                }
                else if(result.kod === true)
                {
                    // labelmail.innerHTML = "mail";
                    obavestenje.innerHTML = `<p class='alert alert-success my-3'>${result.poruka}</p>`;
                    setTimeout(location.reload(), 3000);
                }
                // obavestenje.innerHTML = `<p class='alert alert-success'>${result.poruka}</p>`
            },
            error: function(xhr)
            {
                // console.log(xhr);
            }
        });
    }
}
function napraviProizvod(proizvod)
{
    return `<div class='col-lg-4 border shadow rounded pt-3 pb-3 '>
    <div class='img border shadow mb-3 d-flex justify-content-center'>
        <img src='assets/images/shop/${proizvod.src}' alt='${proizvod.alt}' class='img-fluid'/>
    </div>
    <p class='mb-2'><b class='h6'>Naziv</b>: ${proizvod.naziv}</p>
    <p class='mb-2'><b class='h6'>Cena</b>: ${proizvod.cena} &euro;</p>
    <p class='mb-2'><b class='h6'>Boja</b>: ${proizvod.boja}</p>
    <p class='mb-4 mt-4'>${proizvod.opis == null? "Proizvod nema opis" : proizvod.opis}</p>
    <input id='${proizvod.idProizvod}' type='button' value='Add to cart' class='btn btn_cart btnCart'/></div>`;
}
function ispisProizvoda(proizvodi)
{
    let idProizvod = document.querySelector("#proizvodi");
    let ispis = "";
    for(let proizvod of proizvodi)
    {
        ispis += napraviProizvod(proizvod);
    }
    idProizvod.innerHTML = ispis;
}
function proveraLogovanja(mail, lozinka)
{
    //Email
    let regExpMail = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;

    if(mail.value === "")
    {
        valid = false;
        mail.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regExpMail.test(mail.value))
        {
            valid = false;
            mail.style.border = "1px solid #ff0000";   
        }
        else
        {
            valid = true;
            // counter++;
            mail.style.border = "1px solid #00ff00";
        }
    }

    //Sifra
    let regPass = /^[A-z]{4,20}[0-9]{1}/;
    if(lozinka.value === "")
    {
        valid = false;
        lozinka.style.border = "1px solid #ff0000";
    }
    else
    {
        if(!regPass.test(lozinka.value))
        {
            valid = false;
            lozinka.style.border = "1px solid #00ff00";
        }
        else
        {
            valid = true;
            // counter++; 
            lozinka.style.border = "1px solid #00ff00";
        }
    }


    var loginPodaci = 
    {
        mail: mail.value,
        lozinka: lozinka.value
    };


    $.ajax({
        url:"models/logovanje.php",
        type: "POST",
        data: loginPodaci,
        dataType: "json",
        success: function(result)
        {
            let odgovor = document.querySelector("#odgovor");
            if(result.kod === false)
            {
                odgovor.innerHTML = `<p class='alert alert-danger my-3'>${result.poruka}</p>`;
            }
            else if(result.kod === true)
            {
                odgovor.innerHTML = `<p class='alert alert-success my-3'>${result.poruka}</p>`;
                setTimeout(location.reload(), 3000);
            }
            console.log(result);
        },
        error: function(xhr)
        {   
            // mail.style.border = "1px solid #ff0000";
            // lozinka.style.border = "1px solid #ff0000";
            console.log(xhr);
            if(xhr == 404)
            {
                ("#odgovor").html(`<p class='alert alert-danger'>${xhr}</p>`);
            }
            if(xhr == 500)
            {
                ("#odgovor").html(`<p class='alert alert-danger'>${xhr}</p>`);
            }
        }
    });
}

function btnCartFunc()
{
    let btnCart = document.querySelectorAll(".btnCart");
    let korisnikId = document.querySelector("#korisnikId");
    btnCart.forEach(btn => {
        btn.addEventListener("click", function(){
            $.ajax({
                url: "models/korpa.php",
                method: "POST",
                dataType: "json",
                // contentType:false,
                // processData: false,
                data: {
                    idProizvod: btn.id,
                    idKorisnikPHP: korisnikId.value
                },
                success: function(result)
                {
                    alert(result.poruka);
                    // ispisProizvoda(result);
                },
                error: function(xhr)
                {
                    console.log(xhr);
                }
            });
        });
    });
}