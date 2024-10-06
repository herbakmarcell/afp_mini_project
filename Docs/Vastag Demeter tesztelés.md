# A tesztelési jegyzőkönyv

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
|T8|Új oktató felvétele|Új oktató felvétele a rendszerbe a név, valamint a tartott tárgy megadásával, bejelentkezés után.|Az oktatót a megfelelő adatok megadásával sikeresen fel lehet vinni az adatbázisba, amennyiben a felhasznláló be van jelentkezve.|Nem találtam problémát.|
|T9| Információ adott oktatóról| A felhasználó meg tudja tekinteni bejelentkezés nélkül az információkat a tanárról.|Az adatok megjelennek a felhasználónak, azonban értékelni nem tudja. Minden oktatónak csak a saját értékelése és kommentei jelennek meg.|Nem találtam problémát.|
|T10|Oktató értékelése|A felhasználó bejelentkezés után értékelni tudja az adott oktatót.|Bejelentkezés után az értékelés sikeres és új átag számítódik.|Nem találtam problémát.|
|T11|Kommentszekció|A felhasználó kommentet írhat az adott tanárra, ha be van jelentkezve.| Bejelentkezés után sikeresen lehet kommentet írni, amely megjelenik a tanár információoldalán.|Nem találtam problémát.|
