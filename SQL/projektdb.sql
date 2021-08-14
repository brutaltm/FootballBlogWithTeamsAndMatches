-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Wrz 2019, 00:40
-- Wersja serwera: 10.3.16-MariaDB
-- Wersja PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projektdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `druzyny`
--

CREATE TABLE `druzyny` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `stadion` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `liga` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `pucharkrajowy` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `pucharogolny` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT 'Liga Mistrzów',
  `pucharogolny2` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT 'Liga Europy',
  `logo` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `druzyny`
--

INSERT INTO `druzyny` (`id`, `nazwa`, `stadion`, `liga`, `pucharkrajowy`, `pucharogolny`, `pucharogolny2`, `logo`) VALUES
(1, 'Real Madryt', 'Santiago Bernabeu', 'La liga', 'Puchar Króla', 'Liga Mistrzów', 'Liga Europy', 'logoREALMADRID.png'),
(2, 'FC Barcelona', 'Camp Nou', 'La liga', 'Puchar Króla', 'Liga Mistrzów', 'Liga Europy', 'logoBARCELONA.png'),
(3, 'FC Bayern', 'Allianz Arena', 'Bundesliga', 'Puchar Niemiec', 'Liga Mistrzów', 'Liga Europy', 'logoBAYERN.png'),
(4, 'Borussia Dortmund', 'Signal Iduna Park', 'Bundesliga', 'Puchar Niemiec', 'Liga Mistrzów', 'Liga Europy', 'logoBVB.png'),
(5, 'Liverpool F.C.', 'Anfield', 'Premier League', 'Puchar Anglii', 'Liga Mistrzów', 'Liga Europy', 'logoLIVERPOOL.png'),
(6, 'Manchester City', 'City of Manchester Stadium', 'Premier League', 'Puchar Anglii', 'Liga Mistrzów', 'Liga Europy', 'logoMANCITY.png'),
(7, 'Manchester United F.C.', 'Old Trafford', 'Premier League', 'Puchar Anglii', 'Liga Mistrzów', 'Liga Europy', 'logoMANUNITED.png'),
(8, 'Tottenham Hotspur F.C.', 'Tottenham Hotspur Stadium', 'Premier League', 'Puchar Anglii', 'Liga Mistrzów', 'Liga Europy', 'logoTOTTENHAM.png'),
(9, 'Chelsea F.C.', 'Stamford Bridge', 'Premier League', 'Puchar Anglii', 'Liga Mistrzów', 'Liga Europy', 'logoCHELSEA.png'),
(10, 'Arsenal F.C.', 'Emirates Stadium', 'Premier League', 'Puchar Anglii', 'Liga Mistrzów', 'Liga Europy', 'logoARSENAL.png'),
(11, 'Atlético Madryt', 'Wanda Metropolitano', 'La liga', 'Puchar Króla', 'Liga Mistrzów', 'Liga Europy', 'logoATLETICO.png'),
(12, 'Paris Saint-Germain F.C.', 'Parc des Princes', 'Ligue 1', 'Puchar Ligi Francuskiej', 'Liga Mistrzów', 'Liga Europy', 'logoPSG.png'),
(13, 'Juventus F.C.', 'Allianz Stadium', 'Serie A', 'Puchar Włoch', 'Liga Mistrzów', 'Liga Europy', 'logoJUVE.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`) VALUES
(1, 'Bundesliga'),
(2, 'Ekstraklasa'),
(3, 'La Liga'),
(4, 'Premier League'),
(5, 'Ligue 1'),
(6, 'Serie A'),
(7, 'Transfery'),
(8, 'Mecze');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPosta` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `tresc` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `komentarze`
--

INSERT INTO `komentarze` (`id`, `idPosta`, `userid`, `tresc`, `data`) VALUES
(7, 6, 1, 'komentarz administratora\r\nkomentarz administratora', '2019-08-29 23:19:27'),
(8, 6, 2, 'komentarz uzytkownika \r\nkomentarz uzytkownika', '2019-08-30 17:19:24'),
(10, 3, 2, 'komentarz', '2019-09-03 09:52:47');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mecze`
--

CREATE TABLE `mecze` (
  `id` int(10) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `stadion` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `liga` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `teamaid` int(10) UNSIGNED NOT NULL,
  `teambid` int(10) UNSIGNED NOT NULL,
  `wynikteama` int(10) NOT NULL,
  `wynikteamb` int(10) NOT NULL,
  `goleteama` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `goleteamb` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `redcardsteama` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `redcardsteamb` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `teamastats` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `teambstats` varchar(200) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `mecze`
--

INSERT INTO `mecze` (`id`, `data`, `stadion`, `liga`, `teamaid`, `teambid`, `wynikteama`, `wynikteamb`, `goleteama`, `goleteamb`, `redcardsteama`, `redcardsteamb`, `teamastats`, `teambstats`) VALUES
(1, '2019-09-02', 'Santiago Bernabeu', 'La liga', 1, 2, 1, 2, 'Hazard 42\'', 'Messi 43\'<br>\r\nGriezmann 90\'', 'Casemiro 91\'', '', '10<br>5<br>43%<br>521<br>88%<br>17<br>6<br>0<br>5<br>6', '10<br>5<br>43%<br>521<br>88%<br>17<br>6<br>0<br>5<br>6'),
(2, '2019-08-31', 'Allianz Arena', 'Bundesliga', 3, 4, 2, 2, 'Lewandowski 61\', 78\'', 'Paco Alcacer 34\'<br>Marco Reus 89\'', '', '', '22<br>10<br>79%<br>886<br>92%<br>8<br>0<br>0<br>0<br>10', '5<br>2<br>21%<br>246<br>71%<br>7<br>0<br>0<br>0<br>0'),
(4, '2019-09-05', 'Old Trafford', 'Premier League', 7, 8, 3, 0, 'Rashford 13&#039;, 45&#039;, 78&#039;', '', '', '', '10&lt;br&gt;3&lt;br&gt;60%&lt;br&gt;434&lt;br&gt;78%&lt;br&gt;3&lt;br&gt;2&lt;br&gt;0&lt;br&gt;1&lt;br&gt;7', '3&lt;br&gt;2&lt;br&gt;40%&lt;br&gt;341&lt;br&gt;67%&lt;br&gt;6&lt;br&gt;4&lt;br&gt;0&lt;br&gt;1&lt;br&gt;3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posty`
--

CREATE TABLE `posty` (
  `id` int(10) UNSIGNED NOT NULL,
  `idKategorii` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `tytul` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `tresc` varchar(2000) COLLATE utf8_polish_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `posty`
--

INSERT INTO `posty` (`id`, `idKategorii`, `userid`, `tytul`, `tresc`, `data`) VALUES
(1, 1, 1, 'Lewandowski show! Bayern pokonał Schalke 3:0', 'Dzisiejszego późnego wieczoru ekipa rekordowego mistrza Niemiec prowadzona przez chorwackiego szkoleniowca mierzyła się w pojedynku drugiej kolejki niemieckiej Bundesligi z drużyną Schalke 04 Gelsenkirchen. Warto mieć na uwadze, że dla FCB było to dokładnie czwarte starcie w tym sezonie.\r\n\r\nOstatecznie spotkanie na wypełnionej po brzegi Veltins Arenie zakończyło się wynikiem 3:0, zaś wszystkie trzy bramki zdobył nasz rodak i najlepszy strzelec Bayernu w ostatnich latach, czyli Robert Lewandowski.\r\n\r\nWarto nadmienić, że dzisiejszego wieczoru mogliśmy w akcji oglądać trzy nowe nabytki bawarskiego klubu − w drugiej połowie na boisku zameldował się zarówno Ivan Perisic, jak i Philippe Coutinho. Co więcej swój debiut w Bundeslidze zaliczył także Lucas Hernandez!\r\n\r\nNa przygotowania do kolejnego meczu o stawkę podopieczni Niko Kovaca podobnie jak w przypadku starcia z Schalke będą mieli pełny tydzień. Dokładnie 31 sierpnia o 15:30 na Allianz Arenie w Monachium klub ze stolicy Bawarii podejmie u siebie FSV Mainz 05.', '2019-08-27 15:08:11'),
(2, 1, 2, 'Wynik lepszy niż gra. Borussia Dortmund pokonuje 1. FC Köln', 'Borussia Dortmund, mimo nie najlepszej gry, wygrała wyjazdowe spotkanie 2. kolejki Bundesligi przeciwko 1. FC Köln wynikiem 3:1.\r\n\r\nOd początku meczu gospodarze starali się grać wysokim pressingiem, co mocno utrudniało konstruowanie akcji zawodnikom BVB. Kolonia objęła prowadzenie w 29. minucie za sprawą strzału głową Dominicka Drexlera, który wykorzystał złe ustawienie rywali przy rzucie rożnym. Do przerwy podopieczni Luciena Favre\'a nie stworzyli sobie praktycznie żadnej klarownej sytuacji na zdobycie gola.\r\n\r\nWraz z kolejnymi minutami drugiej połowy piłkarze Borussii zaczęli podkręcać tempo, w czym duży udział mieli wprowadzeni z ławki rezerwowych Julian Brandt oraz Achraf Hakimi. W 70. minucie zawodnikom z Dortmundu nareszcie udało się wyrównać. Po krótko rozegranym rzucie rożnym, Jadon Sancho technicznym strzałem pokonał bramkarza beniaminka Bundesligi. W 86. minucie Hakimi otrzymał dokładne dośrodkowanie od Łukasza Piszczka, wygrał pojedynek powietrzny i głową umieścił piłkę w siatce. W doliczonym czasie gry drużyna Kolonii rzuciła się do ataku, co wykorzystali Czarno-Żółci. Tym razem na listę strzelców wpisał się, będący w dobrej dyspozycji, Paco Alcácer.', '2019-08-27 15:10:34'),
(3, 1, 1, 'Arjen Robben rozważa wznowienie kariery', 'Były zawodnik Bayernu Monachium Arjen Robben, który na początku lipca tego roku ogłosił oficjalne zakończenie swojej kariery, już niedługo może powrócić do profesjonalnej gry w piłkę. Jak przyznaje sam Holender, wciąż nie wyklucza on podpisania kontraktu z nowym pracodawcą w ciągu najbliższych kilku miesięcy, jeśli zbyt mocno będzie tęsknić za futbolem.\r\n\r\n4 lipca, a więc już kilka dni po wygaśnięciu kontraktu, który łączył skrzydłowego z Bayernem, Robben poinformował oficjalnie o zawieszeniu butów na kołku. \r\n\r\n- Sporo o tym myślałem przez ostatnich kilka tygodni. Jak wszyscy wiedzą, miałem trochę czasu, by rozważyć swoją przyszłość po tym, jak odszedłem z Bayernu Monachium. I zdecydowałem, że to koniec mojej profesjonalnej kariery - informował Holender. Teraz 35-latek nie jest do końca pewien, czy była to ostateczna decyzja, a o swoich rozterkach opowiedział w rozmowie z dziennikarzami NPO Radio.\r\n\r\n- Zawsze powtarzam: \"Nigdy nie mów nigdy\". Być może w ciągu miesiąca lub najbliższych dwóch miesięcy będzie mi towarzyszyć dziwne uczucie braku tego wszystkiego i zdecyduję, że muszę wrócić - zdradził holenderskiej rozgłośni były partner z drużyny Roberta Lewandowskiego.\r\n\r\nPomocnik zaznaczył jednak przy tym, że prawdopodobieństwo ponownego wkroczenia w świat futbolu nie jest bardzo duże.\r\n\r\n- Z biegiem czasu zawieszenie emerytury będzie coraz trudniejsze. Szanse na powrót oceniłbym więc jako niewysokie - dodał Robben.\r\n\r\nHolender jest byłym zawodnikiem między innymi londyńskiej Chelsea, Realu Madryt oraz Bayernu Monachium, a na swoim koncie ma mnóstwo tytułów. 35-latek ma w gablocie medale za między innymi: dwa mistrzostwa Anglii, mistrzostwo Hiszpanii, osiem tytułów triumfatora Bundesligi, pięć zwycięstw w Pucharze Niemiec, wygraną w Lidze Mistrzów oraz tytuł wicemistrza świata z 2010 roku.\r\n', '2019-08-27 15:13:12'),
(4, 2, 2, 'Brak pauzujących, siedmiu zagrożonych', 'W ostatniej kolejce przed pierwszą w sezonie 2019/20 przerwą na mecze reprezentacji żaden z zawodników nie pauzuje z powodu kartek. Jeśli jednak nie chcą przedłużyć sobie przerwy od ligowych meczów, siedmiu piłkarzy musi uniknąć czwartej żółtej kartki w sezonie.\r\n\r\nZagrożeni karą przed 7. kolejką PKO BP Ekstraklasy 2019/20\r\n\r\n\r\n3 żółte kartki\r\n\r\nPaweł Bochniewicz (Górnik Zabrze)\r\nMateusz Matras (Górnik Zabrze)\r\nJakub Żubrowski (Korona Kielce)\r\nDorde  Crnomarković (Lech Poznań)\r\nFlavio Paixao (Lechia Gdańsk)\r\nLukas Klemenz (Wisła Kraków)\r\nDamian Rasak (Wisła Płock)', '2019-08-28 19:59:01'),
(5, 2, 1, 'Czekaliśmy 56 lat...', 'Piątkowy mecz 6. kolejki między Jagiellonią Białystok, a Wisłą Kraków mocno przemeblował czołówkę klasyfikacji najmłodszych strzelców w historii najwyższej polskiej ligi piłkarskiej. Przyczyną roszad stało się trafienie zawodnika Białej Gwiazdy - Aleksandra Buksy, liczącego sobie 16 lat 220 dni.\r\n\r\nWyczyn ze starcia z Dumą Podlasia daje mu pozycję lidera w rankingu najmłodszych zdobywców bramek w całym XXI wieku. Poprzedni rekord obecnego stulecia w Ekstraklasie należał do Ariela Borysiuka. Był on 45 dni starszy niż obecnie Buksa, kiedy 19 kwietnia 2008 roku w barwach Legii Warszawa, zanotował swoje premierowe trafienie w elicie. Na trzeciej pozycji znajduje się w tej klasyfikacji Filip Marchwiński z Lecha Poznań. Gracz Kolejorza dokonał tego w wieku 16 lat 340 dni, w meczu wyjazdowym Kolejorza z Zagłębiem Sosnowiec, który miał miejsce 16 grudnia 2018 roku. Dzięki temu pierwszy raz w dwóch latach kalendarzowych z rzędu gole w Ekstraklasie strzelali zawodnicy przed 17. urodzinami!\r\n\r\nAleksander Buksa został jednocześnie najmłodszym strzelcem gola w Ekstraklasie od ponad 56 lat! Ostatnio mniej na \"liczniku\" spośród zdobywców bramek w najwyższej lidze miał Włodzimierz Lubański, który 9 czerwca 1963 roku w barwach Górnika Zabrze trafił przeciwko Pogoni Szczecin. Od daty jego narodzin do tego momentu minęło 16 lat 101 dni. Było to już jednak jego trzecie trafienie na tym szczeblu. Poprzednie notował w wieku: 16 lat, 72 dni (z Wisłą Kraków) i 16 lat, 52 dni (z Arkonią Szczecin). Ten ostatni wynik do dziś stanowi rekord całej ligi.', '2019-08-28 20:12:26'),
(6, 2, 2, '#ESAdoKadry: Trzech na półmetek', 'Selekcjoner reprezentacji Polski, Jerzy Brzęczek, ogłosił skład reprezentacji Polski na mecze eliminacji Mistrzostw Europy ze Słowenią (6 września) i Austrią (9 września). W drużynie znalazło się trzech przedstawicieli klubów PKO Bank Polski Ekstraklasy: Jakub Błaszczykowski (Wisła Kraków), Robert Gumny (Lech Poznań) i Artur Jędrzejczyk (Legia Warszawa).&lt;br&gt;&lt;br&gt;Jakub Błaszczykowski w tym momencie dzieli pozycję rekordzisty reprezentacji Polski w liczbie występów. Zagrał w niej - tak samo jak Robert Lewandowski - 106 meczów. Z tego dziewięć pierwszych i ostatni zagrał jako zawodnik Wisły Kraków. Przed czterema dniami obchodził już 13. rocznicę pierwszego z dwudziestu jeden goli w biało-czerwonych barwach (2:2 z Rosją). W obecnym sezonie w PKO Bank Polski Ekstraklasie zaprezentował się na boisku trzy razy (141 minut czasu gry). W starciu z ŁKS Łódź w czwartej kolejce zanotował asystę przy golu Pawła Brożka i trafił do najlepszej &quot;jedenastki&quot; tej serii spotkań.&lt;br&gt;&lt;br&gt;Jeden raz w tym gronie znalazł się już także drugi z powołanych - Artur Jędrzejczyk z Legii Warszawa. On ma na swoim koncie w obecnej edycji zmagań jak na razie cztery spotkania (360 minut) na koncie. Z nim na boisku Wojskowi stracili trzy bramki. Ani razu nie dali się zaś pokonać w obecnej odsłonie batalii o udział w fazie grupowej Ligi Europy. &quot;Jędza&quot; w każdym starciu tych rozgrywek grał od 1. do 90. minuty. W reprezentacji do tej pory rozegrał zaś 39 meczów i strzelił trzy gole.&lt;br&gt;', '2019-08-28 20:14:49'),
(25, 3, 2, 'Ansu Fati najmłodszym strzelcem gola w historii Barcelony w LaLidze', '<br>Ansu Fati znów udowodnił swój nieprzeciętny talent. 16-letni skrzydłowy pojawił się na boisku w przerwie meczu z Osasuną i już po sześciu minutach zanotował swoje pierwsze trafienie w barwach Barcelony.<br><br>Fati wygrał pojedynek główkowy po dośrodkowaniu Carlesa Péreza i po dobrym strzale głową umieścił piłkę w rogu bramki strzeżonej przez Rubena. Dzięki temu przeszedł do historii katalońskiego klubu. Jak podają hiszpańscy dziennikarze, skrzydłowy został bowiem najmłodszym strzelcem gola w historii występów Barcelony w Primera División. Fati zdobył bramkę w wieku 16 lat i 304 dni i wyprzedził pod tym względem Bojana Krkicia (17 lat i 53 dni), a nawet samego Leo Messiego (17 lat i 331 dni). Pozostaje mieć nadzieję, że dalsza kariera utalentowanego zawodnika potoczy się bardziej w kierunku przypominającym piłkarską drogę Argentyńczyka niż Hiszpana. Krkić od razu pogratulował Fatiemu, mimo że ten odebrał mu klubowy rekord. – Zawsze to wielka radość oglądać chłopaków z La Masii cieszących się grą i realizujących marzenia. Gratulacje z powodu twojego rekordu, Ansu! – napisał były wielki talent Barcelony.<br><br>Co ciekawe, Fati został również trzecim najmłodszym graczem w historii całej LaLigi, który zdołał trafić do siatki. Młodsi od niego byli tylko Fabrice Olinga (16 lat i 98 dni) oraz Iker Muniain (16 lat i 289 dni). Jak podaje Mundo Deportivo, po strzeleniu gola kamery telewizyjne wyłapały, jak Fati mówi: „Boże, to niemożliwe”.', '2019-08-31 23:46:27'),
(26, 3, 2, 'Tragedia w rodzinie Luisa Enrique. Cały piłkarski świat wysyła kondolencje', '<br>W czwartek były trener FC Barcelony i reprezentacji Hiszpanii za pośrednictwem Twittera poinformował o śmierci swojej 9 - letniej córki Xany. Dziewczynka od 5 miesięcy zmagała się ze złośliwym nowotworem kości - kostniakomięśniakiem. Z uwagi na walkę z chorobą Luis Enrique niedawno zrezygnował z posady selekcjonera reprezentacji Hiszpanii.<br><br>\"Kondolencje i wyrazy współczucia dla Luisa Enrique i całej jego rodziny \" - napisała na Twitterze Barcelona, w której Enrique grał w latach 1996-2004, a później w latach 2014-2017 był jej trenerem. Jako menadżer wygrał z Katalończykami aż 9 trofeów, w tym Ligę Mistrzów.<br><br>Kondolencję przekazał również Real Madryt, w którym pomocnik grał w latach 1991 - 1996. \"Real Madryt jest głęboko zasmucony odejściem córki Luisa Enrique. Chcielibyśmy przekazać kondolencje jemu i jego rodzinie w tym trudnym czasie\" - czytamy w oficjalnym komunikacie klubu.', '2019-08-31 23:51:45'),
(27, 3, 2, 'Gwiazdy Barcelony wygrały prawie pół miliona euro w turnieju pokera EPT', 'Po niedzielnym zwycięstwie z Betisem (5:2) część piłkarzy Barcelony postanowiła zrelaksować się przy pokerowym stole. Korzystając z tego, że w stolicy Katalonii gości jeden z największych pokerowych festiwali, PokerStars.es EPT Barcelona, Gerard Pique i Arturo Vidal wzięli udział w jednodniowym turnieju High Roller o wpisowym 25 tys. euro. Piłkarzom poszło niemal równie dobrze, jak na murawie.&lt;br&gt;Dla wielu sportowców poker jest jedną z ulubionych rozrywek. Po zakończeniu kariery tenisowej na poważnie za grę wziął się Boris Becker, ze współczesnych sportowców przy stołach można spotkać choćby Rafaela Nadala, Ronaldo (brazylijskiego), Cristiano Ronaldo, Neymara czy Gerarda Pique. Pasji do gry nie ukrywa Robert Kubica, a najbardziej utytułowanym polskim pokerzystą długo pozostawał były reprezentant kraju w narciarstwie alpejskim Marcin Horecki.&lt;br&gt;&lt;br&gt;Widok Pique i Vidala na poniedziałkowym turnieju nie był żadnym zaskoczeniem. Hiszpański obrońca w festiwalu bierze udział regularnie. Dwa lata temu wygrał prawie 130 tys. euro, wcześniej zaliczył trzy wyniki po kilkadziesiąt tysięcy. Kiedy tylko może, bierze też udział w pokerowych mistrzostwach świata - World Series of Poker - rozgrywanych latem w Las Vegas. Vidal ma mniejsze doświadczenie, w oficjalnych statystykach nigdy nie zanotowano jego turniejowej wygranej.&lt;br&gt;&lt;br&gt;Obu piłkarzom przy stołach szło jednak znakomicie. W turnieju, do którego odnotowano 70 wpisowych, obaj znaleźli się na stole finałowym. A rywalizowali z uznanymi profesjonalistami, choćby mistrzem świata z 2013 roku Ryanem Riessem. Ostatecznie Vidal zajął piąte miejsce, za co dostał 134 460 euro. Jeszcze lepiej poszło Pique, który do końca walczył o turniejowe zwycięstwo i ponad 491 tys. euro. Lepszy okazał się jednak jego rodak Juan Pardo. Na pocieszenie gwiazdor Barcelony skasował za drugie miejsce 352 950 euro.', '2019-08-31 23:55:17'),
(29, 4, 2, 'Lider Liverpool ustanowił klubowy rekord zwycięstw', 'Lider Liverpool i wicelider Manchester City wygrały gładko mecze w 4. kolejce Premier League.&amp;nbsp;&lt;br&gt;Piłkarze &quot;The Reds&quot; pokonali na wyjeździe Burnley 3-0, odnosząc rekordowe w historii klubu 13. ligowe zwycięstwo z rzędu, a mistrzowie Anglii zwyciężyli u siebie Brighton 4-0. Bramki dla Liverpoolu zdobyli Sadio Mane, Roberto Firmino, a jedna została zapisana jako samobójcza Chrisa Wooda, od którego odbiła się piłka po dośrodkowaniu Trenta Alexandra-Arnolda.&lt;br&gt;&lt;br&gt;To trzynaste z rzędu ligowe zwycięstwo &quot;The Reds&quot; (licząc z poprzednim sezonem), co jest rekordem Liverpoolu. Poprzedni został ustanowiony między kwietniem i październikiem 1990 roku.&lt;br&gt;&lt;br&gt;Podopieczni Juergena Kloppa z kompletem 12 punktów utrzymali prowadzenie w tabeli. Dwa mniej ma Manchester City, dla którego dwie bramki w meczu z Brightonem strzelił Sergio Aguero, a po jednej Kevin De Bruyne i Bernardo Silva.', '2019-09-01 00:01:04'),
(30, 6, 2, 'Milan skromnie pokonał beniaminka. Krzysztof Piątek bez gola, wszedł w drugiej połowie', 'Milan pokonał Brescię 1:0 (1:0) w meczu 2. kolejki Serie A. Niespodziewanie Krzysztof Piątek zaczął to spotkanie na ławce. Polak wszedł dopiero w drugiej połowie meczu i znów nie zdobył bramki dla swojej drużyny.&lt;br&gt;&lt;br&gt;Piątek nie wyszedł w pierwszym składzie, a za niego na szpicy grał Andre Silva. Czy ten manerw okazał się udany? Biorąc pod uwagę sam wynik - tak. Milan wygrał 1:0 z beniaminkiem po bramce Hakana Calhanoglu w 12. minucie. Gospodarze byli lepsi i odnieśli pierwsze zwycięstwo w tym sezonie.&amp;nbsp;&lt;br&gt;&lt;br&gt;Piątek pojawił się na boisku w 61. minucie. Mógł strzelić gola, ale przegrał sytuację sam na sam z bramkarzem Bresci. Po dwóch kolejkach ligi włoskiej Milan jest na 10. pozycji, a Brescia lokatę wyżej.&amp;nbsp;', '2019-09-01 00:07:49'),
(31, 6, 2, 'Szalony mecz w Serie A! Juventus ograł Napoli 4:3 po samóbojczej bramce w końcówce spotkania!', 'Już w 2. kolejce przyszło nam oglądać hit Serie A Juventus - Napoli! Pierwsza połowa na Allianz Stadium była pod dyktando gospodarzy. Juventus objął prowadzenie już w 16. minucie, gdy gola strzelił Danilo. Kilkadziesiąt sekund wcześniej to Napoli mogło prowadzić, ale strzał Alana kapitalnie obronił Wojciech Szczęsny.&lt;br&gt;&lt;br&gt;Trzy minuty po bramce Danilo było już 2:0 dla gospodarzy. Gonzalo Higuain dostał piłkę w polu karnym, kapitalnie minął zwodem Kalidou Koulibaly&#039;ego i strzałem prosto w okienko pokonał bramkarza gości, Alexa Mereta. Cóż to była za akcja Argentyńczyka!&lt;br&gt;Napoli próbowało odpowiedzieć na gole Juventusu, ale w pierwszej połowie było zupełnie bezradne. &quot;Stara Dama&quot; mogła zaś prowadzić wyżej, ale strzał Samiego Khediry trafił w poprzeczkę.&lt;br&gt;&lt;br&gt;Po przerwie Napoli atakowało odważniej, ale nadziało się na kontrę Juventusu. W 62. minucie pierwszego gola w nowym sezonie Serie A strzelił Cristiano Ronaldo. Było 3:0 dla gospodarzy i wydawało się, że piłkarze Napoli wrócą do domu bez punktów.&lt;br&gt;Tymczasem cztery minuty później Kostas Manolas dał nadzieję gościom, zdobywając głową bramkę po rzucie wolnym. W 68. minucie było już tylko 2:3, bo po świetnej akcji Napoli Piotr Zieliński podał do Hirvinga Lozano, a nowy nabytek wicemistrzów Włoch wykorzystał sytuację.&lt;br&gt;&lt;br&gt;Juventus był zaskoczony takim obrotem wydarzeń. Napoli dalej atakowało i doczekało się wyrównania w 81. minucie. Znów po rzucie wolnym bramkę dla gości zdobył Giovanni Di Lorenzo. Gdy wydawało się, że mecz zakończy się remisem, po rzucie wolnym Juventusu piłkę do własnej bramki wpakował Koulibaly. Koszmar Napoli, radość Juventusu. Mistrzowie Włoch pokonali wicemistrzów 4:3. Hit Serie A nie zawiódł!', '2019-09-01 00:18:26'),
(32, 6, 2, 'Chris Smalling wypożyczony z Manchesteru United do AS Roma', 'Obrońca Manchesteru United Chris Smalling został wypożyczony do AS Roma do końca sezonu.&lt;br&gt;&quot;Czerwone Diabły&quot; zarobią na wypożyczeniu swojego piłkarza trzy miliony euro.&lt;br&gt;&lt;br&gt;- To dla mnie idealna okazja. To szansa na poznanie nowej ligi i grę w dużym klubie, który ma wysokie aspiracje - skomentował piłkarz.&lt;br&gt;&lt;br&gt;Smalling rozegrał 323 mecze w barwach Man Utd w ciągu dziewięciu sezonów spędzonych na Old Trafford i ma na koncie 31 meczów w reprezentacji Anglii. Stracił jednak miejsce w wyjściowym składzie po transferze Harry&#039;ego Maguire&#039;a, za którego &quot;Czerwone Diabły&quot; zapłaciły Leicesterowi City 90 mln euro.&lt;br&gt;&lt;br&gt;- Chris miał nadzieję, że tam pojedzie. To nowe doświadczenie, nowa przygoda - skomentował menedżer United Ole Gunnar Solskjaer.&lt;br&gt;&lt;br&gt;Smalling został trzecim piłkarzem Manchesteru United, który w sierpniu przeniósł się do Serie A po Romelu Lukaku (wykupił go Inter Mediolan za 75 mln euro) i Alexisie Sanchezie (został wypożyczony do Interu do końca sezonu).', '2019-09-01 00:23:17'),
(33, 4, 1, 'Zespół Bednarka zatrzymał Manchester United. Liverpool nadal liderem', 'Southampton z Janem Bednarkiem w składzie zremisował 1:1 z Manchesterem United. W innych sobotnich spotkaniach Premier League pewne zwycięstwa odnotowały ekipy Liverpoolu i Manchesteru City.&lt;br&gt;&lt;br&gt;Poprzedni sezon Premier League zdominowany zostały przez ekipy Liverpoolu i Manchesteru City. Wiele wskazuje na to, że nowy sezon ligi angielskiej może ułożyć się podobnie. Zespoły Jurgena Kloppa i Pepa Guardioli znów są na prowadzeniu. Aktualnie liderem jest Liverpool, który w sobotę pokonał 3:0 Burnley po bramkach Sadio Mane, Roberto Firmino i Chrisa Wooda (samobójcza). &quot;Obywatele&quot; wygrali jeszcze wyżej z Brighton, bo aż 4:0. Gole dla City strzelali: Kevin De Bruyne, Sergio Aguero (dwie) i David Silva. Zespół City jest wiceliderem i traci po czterech kolejkach dwa punkty do drużyny &quot;The Reds&quot;.&lt;br&gt;&lt;br&gt;Punkty w sobotę stracił za to inny faworyt ligi - Chelsea Londyn. Drużyna ze stolicy Anglii tylko zremisowała z Sheffield United (2:2). Jedynie punkt zdobył także Manchester United. &quot;Czerwone Diabły&quot; nie zdołały pokonać ekipy Southamptonu na wyjeździe (1:1). W barwach gospodarzy 90 minut zaliczył ponownie Jan Bednarek. W niedziele rozegrane zostaną dwa ostatnie mecze 4. kolejki Premier League: Everton - Wolverhampton (godzina 15:00) oraz hit Arsenal Londyn - Tottenham (17:30).', '2019-09-01 00:25:50'),
(34, 4, 1, 'Problemy Tottenhamu przed hitem z Arsenalem', 'Ci, którzy oglądali występy Tottenhamu w dotychczasowych meczach w Premier League, mogli odnieść wrażenie, że latem ktoś podmienił Mauricio Pochettino piłkarzy. O ile przeciwko Aston Villi w pierwszej kolejce udało się jeszcze wygrać 3:1 – choć do 73. minuty to beniaminek niespodziewanie prowadził – o tyle remis 2:2 z Manchesterem City należy uznać już za bardzo szczęśliwy. W tamtym spotkaniu mistrzowie Anglii oddali aż 30 strzałów przy zaledwie trzech próbach Spurs i mieli 52 kontakty z piłką w polu karnym, a rywal tylko pięć.&amp;amp;nbsp;&lt;br&gt;&lt;br&gt;W zeszłym tygodniu los nie był już po stronie londyńczyków, którzy po bezbarwnej i przewidywalnej grze przegrali 0:1 z Newcastle i w niedzielnych derbach z Arsenalem potrzebują zdecydowanej poprawy. O to jednak nie będzie tak łatwo. Problemy, z którymi do tej pory Tottenham sobie radził, stały się ostatnio nie do przeskoczenia, a dotychczasowe metody ich rozwiązywania nie działają.&lt;br&gt;&lt;br&gt;O Spurs przez ostatnie kilka sezonów można było powiedzieć, że niezależnie od tego, co się wokół nich dzieje, zawsze znajdują jakieś rozwiązanie. Przez dwa sezony rozgrywali domowe spotkania nie na własnym stadionie, tylko na Wembley, a mimo to dobrze punktowali. Do klubu nie przychodzili nowi piłkarze, co z drugiej strony oznaczało, że ci, którzy już w nim byli, mogli się lepiej zgrać. Nawet kontuzja Harry’ego Kane’a, najlepszego strzelca i lidera zespołu, okazała się mniej bolesna dla drużyny, bo Tottenham bez niego potrafił zdobywać bramki i wygrywać. To wszystko trwało do czasu.&lt;br&gt;&lt;br&gt;Kibicom Tottenhamu łatwo byłoby w tym momencie stwierdzić, że na takie wnioski jest za wcześnie, skoro za nami dopiero trzy kolejki Premier League. Problem jednak w tym, że słaba gra ich klubu to nic nowego. Porażka z Newcastle w minioną niedzielę była już czternastą od początku roku 2019. Z ostatnich ośmiu ligowych meczów drużyna wygrała ledwie dwa, a z piętnastu – tylko cztery. W tym czasie awansowała wprawdz', '2019-09-01 00:29:51'),
(35, 5, 1, 'Rośnie nowa potęga', 'Nice pod wodzą nowego bogatego właściciela, firmy Ineos, ma włączyć się do walki o Ligę Mistrzów. W kolarstwie sponsorowana przez ten koncern grupa jest najlepsza na świecie.&lt;br&gt;&lt;br&gt;W Tour de France kolarze spod znaku Ineos zajęli dwa pierwsze miejsca. Wygrał Kolumbijczyk Egan Bernal, za nim wyścig ukończył Geraint Thomas. Teraz sponsorująca tę grupę (w jej barwach jeżdżą Michałowie Gołaś i Kwiatkowski) firma z branży petrochemicznej kupiła OGC Nice, a organ kontrolujący kluby Ligue 1 DNCG zatwierdził tę transakcję. Za przejęcie 100 procent akcji klubu Ineos zapłaciło 100 mln euro.&lt;br&gt;Prezes i założyciel firmy sir Jim Ratcliffe z majątkiem wynoszącym 21 mld funtów jest najbogatszym człowiekiem w Wielkiej Brytanii. W piłce będzie mu trudno o podobne sukcesy jak w kolarstwie, ale wygląda na to, że we francuskim futbolu pojawiła się nowa znacząca siła.&lt;br&gt;&lt;br&gt;Ratcliffe zaczął od sprowadzenia za 20,5 mln euro, z Ajaksu uważanego za wielki talent duńskiego napastnika Kaspera Dolberga którego kariera nie szła jednak ostatnio do przodu, i lewego pomocnika Alexisa Claude-Maurice’a z drugoligowego Lorient za 13 mln (14 goli w poprzednim sezonie Ligue 2). To dwa najwyższe transfery w historii klubu. Obaj mają po 21 lat, co pokazuje, w jakim kierunku pójdzie Nice. Ponadto wypożyczyło z Napoli 22-letniego Adama Ounasa.&lt;br&gt;&lt;br&gt;– Nie sądzę, byśmy sięgali po piłkarzy mających 27–28 lat. Skupimy się na młodych i utalentowanych zawodnikach. Oczywiście wiemy, że drużynie potrzeba też doświadczenia, ale jeśli chcemy, by ten projekt zakończył się sukcesem, musimy zainwestować w młodzież – powiedział Bob Ratcliffe, brat Jima, w wywiadzie dla lokalnego dziennika „Nice-Matin”.&lt;br&gt;', '2019-09-01 00:33:17'),
(36, 5, 1, '19-latek z Polski zadebiutował w PSG. Nie stracił gola', 'PSG bez problemów wygrało w Metz 2:0 w pierwszym spotkaniu 4. kolejki Ligue 1. W bramce mistrzów Francji zadebiutował 19-letni Marcin Bułka. Polski golkiper wiele się nie napracował.&lt;br&gt;&lt;br&gt;Wizyta paryżan w północnej Francji niespodziewanie stała się ciekawa dla każdego polskiego kibica. Między słupkami mistrzów Francji stanął 19-letni Marcin Bułka. Do PSG trafił latem z Chelsea. W Londynie grał głównie w zespołach U-18 i U-23. W pierwszej drużynie The Blues zagrał tylko w sparingach.&lt;br&gt;&lt;br&gt;Pierwszym bramkarzem klubu z Parku Książąt był dotychczas Alphonse Areola. Francuz w Metz usiadł na ławce, bowiem myślami jest już przy transferze do Realu Madryt. W odwrotną stronę za 15 mln euro ma powędrować Kostarykanin Keylor Navas, który ma dosyć roli rezerwowego w ekipie Królewskich.&lt;br&gt;&lt;br&gt;Piłkarze PSG nawet przez moment nie musieli martwić się o stratę punktów. Mistrzowie Francji bez trudu kontrolowali wydarzenia na murawie, a kontrataki Metz kończyły się bardzo niecelnymi strzałami. W pierwszej połowie Marcin Bułka tylko dwa razy odprowadził piłkę wzrokiem, gdy z okolic szesnastego metra uderzał Habib Diallo. Gdy w drugiej części spotkania mogło być ciekawie pod bramką Bułki, strzał Nguette&#039;a z łatwością zablokował Dagba.&lt;br&gt;&lt;br&gt;Polak mocno wynudził się w piątkowy wieczór.&amp;amp;amp;amp;nbsp;', '2019-09-01 00:50:52'),
(37, 5, 1, 'Sędzia przerwał spotkanie Ligue 1. Skandal na trybunach podczas meczu FC Metz - PSG', 'Spotkanie FC Metz z PSG zostało przerwane, bo kibice z Paryża wywiesili transparent, który sędzia uznał za homofobiczny.&lt;br&gt;&lt;br&gt;Była 21. minuta spotkania. Na trybunie zajmowanej przez fanów PSG pojawił się transparent kierowany do zarządzających francuskimi rozgrywkami (LFP). “LFP, pozwól mi śpiewać ci. I powiedzieć, żebyś się pie*****ła. Nie będziemy w telewizji, bo nasze słowa nie są zbyt radosne&quot;.&lt;br&gt;&lt;br&gt;Ostatnie słowo czyli &quot;gais&quot; w języku francuskim oznacza&amp;amp;nbsp; radosne&quot;, ale też &quot;gejowskie”. Transparent miał być nawiązaniem do piosenki “Balance ton quoi” belgijskiej piosenkarki Angele. Piosenka zwraca uwagę na problem agresji seksualnej. Arbiter Frank Schneider zdecydował się wstrzymać grę i zarządził zdjęcie transparentu. Po dwóch minutach kibice usunęli go z trybun.&amp;amp;nbsp;&lt;br&gt;&lt;br&gt;Incydent w Metz to kolejny odcinek walki władz francuskiego futbolu z homofobią na trybunach oraz dalsza część konfliktu pomiędzy nimi a kibicami. Część z nich nie może przyjąć do wiadomości, że wolno im mniej jeśli chodzi o wyrażanie podobnych treści. Swoim zachowaniem, tak jak podczas spotkania w Metz, prowokują sędziów do przerywania meczów.', '2019-09-01 00:53:41'),
(38, 7, 1, 'Sprzeczne informacje w sprawie Neymara. Media przedstawiają dwie wersje', '&quot;Transfer Brazylijczyka jest niemożliwy z powodu wysokich żądań PSG&quot; - podkreśla &quot;RAC1&quot;. &quot;Negocjacje nadal trwają&quot; - tłumaczy z kolei dziennikarz Guillem Balague. Przyszłość Neymara ciągle jest wielką niewiadomą.&lt;br&gt;&lt;br&gt;Wydawało się, że wszystko jest na najlepszej drodze, aby Neymar wrócił do FC Barcelona. Brazylijczyk był zdeterminowany, aby odejść z Paryża, w którym czuł się bardzo niekomfortowo. &quot;Duma Katalonii&quot; była w stanie poświęcić wiele, aby 27-latek z powrotem trafił na Camp Nou.&lt;br&gt;Paris Saint-Germain okazało się twardym negocjatorem.&amp;amp;nbsp;&lt;br&gt;&lt;br&gt;Mistrzowie Francji żądali 130 mln euro + trzech zawodników FC Barcelona: Jeana-Claira Todibo, Ivana Rakiticia oraz Ousmane Dembele. Na taką propozycję nie chciała zgodzić się Blaugrana, która oferowała jedynie dwóch piłkarzy i wysoką kwotę pieniędzy.', '2019-09-01 00:56:51'),
(39, 7, 1, 'Zaostrza się konflikt Icardiego z Interem Mediolan. Piłkarz pozwał do sądu swój klub', 'Coraz bardziej napięta sytuacja w Interze Mediolan. Icardi został odsunięty od treningów taktycznych z zespołem, nie gra, a jego ewentualny transfer także nie doszedł na razie do skutku. Piłkarz zdecydował się nawet pozwać swój klub do sądu.&lt;br&gt;&lt;br&gt;Mauro Icardi zarzuca działaczom Interu Mediolan dyskryminację, ponieważ jego wizerunek usuwany jest z kampanii reklamowych klubu, nie bierze udział w sesjach zdjęciowych, zabrano mu numer 9 na koszulce na rzecz Romelu Lukaku, a co najważniejsze - nie może uczestniczyć w treningach taktycznych zespołu.&amp;amp;nbsp;&lt;br&gt;&lt;br&gt;26-letni piłkarz domaga się natychmiastowego przywrócenia do zajęć z zespołem i odszkodowania w wysokości 1,5 miliona euro - czytamy w serwisie &quot;football-italia.net&quot;. Najprawdopodobniej takie działanie piłkarza ma wymusić na działaczach Interu zgodę na transfer Argentyńczyka.&lt;br&gt;&lt;br&gt;&quot;La Gazetta Dello Sport&quot; twierdzi, że wyrok po oskarżeniach Icardiego może zapasać nawet dopiero za 3 miesiące. Dlatego Icardi najprawdopodobniej założył tą sprawę, żeby przestraszyć szefów Interu i jeszcze do poniedziałku 2 września (tego dnia zamyka się okno transferowe) otrzymać zgodę na transfer na swoich warunkach (podpisanie nowego kontraktu z Interem i pójście na roczne wypożyczenie.', '2019-09-01 01:00:21'),
(40, 7, 1, 'Real Madryt nie powiedział jeszcze ostatniego słowa. Zidane nie wyklucza kolejnych ruchów', '- Do poniedziałku może się wszystko zdarzyć - mówi tajemniczo Zinedine Zidane. Real Madryt nadal jest aktywny na rynku i niewykluczone, że do zamknięcia okna transferowego jeszcze wzmocni skład.&lt;br&gt;&lt;br&gt;Okno transferowe zamknie się w najbliższy poniedziałek (2 września), a Real Madryt do wydania ma jeszcze mnóstwo pieniędzy. Konkretnie: 155 mln euro. Niewykluczone, że pieniądze do poniedziałku znikną z klubowej kasy, bo Królewscy nie powiedzieli jeszcze ostatniego słowa na transferowym rynku.&lt;br&gt;&lt;br&gt;- Wszystko się może zdarzyć - stwierdza Zinedine Zidane, zapytany o szanse na podpisanie piłkarzy jeszcze przed zamknięciem okna transferowego. - Może być jeszcze jedna, a nawet dwie bomby - zdradza francuski menedżer Realu Madryt.&lt;br&gt;&lt;br&gt;Nie jest tajemnicą, że Zinedine Zidane tego lata mocno chciał (chce?) pozyskać Paula Pogbę. I choć temat zdawał się być zakończony, &quot;Marca&quot; przekonuje, że klub ze stolicy Hiszpanii jeszcze nie zrezygnował z reprezentanta Francji. Być może to właśnie Pogba będzie tym, który za pięć dwunasta dołączy do Realu. A jeśli nie, Zidane i tak płakał nie będzie.&lt;br&gt;&lt;br&gt;- Mam taki skład, jaki mam. Jestem dumny z graczy, których posiadam. Dla mnie oni są najlepsi. Najważniejsze jest to, że na początku sezonu czuję się swobodnie. Nie mogę narzekać na drużynę. Każdy trener chciałby mieć taki zespół - podkreśla Zidane.', '2019-09-01 01:04:14');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nick` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `typ` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `nick`, `email`, `haslo`, `typ`) VALUES
(1, 'admin', 'admin@admin.pl', '$2y$10$.XhcrX7Yo22qG4WaMrolr.Cq1VPBjrbWXDgECpb1FcNYWyxNcLgdK', 'admin'),
(2, 'uzytkownik', 'email@email.com', '$2y$10$yBHT4WqpT3GWPxSujg06mesKIQTNtL9HfBDRIsIvlq08/UXpxfg9u', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `druzyny`
--
ALTER TABLE `druzyny`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `idPosta` (`idPosta`);

--
-- Indeksy dla tabeli `mecze`
--
ALTER TABLE `mecze`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teamaid` (`teamaid`),
  ADD KEY `teambid` (`teambid`);

--
-- Indeksy dla tabeli `posty`
--
ALTER TABLE `posty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKategorii` (`idKategorii`),
  ADD KEY `userid` (`userid`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `druzyny`
--
ALTER TABLE `druzyny`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `mecze`
--
ALTER TABLE `mecze`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `posty`
--
ALTER TABLE `posty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD CONSTRAINT `komentarze_ibfk_1` FOREIGN KEY (`idPosta`) REFERENCES `posty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentarze_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `posty`
--
ALTER TABLE `posty`
  ADD CONSTRAINT `posty_ibfk_1` FOREIGN KEY (`idKategorii`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posty_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
