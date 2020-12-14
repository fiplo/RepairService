# <p style="text-align: center;">IT-Projektas</p>
## <p style="text-align: center;">Internetinė sistema</p>
### Paulius Ratkevičius IFF-8/12

## Užduotis

7J. IT technikos garantinio remonto priėmimo-išdavimo (būsenos) registravimo sistema.

Administratorius – registruoja, koreguoja visų tipų informaciją sistemoje (vartotojai , darbuotojai, užsakovai , technika).

Vadybininkas – priima įrangą garantiniam remontui , nustato terminus ,koreguoja būseną.Pasikeitus būsenai informuoja užsakovą.

Užsakovas – mato savo užsakymo būseną, galimą įvykdymo datą.
Ataskaita apie visus buvusius užsakymus ir įvykdymo terminus.

papildomai: Fiksuojamas užsakymo priėmimo – išdavimo įvykių laikas.
Administratorius gauna ataskaitas apie įvykdytus pavedimus su jų trukme
## Metodiniai nurodymai
**IT projekto tikslas:** suprojektuoti, realizuoti ir dokumentuoti internetinę sistemą pagal dėstytojo pateiktą užduotį.
**Realizavimo priemonės**: PHP ir MySQL pagrindo platformos. Norint naudoti kitokio pagrindo platformas susiderinti su dėstytoju.

### Implementacija
Ši internetinė aplikacija naudoja PHP ir MySql su `laravel` framework.
Ji gali būti pritaikoma prie betkokios duomenų bazės kurią palaiko `laravel`.
## Informacinės sistemos duomenų bazės loginis modelis
Sistema tvarko du pagrindinius duomenys:
* Vartotojai - Turi 3 tipus:
    1. Administratorius - Pasiekia visą informacija ir gali redaguoti/sukurti viską.
    2. Vadybininkas - Pasiekia jam aktualią informaciją su užsakymais ir su jais susietais vartotojais.
    3. Klientas - Pasiekia informacija susieta tik su savo užsakymais.
* Užsakymai - Laiko informacija apie užsakymo specifikaciją, būsena, klientą, vadybininką ir numatytą baigimo datą.

Kadangi užsakymas turi du jam aktualius vartotojus ir vartotojai gali turėti daug užsakymų naudosime Many To Many duomenų santykius.

