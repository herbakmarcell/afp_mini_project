# A tesztelési jegyzőkönyv

**Tesztelő:** Szabó Richárd

**Tesztelés dátuma:** 2024.10.06

| Tesztszám | Rövid leírás | Várt eredmény | Eredmény | Megjegyzés |
| ----------|--------------|---------------|----------|----------- |
| T1 | Regisztráció | A felhasználó sikeresen regisztrál érvényes adatok megadásával | A regisztráció sikeresen lezajlott | Nem találtam problémát |
| T2 | Bejelentkezés | A felhasználó helyes adatokkal sikeresen bejelentkezik | A felhasználó gond nélkül bejelentkezett | Nem találtam problémát |
| T3 | Főoldal, bejelentkeztetés | A bejelentkezést követően a felhasználó a főoldalra kerül, ahol már be van jelentkezve | A felhasználó sikeresen átirányításra került és be van jelentkezve | Nem találtam problémát |
| T4 | Főoldal, legjobbra értékelt tanárok | A főoldalon a legjobbra értékelt tanárok listája jelenik meg, csökkenő sorrendben, maximum 6 tanár | A tanárok megfelelő sorrendben jelennek meg | Nem találtam problémát |
| T5 | Főoldal, keresés mező | A kereső mező segítségével a felhasználó meg tudja találni az adott tanárt vagy tanárokat a keresési kritériumok alapján | A keresési szűrő a megadott kritériumoknak megfelelően működik | Nem találtam problémát |
| T6 | Főoldal, tanárok megjelenítése | A főoldalon megjelenik az összes tanár | Az összes tanár listázása sikeresen megtörtént a főoldalon | Nem találtam problémát |
| T7 | Főoldal, footer | Az oldal alján található láblécben elhelyezett linkek működnek és megfelelően irányítanak | A lábléc linkjei megfelelően átirányítják a felhasználót | Nem találtam problémát |
| T8 | Új tanár felvitele | A bejelentkezett felhasználó új tanárt tud hozzáadni az adatbázishoz a kiválasztott tantárgy alapján | Az új tanár sikeresen hozzáadásra került a megadott tantantárgyhoz | Nem találtam problémát | 
| T9 | Információ egy adott tanárról | A felhasználó egy tanár adatlapjára kattintva megtekintheti az illető adatait és a hozzá kapcsolódó véleményeket | A tanár adatai és a hozzá tartozó kommentek megfelelően megjelennek | Nem találtam problémát |
| T10 | Tanár értékelése | A felhasználó csak bejelentkezett állapotban tud értékelni egy tanárt | Az értékelés funkció csak a bejelentkezett felhasználóknak elérhető | Nem találtam problémát |
| T11 | Kommentszekció | A felhasználó, ha bejelentkezett, képes kommentet írni | A kommentelés csak bejelentkezés után lehetséges, a funkció megfelelően működik | Nem találtam problémát |
