### A tesztelési jegyzőkönyv

**Tesztelő:** Vastag Demeter

**Tesztelés dátuma:** 2024.10.06

| Tesztszám | Rövid leírás | Várt eredmény | Eredmény | Megjegyzés |
|:---------:|:------------:|:-------------:|:--------:|:----------:|
|T1| Regisztráció|Adatok ellenőrzzése, majd az adatok felvétele az adatbázisban.| A felhasználó az engedett adatokkal regisztrálhat.|Nem találtam problémát.|
|T2| Bejelentkezés|A felhasználó a megfelelő adatokkal be tud jelentkezni.|A felhasználó be tud jelentkezni, majd át van irányítva a főoldalra.|Nem találtam problémát.|
|T3|Átirányítás|A felhasználó a bejelentkezés után a főoldalra van irányítva.|Az átirányítás sikeresen megtörténik|Nem találtam problémát.|
|T4|Főoldal, legjobban értéket tanárok| A főodalon a 6 legjobb értékeléssel rendelkező tanár jelenik meg.| A tanárok a megfelelő sorrendben jelennek meg, pontosan 6 db.|Nem találtam problémát.|
|T5|Főoldal, keresés mező|A felhasználó egy, vagy több tanárra tud keresni a megadott feltételek alapján (értékelés, név, tartott tágyak).|A tanárokra megfelelően lehet keresni, mindig a várt oktató jelenik meg.|Nem találtam problémát.|
|T6|Főoldal, tanárok megjelenítése.|A föoldalon megjelenik az összes tanár, amennyiben nincs szűrőfeltétel.|Sikeresen megjelenik az összes tanár.|Nem találtam problémát.|
|T7|Főoldal, Footer|Az oldal láblécében átirányítások találhatók.|Minden átirányítás a megfelelő oldalra irányítja át a felhasználót.|Nem találtam problémát.|