![DBUML](http://www.plantuml.com/plantuml/png/RP1FJm8n4CNl_HIJFO8bud6Z19MB1-91F9E1Jh2cxJRz4sACtztEReKiU9l-tdJUcrd6X25bQs3r94It-wHzWlT80Ru5W2IBsa0BRobeTs3YCSPZ5zG8EhGq0kdBC-116oudKYvEBsuGFoStJo5s3irMKIfkiNUkGyypcHYCwPhwZywHotP7eOKNbmQQYzbMAnZGsQr4BqAk6rwqWMJvtt-lBFJHfdtFvSfJHN4_0jtHKQX7uBT5XuSHsGV2H6gBgS1LAHbchwuXnQHjZrci0gUpwA7vEsniOOt-lWIdOdHJiomQm7WwFgzm2myBU5HMEm5phjT3D05t_7esceRT1V-2PZwRJHgGibRr5YriSj12BCcfR8tu1G00)


## Informacinės sistemos atliekamos funkcijos

Informacinė sistemos funkcijos yra pagrinde `CRUD` implementacijos.

Kiekvienas vartotojas gali atlikti tik tas operacijas kurias mes nustatėme [UserPolicy.php](app/Policies/UserPolicy.php) ir [OrderPolicy.php](app/Policies/OrderPolicy.php) failuose.

Numatytai vartotojai gali atlikti šitas funkcijas:
1. Administratorius - Aukščiausio lygio vartotojas, gali pasiekti visą informaciją ir redaguoti ją (pvz. Vartotoją).
2. Vadybininkas - Aukštesnio lygio vartotojas, gali redaguoti jam priklausiančius arba niekam nepriklausančius užsakymus ir matyti jų sąrašus (bet negali žiūreti netuščius jam nepriklausančius užsakymus).
3. Vartotojas - Redaguoti gali tik savo asmeninę informaciją, gali žiūrėti tik savo užsakymus ir su jais susijusių vartotojų informacija.
![ArchitectureUML](http://www.plantuml.com/plantuml/png/TP71Ri8m343l_eg84nnweDpGDC41QRjk6dVJc2wYJLZYCg5jlxRR_cjkcmKAevVApo-E7Iy2e-Uchg2YBIjsoflobPKsdWespi9ygMjZJM2FxBnfmbnXK2XGSclKnuraxGvxNgF5aZpCNtw-0-xS8VAYCcHPS23VWIQ8jSTY9xhQo9-iLX-Wv9DKWO7Kw8dArX-rlgToUfLTlJLcNqlXFoKVAYjjE5KW2QRN-LGZIJbyfSwstbacgoywMnjwVxG7PmeAtRc3WEbD9odvJUN117R-cCpPq5mM1Utvl1osvB-1elJCo9HccibC89fNTvzP5jUNuhIs4uaBWt4tsQI7utZf1A2heBBilj_C8CnFONprOPm3n0jR5Dyk4K5fk3CjZW5zO-bWVWbci22hcxhw1G00)
### Vartotojo informacijos peržiūra ir redagavimas
![redagavimausersuml](http://www.plantuml.com/plantuml/png/ZL9DRbCn4Dxx52Drqqg80xmiA58HGXG94L7M4-oq4__uOO-37dfNu00iMIF12UWgkHTZ9_0A96gpYEPvxE_dcpdFZ8cBTsfyPnPNP3wEgXsfxZMo8KleCSDQJYB7LOGN5pCL8Xj8T7t37LpjE-Y18_IeCGrCiFdH9nGWWc1IWta4lKcwH8tUr1BUlhbKuuchCDS9X_7POvXJPkDnLDsSIjXyhkJmQfX_S52sjzPXoJZx_MZXYXbRK-u_JxYzfV2NMCopemIqXDEd2MWzs0W2J1gVd07Vc02dZDIVAP3Vb4dzEkafs6xpNQY-OXPZpQ6GrAObvvHnsHnuA56cgAF7EpbIMCRayJsjn949cfRJ19gwxK_QVai4g3q5aPsGOwAI0TFYBb36jVI3nNp0G7TfI4imDKSVXOHiYKmWITgoLtuiejghGYxa1K9J2rmIxUFAExPsxN_BKrulw-sO6q1ScHtddyHgqTotwi1acmkHu4qOigoLDKxSa5IWvNI1dpPVxlVni77VQsE_Z8SyrCaVnvWs03bWML5W50jra_vPXIcGtN_csAjpgOjtlm00)
![redagavimasuser](https://your.weebsh.it/1VeUE2Qa.gif)
### Užsakymų peržiūra ir redagavimas
![redagavimasorderuml](http://www.plantuml.com/plantuml/png/ZLBDYXD14BxFKnJiPHV41vWSN655n1N4O3pNs9LiPVfdxAvMHkOLV02FUnRq2SmfyrxMTAA9cB3c46gwgx-Vh-ew2KR9pbR3EseMJ9-6gXnLzMiKufRH8UHnax3jNO0NDxFA1o68lBgJ6XRQ6YIiqO44wD1Wx8LX-wEBg3WCdc91UGGTHPE3GKTJ2M_Vt5R3XPrWLX7xuTbZc7CISZXKzPopttuftA_w-GSxAMWjveIptuyQcsaebzh_FEAuOQ_zIXtHhq82yXBxsLaENiBbqmZyiMy3A3ORV785SaSUBWMvkwf0VuTKfg-BZdrRRxyhspqczLPCfbcvRDdQYcoY4myrp1XCE9R7VXcYm_UyLa_a3IyF8oZYnfyyVeiCQ1nxLHrHGkIS06DpF985chvXhyemdN1GtnARSLEoT45fkCr163JDDk-bdycet4rIRlG5Gj4BaYFlyqexjjBsh-T3O2-dxf0AG5ZJZlDFP5DH_9Vgn7IB2vNWoFT90sp9gXlM2eoUDlXv-_LX7m_E-_zix1Vob0URw2p6yGgWUCnhzhBRXl4-_BqCXq1s_qb2LrrhdPtz1G00)
![redagavimasorder](https://your.weebsh.it/I9OCkG94.gif)
### Vartotojų darbo aplinkos

### Lankytojas
Mato tik titulinį langą ir gali patekti tik į prisijungimo puslapį
![TitleScreen](https://your.weebsh.it/2NsM7C5W.png)
![LoginScreen](https://your.weebsh.it/onE8uQJI.png)
### Klientas
Prisijungę Klientas mato savo aktyvių užsakymų sąrašą ir jų kiekį.
![homeScreenClient](https://your.weebsh.it/u5P64IhP.png)
Klientas gali redaguoti savo profilį, peržvelgti savo užsakymų informaciją ir su jais susietų vartotojų informaciją.
![OrderDetailsClient](https://your.weebsh.it/W8LW2KDM.png)
![userDetailsEditClient](https://your.weebsh.it/ubYvmRQz.gif)
### Vadybininkas
Prisijungęs Vadybininkas mato panašų langą kaip Klientas, su pasirinkimu pamatyti visų užsakymu sąrašą.
![homeScreenManager](https://your.weebsh.it/vlOeabjE.png)
Užsakymu saraše Vadybininkas mato visus užsakymus, tačiau negali atidaryti kitam vadybininkui priklausančius užsakymus ar jų vartotojų informaciją.
![OrderListManager](https://your.weebsh.it/63yC1brs.png)
Vadybininkas gali redaguoti jam priklausančio arba niekam nepriklausančio užsakymo informaciją.
![OrderEditManager](https://your.weebsh.it/ZfkBCHtE.gif)

### Administratorius
Prisijungęs administratorius mato papildoma skydelį su administraciniais įrankiais.
![homeScreenAdmin](https://your.weebsh.it/NIHomL6g.png)
Jame administratorius turi vartotojų sąrašą ir užsakymų sąrašą.
Vartotojų saraše Administratorius gali pridėti naujus vartotojus, juos redaguoti arba atidaryti jiems priklausančius užsakymus.
![userListAdmin](https://your.weebsh.it/APGlXlt9.gif)
Iš šio lango galima patekti į vartotojų registracijos langą.
![userRegisterAdmin](https://your.weebsh.it/ZKDjVDmy.png)
Taip pat gali pereiti prie užsakymų lango
![orderListAdmin](https://your.weebsh.it/2kANfO2K.png)
Jis yra panašus kaip Vadybininko su nuorodą į užsakymų kūrimą.

Sukuriant užsakyma pildoma minimali informacija, kadangi ją gali užpildyti Vadybininkas, taigi tai yra pagrinde užsakymo karkasas.
![orderCreationPage](https://your.weebsh.it/eyYHMtdw.png)

### Sistemos deployinimas

Norint įsidiegti sistemą reikės `Node` ir `NPM` (Javascript kompiliacijai) ir `Composer` (PHP priklausomybių valdiklis)

Visi paketai yra prieinami ubuntu repositorijuose, taigi jas galima įrašyti su šia komandą:

`$sudo apt-get install nodejs composer`

Atsisiuntus reikiamias priklausomybes nusiklonuojame projektą, tai galime padaryti lengvai su `git`:

`$git clone github.com/fiplo/RepairService`

Atisiuntus mums reikės paruošti .env failą, yra paruoštas pavyzdinis failas `.env.example`, kurį galime nusikopijuoti ir modifikuoti.

`$cd RepairService; cp .env.example .env`

Atsidarome .env ir pakeičiame `DB_` laukus į tokius kurie tinka mūsų sistemai.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stud
DB_USERNAME=stud
DB_PASSWORD=stud
```

Atsiunčiame laravel framework

`$composer global require laravel/installer`

Paleidžiame duomenų bazės atkūrimą

`$php artisan migrate:fresh`

Sukuriame administracinį vartotoją Admin

`$php artisan db:seed`

Sukompiliuojame javascript ir css

`$npm run dev`

Paleidžiame projektą, jis bus pasiekiamas per `localhost:8000`

`$php artisan server`
