# A tesztelési jegyzőkönyv

**Tesztelő:** Szkleván Richárd

**Tesztelés dátuma:** 2024.10.06

| Tesztszám | Rövid leírás | Várt eredmény | Eredmény | Megjegyzés |
|:---------:|:------------:|:-------------:|:--------:|:----------:|
|T1| Regisztráció|A felhasználó által megadott adatok ellenőrzése, majd azok adatbázisba való felvitele.| A felhasználó ellenőrzött adatokkal regisztrál.|Nem találtam problémát.|
|T2| Bejelentkezés|A felhasználó az általa megadott adatokkal be tud jelentkezni.|A felhasználó bejelentkezést követeőn a főoldalra kerül.|Nem találtam problémát.|
|T3|Átirányítás|A felhasználó bejelentkezést követeőn a főoldalra kerül.|A megfelelő oldalra kerül a bejelentkezett felhasználó.|Nem találtam problémát.|
|T4|Főoldal, legjobban értékelt tanárok|A főodlal felső részén a 6 legjobb értékeléssel rendelkező tanár jelenik meg.| Megfelelő sorrendben, és pontosan 6 darab jelenik meg.|Nem találtam problémát.|
|T5|Főoldal, keresés mező|A felhasználó szűrni tudja a megjelenő tanárokat a megadott feltételek alapján (értékelés, név, tartott tágyak).|A tanárokra megfelelően lehet keresni.|Nem találtam problémát.|
|T6|Főoldal, tanárok megjelenítése.|A föoldalon alapesetben az összes tanár jelenik meg. |Sikeresen megjelenik az összes tanár.|Nem találtam problémát.|
|T7|Főoldal, Footer|Az oldal láblécében linkek vannak elhelyezve.|Minden link a megfelelő oldalra navigálja a felhasználót.|Nem találtam problémát.|
|T8|Új oktató felvétele|Bejelenkezést követően új oktatót lehet felvinni az adatbázisba amennyiben megfelelő adaokat adott meg a felhasználó.|Az új oktató felvitele sikeres és megjelenik a főoldalon.|Nem találtam problémát.|
|T9| Információ adott oktatóról| Akár regisztrálás nélkül is megtekinthető egy részletesebb felületen különböző információk adott oktatókról. |Minden adat, ami információval szolgál a felhasználónak megjelenik. Minden oktatónak csak a saját adatai jelennek meg.|Nem találtam problémát.|
|T10|Oktató értékelése|Regisztrációt majd bejelentkezést követően értékelni lehet az oktatókat.|Sikeres értékelés leadását követően új átag számítódik.|Nem találtam problémát.|
|T11|Kommentszekció|A felhasználó véleményezheti a tanárokat miután bejelentkezett.| Bejelentkezés után sikeresen lehet kommentet írni, amely megjelenik a tanár információoldalán.|Nem találtam problémát.|
