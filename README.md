# Online bazár

Peter Grellneth

5ZYI35

## Stručný opis projektu
Online bazár je webová aplikácia na zverejňovanie a prehliadanie inzerátov s novými aj použitými vecami. Rieši problém, keď ľudia chcú rýchlo a jednoducho predať alebo kúpiť tovar bez zložitých platforiem. Je určená bežným používateľom, ktorí hľadajú alebo ponúkajú veci vo svojom okolí.

Návštevníci môžu inzeráty prehliadať a filtrovať podľa kategórie, lokality alebo ceny. Registrovaní používatelia môžu inzeráty pridávať, upravovať a mazať a kontaktovať predajcov cez správy. Správca spravuje kategórie, lokality a obsah aplikácie.

## Role v projekte
- **Návštevník:** prehliada a filtruje inzeráty, zobrazuje detail inzerátu, môže sa registrovať a prihlásiť. Nemôže písať správy ani pridávať inzeráty.
- **Registrovaný používateľ:** má všetky oprávnenia návštevníka, navyše vytvára, upravuje a maže vlastné inzeráty, posiela a číta správy a spravuje svoj profil.
- **Správca:** má všetky oprávnenia používateľa, navyše spravuje kategórie a lokality a môže upraviť alebo zmazať ľubovoľný inzerát.

## Prípady použitia podľa rolí
**Návštevník**
- vyhľadá inzerát podľa kľúčového slova
- filtruje inzeráty podľa kategórie, lokality a ceny
- prezerá detail inzerátu
- zaregistruje sa a prihlási

**Registrovaný používateľ**
- vytvorí nový inzerát s obrázkom
- upraví alebo zmaže svoj inzerát
- napíše správu predajcovi a odpovie na správy
- zobrazí zoznam svojich inzerátov
- upraví svoj profil

**Správca**
- vytvorí, upraví a zmaže kategóriu alebo lokalitu
- zmaže nevhodný inzerát

## Plánované entity
- **Pouzivatel:** používateľ systému (autentifikácia a role). Atribúty: id, meno, email, heslo (hash), rola. Vzťahy: 1:N inzeráty, 1:N správy.
- **Kategoria:** kategória inzerátov. Atribúty: id, nazov. Vzťahy: 1:N inzeráty.
- **Mesto:** lokalita predaja. Atribúty: psc, nazov, kraj, okres. Vzťahy: 1:N inzeráty.
- **Inzerat:** inzerát. Atribúty: id, nazov, popis, cena, stav, obrazok, datum_vytvorenia, pouzivatel_id, kategoria_id, mesto_psc, mesto_nazov. Vzťahy: N:1 pouzivatel, kategoria, mesto; 1:N správy.
- **Sprava:** správa k inzerátu. Atribúty: id, text, datum, inzerat_id, odosielatel_id. Vzťahy: N:1 inzerat, N:1 pouzivatel (odosielateľ).

## Vzťahy medzi entitami
- **Kategoria → Inzerat (1:N):** jedna kategória obsahuje viac inzerátov, inzerát patrí do jednej kategórie.
- **Mesto → Inzerat (1:N):** jedno mesto môže mať viac inzerátov, inzerát má jedno mesto.
- **Pouzivatel → Inzerat (1:N):** používateľ môže vytvoriť viac inzerátov, každý inzerát má jedného autora.
- **Inzerat → Sprava (1:N):** k inzerátu sa viaže viac správ.
- **Pouzivatel → Sprava (1:N):** používateľ môže odoslať viac správ.

## Hlavné stránky aplikácie
1. **Zoznam inzerátov (domov):** prehľad inzerátov s filtrovaním, vyhľadávaním a stránkovaním.
2. **Detail inzerátu:** kompletné informácie, kontakt na predajcu a formulár na správu.
3. **Pridanie / úprava inzerátu:** formulár s validáciou a nahraním obrázka.
4. **Moje inzeráty:** zoznam vlastných inzerátov s možnosťou úpravy a mazania.
5. **Správy:** schránka s konverzáciami k inzerátom.
6. **Prihlásenie / registrácia:** autentifikácia používateľov.
7. **Admin panel:** správa kategórií, lokalít a inzerátov.

## Rozdelenie funkcionality
**Základné funkcie**
- registrácia, prihlásenie, odhlásenie, role
- plný CRUD nad inzerátmi (len vlastník alebo admin)
- plný CRUD nad kategóriami (admin)
- zoznam a detail inzerátov
- AJAX filtrovanie a stránkovanie
- posielanie správ k inzerátom
- validácia vstupov (klient aj server), hashovanie hesiel, ochrana proti SQL injection
- responzívny dizajn, Docker + seed dáta

**Rozširujúce funkcie**
- hodnotenie predajcov a profil predajcu (reputácia)
- obľúbené inzeráty
- viac obrázkov k inzerátu
- označenie inzerátu ako predaný
- zoradenie inzerátov (cena, dátum)
- správa používateľov v admin paneli