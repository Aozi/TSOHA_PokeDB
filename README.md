<<<<<<< HEAD
Asennusohjeet:

1. Aseta kaikki tiedostot nettiin näkyvään kansioon, esim htdocs.
2. Palauta kaikki data komennolla "psql dbname < db_with_data_dump"

Järjestelmä on nyt valmis käytettäväksi.

Mikäli data halutaan rakentaa uudestaan:

1. Aseta kaikki tiedostot nettiin näkyvään kansioon, esim htdocs.
2. suorita create-tables.sql tiedosto jolloin tietokanta pystytetään
3. Resource kansiosta löytyy kolme php tiedostosa, ParseMoves, ParsePokemon ja ParseTypes.
4. Suorita ensin ParsePokemon joka hakee ja lisää kaikkien POkemonien datan tietokantaan
5. Suorita add-test-data.sql joka pitää sisällään tyyppien perustiedot
6. SEuraavaksi suoritetaan resource kansiosta PArseMoves ja PArseTypes 
7. Viimeiseksi add-required-data.sql 
8. JÄrjestelmän pitäisi olla nyt käyttövalmis.

Testausohjeet:

Järjestelmän etusivu löytyy [tästä](http://nikonovi.users.cs.helsinki.fi/PokeDB/html-demo/Etusivu.php)

Millä tahansa tunnuksella voi rekisteröityä järjestelmään, testaustunnuksena olen itse käyttänyt: kayttaja - salasana
admin salasana: secret_admin - superpassword

Adminilal on oikeus muuttaa globaalin Pokemon tietokannan arvoja.

Suurimmat puutteet järjestelmässä ovat:

- Admin voi poistaa, mutta ei toistaiseksi voi lisätä pokemoneja
- HAkutoiminto puuttuu
- Vertailutoiminnot puuttuvat
=======
[Etusivu] (http://nikonovi.users.cs.helsinki.fi/PokeDB/html-demo/Etusivu.php)

