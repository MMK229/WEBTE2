-- phpMyAdmin SQL Dump
-- version 5.2.2deb1+noble1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2025 at 11:05 PM
-- Server version: 8.0.42-0ubuntu0.24.04.1
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `area` varchar(100) COLLATE utf8mb4_slovak_ci NOT NULL,
  `area_en` varchar(100) COLLATE utf8mb4_slovak_ci NOT NULL,
  `text_sk` text COLLATE utf8mb4_slovak_ci NOT NULL,
  `text_en` text COLLATE utf8mb4_slovak_ci NOT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `area`, `area_en`, `text_sk`, `text_en`, `correct_answer`) VALUES
(1, 'Funkcie', 'Functions', 'MC: Je daná lineárna funkcia ( f(x) = 2x + 4 ). Nájdite jej nulové body.---\r\nA) Má jeden nulový bod: 4\r\nB) Žiadna z ostatných odpovedí nie je pravdivá.\r\nC) Má dva nulové body: 2 a 4\r\nD) Má jeden nulový bod: 2\r\nE) Nemá žiaden nulový bod.', 'MC: A linear function is given as ( f(x) = 2x + 4 ). Find its zero(s).---\r\nA) Has one zero: 4\r\nB) None of the other answers is correct.\r\nC) Has two zeros: 2 and 4\r\nD) Has one zero: 2\r\nE) Has no zero.', 'B'),
(4, 'Geometria', 'Geometry', 'MC: Uvažujme dva sústredné kruhy s polomermi ( r_1 ) a ( r_2 ). Vyberte veľkosti polomerov tak, aby veľkosť plochy medzikružia bola ( 3pi ).---\r\nA) ( r_1 = frac{3}{2}, r_2 = 3 )\r\nB) ( r_1 = 1, r_2 = 4 )\r\nC) ( r_1 = sqrt{5}, r_2 = 2sqrt{2} )\r\nD) ( r_1 = 3, r_2 = 12 )\r\nE) ( r_1 = sqrt{12}, r_2 = sqrt{6} )', 'MC: Consider two concentric circles with radii ( r_1 ) and ( r_2 ). Choose the radii so that the area of the ring is ( 3pi ).---\r\nA) ( r_1 = frac{3}{2}, r_2 = 3 )\r\nB) ( r_1 = 1, r_2 = 4 )\r\nC) ( r_1 = sqrt{5}, r_2 = 2sqrt{2} )\r\nD) ( r_1 = 3, r_2 = 12 )\r\nE) ( r_1 = sqrt{12}, r_2 = sqrt{6} )', 'C'),
(5, 'Rovnice', 'Equations', 'MC: Rovnica ( 2^x + frac{1}{2^x} = 2 )---\r\nA) má práve dve riešenia, ktorých súčin je 1.\r\nB) má práve dve riešenia, ktorých súčet je 2.\r\nC) má práve jedno riešenie.\r\nD) nemá žiadne riešenie.\r\nE) má práve dve riešenia, ktorých súčet je 0.', 'MC: Equation ( 2^x + frac{1}{2^x} = 2 )---\r\nA) has exactly two solutions whose product is 1.\r\nB) has exactly two solutions whose sum is 2.\r\nC) has exactly one solution.\r\nD) has no solution.\r\nE) has exactly two solutions whose sum is 0.', 'C'),
(6, 'Postupnosti', 'Sequences', 'MC: Nájdite súčet prvých piatich členov aritmetickej postupnosti ( a_1 + a_2 + a_3 + a_4 + a_5 ), ak viete, že ( a_2 + a_3 + a_4 = 9 )---\r\nA) ( a_1 + a_2 + a_3 + a_4 + a_5 = 18 )\r\nB) ( a_1 + a_2 + a_3 + a_4 + a_5 = 6 )\r\nC) Z uvedených údajov sa to nedá vypočítať.\r\nD) ( a_1 + a_2 + a_3 + a_4 + a_5 = 15 )\r\nE) ( a_1 + a_2 + a_3 + a_4 + a_5 = 9 )', 'MC: Find the sum of the first five terms of the arithmetic sequence ( a_1 + a_2 + a_3 + a_4 + a_5 ), given that ( a_2 + a_3 + a_4 = 9 )---\r\nA) ( a_1 + a_2 + a_3 + a_4 + a_5 = 18 )\r\nB) ( a_1 + a_2 + a_3 + a_4 + a_5 = 6 )\r\nC) It cannot be determined from the given data.\r\nD) ( a_1 + a_2 + a_3 + a_4 + a_5 = 15 )\r\nE) ( a_1 + a_2 + a_3 + a_4 + a_5 = 9 )', 'D'),
(7, 'Rovnice', 'Equations', 'MC: Kvadratická rovnica ( 3x^2 + 2x - 3 = 0 ) má:---\r\nA) Práve jedno riešenie.\r\nB) Práve dve riešenia, ktorých súčin je číslo ( -3 ).\r\nC) Práve dve záporné riešenia.\r\nD) Práve dve riešenia, ktorých súčin je číslo ( -1 ).\r\nE) Práve dve kladné riešenia.', 'MC: The quadratic equation ( 3x^2 + 2x - 3 = 0 ) has:---\r\nA) Exactly one solution.\r\nB) Exactly two solutions with product ( -3 ).\r\nC) Exactly two negative solutions.\r\nD) Exactly two solutions with product ( -1 ).\r\nE) Exactly two positive solutions.', 'D'),
(8, 'Rovnice', 'Equations', 'MC: Výraz ( frac{a^2 - 2ab + b^2}{a^3 - a^2b - ab^2 + b^3} ) sa pre ( a \ne b land a \ne -b ) rovná výrazu:---\r\nA) ( frac{1}{a - b} )\r\nB) Žiadna z ostatných odpovedí nie je správna\r\nC) ( a + b )\r\nD) ( frac{1}{a + b} )\r\nE) ( a - b )', 'MC: The expression ( frac{a^2 - 2ab + b^2}{a^3 - a^2b - ab^2 + b^3} ), for ( a \ne b land a \ne -b ), is equal to:---\r\nA) ( frac{1}{a - b} )\r\nB) None of the other answers is correct\r\nC) ( a + b )\r\nD) ( frac{1}{a + b} )\r\nE) ( a - b )', 'D'),
(9, 'Rovnice', 'Equations', 'MC: Rovnicia ( sqrt{1 + x - 2x^2} = sqrt{x} ) (v ( mathbb{R} ))---\r\nA) nemá žiadne riešenie.\r\nB) má práve dva iracionálne korene.\r\nC) má práve dva korene, ktorých súčin je ( -frac{1}{2} ).\r\nD) má práve jeden celočíselný koreň.\r\nE) má práve jeden koreň.', 'MC: The equation ( sqrt{1 + x - 2x^2} = sqrt{x} ) (in ( mathbb{R} ))---\r\nA) has no solution.\r\nB) has exactly two irrational roots.\r\nC) has exactly two roots whose product is ( -frac{1}{2} ).\r\nD) has exactly one integer root.\r\nE) has exactly one root.', 'E'),
(10, 'Geometria', 'Geometry', 'WA: Dĺžky uhlopriečok kosoštvorca sú 6 a 8 cm. Jeho obvod je (v centimetroch)?', 'WA: The diagonals of a rhombus are 6 cm and 8 cm. Its perimeter is (in centimeters)?', '20'),
(11, 'Kombinatorika', 'Combinatorics', 'MC: Koľko je štvorciferných čísel, ktoré majú vo svojom zápise všetky cifry rôzne?---\r\nA) 9 · 9 · 8 · 7\r\nB) 10 · 9 · 8 · 6\r\nC) 10 · 9 · 8 · 7\r\nD) 9000\r\nE) Žiadna z ostatných odpovedí nie je správna.', 'MC: How many four-digit numbers have all digits different?---\r\nA) 9 · 9 · 8 · 7\r\nB) 10 · 9 · 8 · 6\r\nC) 10 · 9 · 8 · 7\r\nD) 9000\r\nE) None of the other answers is correct.', 'A'),
(12, 'Geometria', 'Geometry', 'MC: Nájdite počet priesečníkov grafu funkcie ( f(x) = x^2 - 2x + 2 ) a priamky ( y = 1 ).---\r\nA) Žiadna z ostatných odpovedí nie je správna.\r\nB) Majú práve tri priesečníky.\r\nC) Majú práve jeden priesečník.\r\nD) Majú práve dva priesečníky.\r\nE) Nemajú žiadny priesečník.', 'MC: Find the number of intersections between the graph of the function ( f(x) = x^2 - 2x + 2 ) and the line ( y = 1 ).---\r\nA) None of the other answers is correct.\r\nB) They intersect at exactly three points.\r\nC) They intersect at exactly one point.\r\nD) They intersect at exactly two points.\r\nE) They do not intersect.', 'C'),
(13, 'Rovnice', 'Equations', 'MC: Množina všetkých riešení rovnice ( sin x = cos x ) je:---\r\nA) ( {kpi; , k in mathbb{Z} } cup left{ frac{pi}{4} + kpi; , k in mathbb{Z} \right} )\r\nB) ( left{ frac{pi}{4} + kpi; , k in mathbb{Z} \right} )\r\nC) ( left{ frac{pi}{4} + 2kpi; , k in mathbb{Z} \right} )\r\nD) ( {kpi; , k in mathbb{Z} } )\r\nE) prázdna množina.', 'MC: The set of all solutions of the equation ( sin x = cos x ) is:---\r\nA) ( {kpi; , k in mathbb{Z} } cup left{ frac{pi}{4} + kpi; , k in mathbb{Z} \right} )\r\nB) ( left{ frac{pi}{4} + kpi; , k in mathbb{Z} \right} )\r\nC) ( left{ frac{pi}{4} + 2kpi; , k in mathbb{Z} \right} )\r\nD) ( {kpi; , k in mathbb{Z} } )\r\nE) the empty set.', 'B'),
(14, 'Algebra', 'Algebra', 'MC: Spoločný menovateľ zlomkov ( frac{x+1}{x-1}, frac{x-1}{x+1}, frac{1}{1+x^2} ) je:---\r\nA) Žiadna z ostatných odpovedí nie je správna.\r\nB) ( 1 - x^2 )\r\nC) ( 1 + x^2 )\r\nD) ( x^4 - 1 )\r\nE) ( x )', 'MC: The least common denominator of the fractions ( frac{x+1}{x-1}, frac{x-1}{x+1}, frac{1}{1+x^2} ) is:---\r\nA) None of the other answers is correct.\r\nB) ( 1 - x^2 )\r\nC) ( 1 + x^2 )\r\nD) ( x^4 - 1 )\r\nE) ( x )', 'D'),
(15, 'Logaritmy', 'Logarithms', 'WA: Ak ( log 3 = a ) a ( log 2 = b ), čomu sa rovná ( log 12 )?', 'WA: If ( log 3 = a ) and ( log 2 = b ), what is the value of ( log 12 )?', 'a + 2b'),
(16, 'Teória čísel', 'Number theory', 'MC: Každý prvok množiny ( M ) je prirodzené číslo, ktoré je deliteľné práve dvoma číslami z trojice čísel 3, 11, 33. Vyberte množinu s touto vlastnosťou.---\r\nA) ( M = {kpi; k in mathbb{Z}} cup {frac{pi}{4} + kpi; k in mathbb{Z}} )\r\nB) ( M = {11, 22, 33} )\r\nC) ( M = {75, 121, 758961} )\r\nD) ( M = {174, 2772, 358479} )\r\nE) ( M = emptyset )', 'MC: Each element of the set ( M ) is a natural number divisible by exactly two numbers from the set {3, 11, 33}. Choose the correct set.---\r\nA) ( M = {kpi; k in mathbb{Z}} cup {frac{pi}{4} + kpi; k in mathbb{Z}} )\r\nB) ( M = {11, 22, 33} )\r\nC) ( M = {75, 121, 758961} )\r\nD) ( M = {174, 2772, 358479} )\r\nE) ( M = emptyset )', 'E'),
(17, 'Rovnice', 'Equations', 'MC: Riešte nerovnicu ( left| frac{x-3}{2x-5} \right| geq 1 ). Množina všetkých jej riešení je:---\r\nA) ( langle 2, frac{8}{3} \rangle )\r\nB) Žiadna z ostatných odpovedí nie je správna.\r\nC) ( langle 2, frac{5}{2} \rangle cup langle frac{5}{2}, frac{8}{3} \rangle )\r\nD) ( langle 2, frac{5}{2} \rangle cup langle frac{5}{2}, frac{8}{3} ) )\r\nE) ( langle 2, frac{5}{2} \rangle )', 'MC: Solve the inequality ( left| frac{x-3}{2x-5} \right| geq 1 ). The set of all its solutions is:---\r\nA) ( langle 2, frac{8}{3} \rangle )\r\nB) None of the other answers is correct.\r\nC) ( langle 2, frac{5}{2} \rangle cup langle frac{5}{2}, frac{8}{3} \rangle )\r\nD) ( langle 2, frac{5}{2} \rangle cup langle frac{5}{2}, frac{8}{3} ) )\r\nE) ( langle 2, frac{5}{2} \rangle )', 'C'),
(18, 'Logika', 'Logic', 'MC: O trojuholníku ( ABC ) je vyslovený výrok: Ak má trojuholník ( ABC ) zhodné uhly pri vrcholoch ( A ) a ( B ), tak je rovnostranný. Negáciou tohto výroku je výrok:---\r\nA) Ak má trojuholník ( ABC ) zhodné uhly pri vrcholoch ( A ) a ( B ), tak je rovnoramenný.\r\nB) Ak je trojuholník ( ABC ) rovnostranný, tak má zhodné uhly pri vrcholoch ( A ) a ( B ).\r\nC) Trojuholník ( ABC ) má zhodné uhly pri vrcholoch ( A ) a ( B ), a nie je rovnostranný.\r\nD) Trojuholník ( ABC ) je rovnostranný a nemá zhodné uhly pri vrcholoch ( A ) a ( B ).\r\nE) Ak má trojuholník ( ABC ) zhodné uhly pri vrcholoch ( A, B ) a ( C ), tak je rovnostranný.', 'MC: A triangle ( ABC ) is described by the statement: If triangle ( ABC ) has equal angles at vertices ( A ) and ( B ), then it is equilateral. The negation of this statement is:---\r\nA) If triangle ( ABC ) has equal angles at vertices ( A ) and ( B ), then it is isosceles.\r\nB) If triangle ( ABC ) is equilateral, then it has equal angles at vertices ( A ) and ( B ).\r\nC) Triangle ( ABC ) has equal angles at vertices ( A ) and ( B ), and is not equilateral.\r\nD) Triangle ( ABC ) is equilateral and does not have equal angles at vertices ( A ) and ( B ).\r\nE) If triangle ( ABC ) has equal angles at vertices ( A ), ( B ), and ( C ), then it is equilateral.', 'C'),
(19, 'Funkcie', 'Functions', 'MC: Je daná lineárna funkcia ( f(x) = 3x - 1 ). Nájdite jej nulové body.---\r\nA) Žiadna z ostatných odpovedí nie je pravdivá.\r\nB) Nemá žiaden nulový bod.\r\nC) Má dva nulové body: 1 a 3\r\nD) Má jeden nulový bod: ( frac{1}{3} )\r\nE) Má jeden nulový bod: 1', 'MC: The linear function ( f(x) = 3x - 1 ) is given. Find its zeros.---\r\nA) None of the other answers is correct.\r\nB) It has no zeros.\r\nC) It has two zeros: 1 and 3\r\nD) It has one zero: ( frac{1}{3} )\r\nE) It has one zero: 1', 'D'),
(20, 'Rovnice', 'Equations', 'MC: Kvadratická rovnica ( 2x^2 + x - 5 = 0 ) má:---\r\nA) Práve jedno riešenie.\r\nB) Práve dve záporné riešenia.\r\nC) Práve dve riešenia, ktorých súčin je číslo (-5).\r\nD) Práve dve riešenia, ktorých súčet je číslo (-frac{1}{2}).\r\nE) Práve dve kladné riešenia.', 'MC: The quadratic equation ( 2x^2 + x - 5 = 0 ) has:---\r\nA) Exactly one solution.\r\nB) Exactly two negative solutions.\r\nC) Exactly two solutions whose product is (-5).\r\nD) Exactly two solutions whose sum is (-frac{1}{2}).\r\nE) Exactly two positive solutions.', 'D'),
(21, 'Rovnice', 'Equations', 'MC: Rovnicia ( sqrt{-x^2 - 2x - 9} = sqrt{x} ) (v ( mathbb{R} ))---\r\nA) má práve jeden celočíselný koreň\r\nB) má práve dva korene, ktorých súčet je ( frac{5}{2} )\r\nC) má práve dva iracionálne korene\r\nD) má práve dva korene, ktorých súčin je ( frac{3}{2} )\r\nE) nemá žiadne riešenie', 'MC: The equation ( sqrt{-x^2 - 2x - 9} = sqrt{x} ) (in ( mathbb{R} ))---\r\nA) has exactly one integer solution\r\nB) has exactly two solutions whose sum is ( frac{5}{2} )\r\nC) has exactly two irrational solutions\r\nD) has exactly two solutions whose product is ( frac{3}{2} )\r\nE) has no solution', 'E'),
(22, 'Rovnice', 'Equations', 'MC: Riešte nerovnicu ( frac{x^2 - 8x + 15}{x + 1} geq 2 ). Množina všetkých jej riešení je---\r\nA) Žiadna z ostatných odpovedí nie je správna.\r\nB) ( left(-infty, 1\right) cup left( frac{3}{2}, infty \right) )\r\nC) ( left( frac{3}{2}, infty \right) )\r\nD) ( (-1, 1) cup left( frac{3}{2}, infty \right) )\r\nE) ( (1, infty) )', 'MC: Solve the inequality ( frac{x^2 - 8x + 15}{x + 1} geq 2 ). The set of all its solutions is---\r\nA) None of the other answers is correct.\r\nB) ( left(-infty, 1\right) cup left( frac{3}{2}, infty \right) )\r\nC) ( left( frac{3}{2}, infty \right) )\r\nD) ( (-1, 1) cup left( frac{3}{2}, infty \right) )\r\nE) ( (1, infty) )', 'D'),
(23, 'Teória čísel', 'Number theory', 'MC: M je množina všetkých dvojciferných prirodzených čísel, ktoré sú deliteľné štyrmi a šiestimi, a nie sú deliteľné ôsmimi. Vyberte množinu M.---\r\nA) ( M = {36, 72} )\r\nB) ( M = {12, 36, 60, 84} )\r\nC) ( M = emptyset )\r\nD) ( M = {12, 24, 36, 48, 60, 72, 84, 96} )\r\nE) ( M = {24, 48, 72, 96} )', 'MC: Let M be the set of all two-digit natural numbers divisible by 4 and 6 but not by 8. Choose the set M.---\r\nA) ( M = {36, 72} )\r\nB) ( M = {12, 36, 60, 84} )\r\nC) ( M = emptyset )\r\nD) ( M = {12, 24, 36, 48, 60, 72, 84, 96} )\r\nE) ( M = {24, 48, 72, 96} )', 'B'),
(24, 'Kombinatorika', 'Combinatorics', 'MC: Koľko je štvorciferných čísel, ktoré majú vo svojom zápise dve párne a dve nepárne cifry? (Nulu považujte za párnu cifru.)---\r\nA) ( 5^3 cdot 4 )\r\nB) ( 5^3 cdot 3^3 )\r\nC) ( 10 cdot 10 cdot 5 cdot 5 )\r\nD) ( 5^4 )\r\nE) Žiadna z ostatných odpovedí nie je správna.', 'MC: How many four-digit numbers contain exactly two even and two odd digits? (Zero is considered even.)---\r\nA) ( 5^3 cdot 4 )\r\nB) ( 5^3 cdot 3^3 )\r\nC) ( 10 cdot 10 cdot 5 cdot 5 )\r\nD) ( 5^4 )\r\nE) None of the other answers is correct.', 'E'),
(25, 'Logaritmy', 'Logarithms', 'MC: Ak ( log 3 = a ) a ( log 4 = b ), čomu sa rovná ( log 6 )?---\r\nA) ( frac{1}{2}ab )\r\nB) ( a + sqrt{b} )\r\nC) ( 3b )\r\nD) ( a + b )\r\nE) ( 2a )', 'MC: If ( log 3 = a ) and ( log 4 = b ), what is ( log 6 )?---\r\nA) ( frac{1}{2}ab )\r\nB) ( a + sqrt{b} )\r\nC) ( 3b )\r\nD) ( a + b )\r\nE) ( 2a )', 'D'),
(26, 'Postupnosti', 'Sequences', 'MC: Nájdite stý člen ( a_{100} ) aritmetickej postupnosti ( {a_n}_{n=1}^{infty} ), ak ( a_{n+1} = a_n - frac{1}{3} ) a ( a_1 = 65 ).---\r\nA) ( a_{100} = -frac{100}{3} )\r\nB) ( a_{100} = 32 )\r\nC) ( a_{100} = frac{95}{3} )\r\nD) ( a_{100} = frac{194}{3} )\r\nE) ( a_{100} = 0 )', 'MC: Find the 100th term ( a_{100} ) of the arithmetic sequence ( {a_n}_{n=1}^{infty} ), given that ( a_{n+1} = a_n - frac{1}{3} ) and ( a_1 = 65 ).---\r\nA) ( a_{100} = -frac{100}{3} )\r\nB) ( a_{100} = 32 )\r\nC) ( a_{100} = frac{95}{3} )\r\nD) ( a_{100} = frac{194}{3} )\r\nE) ( a_{100} = 0 )', 'B'),
(27, 'Geometria', 'Geometry', 'MC: V rovine leží priamka ( p ) a bod ( A ). Vzdialenosť bodu ( A ) od priamky ( p ) je 1. Na priamke ( p ) ležia body ( B ) a ( C ). Trojuholník ( ABC ) je rovnostranný. Aká je dĺžka strany ( BC )?---\r\nA) ( frac{1}{sqrt{3}} )\r\nB) Žiadna z ostatných odpovedí nie je správna.\r\nC) 1\r\nD) ( frac{2}{sqrt{3}} )\r\nE) ( sqrt{3} )', 'MC: In the plane, line ( p ) and point ( A ) are given. The distance from ( A ) to ( p ) is 1. Points ( B ) and ( C ) lie on ( p ). Triangle ( ABC ) is equilateral. What is the length of side ( BC )?---\r\nA) ( frac{1}{sqrt{3}} )\r\nB) None of the other answers is correct.\r\nC) 1\r\nD) ( frac{2}{sqrt{3}} )\r\nE) ( sqrt{3} )', 'D'),
(28, 'Rovnice', 'Equations', 'MC: Rovnica ( 4^x - 2^x = 2 )---\r\nA) nemá žiadne riešenie.\r\nB) má práve jedno riešenie.\r\nC) má práve dve riešenia, ktorých súčet je 1.\r\nD) má práve dve riešenia, ( x = 0 ) a ( x = 1 ).\r\nE) má práve dve riešenia, ktorých súčet je -1.', 'MC: The equation ( 4^x - 2^x = 2 )---\r\nA) has no solution.\r\nB) has exactly one solution.\r\nC) has exactly two solutions whose sum is 1.\r\nD) has exactly two solutions, ( x = 0 ) and ( x = 1 ).\r\nE) has exactly two solutions whose sum is -1.', 'B'),
(29, 'Algebra', 'Algebra', 'MC: Výraz ( frac{1 - sqrt{a}}{1 + sqrt{a}} : frac{1 - a}{1 + a} ) sa pre ( a geq 0,  a \neq 1 ) rovná výrazu:---\r\nA) ( frac{2sqrt{a}}{1 + 2sqrt{a} + a} )\r\nB) ( frac{1 + sqrt{a}}{1 - sqrt{a}} )\r\nC) Žiadna z ostatných odpovedí nie je správna\r\nD) ( frac{1}{1 + a} )\r\nE) ( frac{1}{4} )', 'MC: The expression ( frac{1 - sqrt{a}}{1 + sqrt{a}} : frac{1 - a}{1 + a} ) for ( a geq 0,  a \neq 1 ) equals:---\r\nA) ( frac{2sqrt{a}}{1 + 2sqrt{a} + a} )\r\nB) ( frac{1 + sqrt{a}}{1 - sqrt{a}} )\r\nC) None of the other answers is correct\r\nD) ( frac{1}{1 + a} )\r\nE) ( frac{1}{4} )', 'A'),
(30, 'Algebra', 'Algebra', 'MC: Spoločný menovateľ zlomkov ( frac{x}{x+1},  frac{x-1}{x},  frac{x}{x+2} ) je:---\r\nA) ( x^2 - x - 2 )\r\nB) Žiadna z ostatných odpovedí nie je správna\r\nC) ( x - 2 )\r\nD) ( x )\r\nE) ( x + 1 )', 'MC: The least common denominator of the fractions ( frac{x}{x+1},  frac{x-1}{x},  frac{x}{x+2} ) is:---\r\nA) ( x^2 - x - 2 )\r\nB) None of the other answers is correct\r\nC) ( x - 2 )\r\nD) ( x )\r\nE) ( x + 1 )', 'A'),
(31, 'Geometria', 'Geometry', 'MC: Nájdite počet priesečníkov grafu funkcie ( f(x) = x^2 - 3x + 4 ) a priamky ( y = x ).---\r\nA) Nemajú žiadny priesečník.\r\nB) Majú práve tri priesečníky.\r\nC) Žiadna z ostatných odpovedí nie je správna.\r\nD) Majú práve jeden priesečník.\r\nE) Majú práve dva priesečníky.', 'MC: Find the number of intersections between the graph of the function ( f(x) = x^2 - 3x + 4 ) and the line ( y = x ).---\r\nA) They have no intersection points.\r\nB) They have exactly three intersections.\r\nC) None of the other answers is correct.\r\nD) They have exactly one intersection.\r\nE) They have exactly two intersections.', 'D'),
(32, 'Rovnice', 'Equations', 'MC: Množina všetkých riešení rovnice ( mathrm{tg},x = mathrm{cotg},x ) je---\r\nA) ( {kpi; k in mathbb{Z} } )\r\nB) prázdna množina\r\nC) ( left{ frac{pi}{4} + kpi; k in mathbb{Z} \right} )\r\nD) ( left{ frac{pi}{4} + kpi; k in mathbb{Z} \right} cup left{ frac{3pi}{4} + kpi; k in mathbb{Z} \right} )\r\nE) ( left{ frac{3pi}{4} + kpi; k in mathbb{Z} \right} )', 'MC: The set of all solutions of the equation ( 	an x = cot x ) is---\r\nA) ( {kpi; k in mathbb{Z} } )\r\nB) the empty set\r\nC) ( left{ frac{pi}{4} + kpi; k in mathbb{Z} \right} )\r\nD) ( left{ frac{pi}{4} + kpi; k in mathbb{Z} \right} cup left{ frac{3pi}{4} + kpi; k in mathbb{Z} \right} )\r\nE) ( left{ frac{3pi}{4} + kpi; k in mathbb{Z} \right} )', 'C'),
(33, 'Rovnice', 'Equations', 'MC: Riešením rovnice ( log_{x-1} 8 = 3 ) je---\nA) ( x = 3 )\nB) ( x = 1 )\nC) ( x = 2 )\nD) ( x = 4 )\nE) ( x = 5 )', 'MC: The solution of the equation ( log_{x-1} 8 = 3 ) is---\nA) ( x = 3 )\nB) ( x = 1 )\nC) ( x = 2 )\nD) ( x = 4 )\nE) ( x = 5 )', 'A'),
(34, 'Rovnice', 'Equations', 'MC: Riešením rovnice ( frac{1}{5^{x-1}} = 25 ) je---\nA) ( x = -1 )\nB) ( x = 1 )\nC) ( x = 2 )\nD) ( x = 0 )\nE) ( x = 3 )', 'MC: The solution of the equation ( frac{1}{5^{x-1}} = 25 ) is---\nA) ( x = -1 )\nB) ( x = 1 )\nC) ( x = 2 )\nD) ( x = 0 )\nE) ( x = 3 )', 'A'),
(35, 'Algebra', 'Algebra', 'MC: Spoločný menovateľ zlomkov ( frac{x}{x-2}, frac{x}{x+2} ) je---\nA) ( x + 2 )\nB) ( x^2 )\nC) ( x^2 - 4 )\nD) ( x - 2 )\nE) Žiadna z ostatných odpovedí nie je správna', 'MC: The least common denominator of fractions ( frac{x}{x-2}, frac{x}{x+2} ) is---\nA) ( x + 2 )\nB) ( x^2 )\nC) ( x^2 - 4 )\nD) ( x - 2 )\nE) None of the other answers is correct', 'C'),
(36, 'Rovnice', 'Equations', 'MC: Kvadratický trojčlen ( 3x^2 + 9x - 12 ) má rozklad---\nA) ( 3(x + 1)(x - 4) )\nB) ( (x - 3)(x + 4) )\nC) ( (x + 1)(x + 4) )\nD) ( 3(x + 4)(x - 1) )\nE) ( 3(x - 2)(x + 2) )', 'MC: The quadratic trinomial ( 3x^2 + 9x - 12 ) factors as---\nA) ( 3(x + 1)(x - 4) )\nB) ( (x - 3)(x + 4) )\nC) ( (x + 1)(x + 4) )\nD) ( 3(x + 4)(x - 1) )\nE) ( 3(x - 2)(x + 2) )', 'D'),
(37, 'Rovnice', 'Equations', 'MC: Riešenie nerovnice ( frac{1 - x}{x + 5} geq 2 ) je---\nA) ( (-5, -3) )\nB) Žiadna z ostatných odpovedí nie je správna\nC) ( (-infty, -5) cup (-3, infty) )\nD) ( (-infty, -5) cup (-3, 0) )\nE) ( (-5, -3) )', 'MC: The solution of the inequality ( frac{1 - x}{x + 5} geq 2 ) is---\nA) ( (-5, -3) )\nB) None of the other answers is correct\nC) ( (-infty, -5) cup (-3, infty) )\nD) ( (-infty, -5) cup (-3, 0) )\nE) ( (-5, -3) )', 'C'),
(38, 'Funkcie', 'Functions', 'MC: Funkcia ( f(x) = log(3 - x) ) má definičný obor---\nA) ( (-3, 3) )\nB) ( (-infty, -3) )\nC) ( (-infty, 3) )\nD) ( (-infty, 0) )\nE) ( (-3, 0) )', 'MC: The function ( f(x) = log(3 - x) ) has a domain---\nA) ( (-3, 3) )\nB) ( (-infty, -3) )\nC) ( (-infty, 3) )\nD) ( (-infty, 0) )\nE) ( (-3, 0) )', 'C'),
(39, 'Logika', 'Logic', 'MC: Z výroku: Bod A nie je priesečníkom priamok ( p ) a ( q ), vyplýva---\nA) Bod A neleží na priamke ( p ) alebo ( q )\nB) Bod A neleží ani na priamke ( p ), ani ( q )\nC) Priamky ( p ) a ( q ) sú rovnobežné\nD) Buď ( p ) alebo ( q ) nie je priamka\nE) Priamky ( p ) a ( q ) majú iný priesečník', 'MC: From the statement: Point A is not the intersection of lines ( p ) and ( q ), it follows---\nA) Point A is not on line ( p ) or ( q )\nB) Point A is on neither line ( p ) nor ( q )\nC) Lines ( p ) and ( q ) are parallel\nD) Either ( p ) or ( q ) is not a line\nE) Lines ( p ) and ( q ) intersect elsewhere', 'A'),
(40, 'Rovnice', 'Equations', 'MC: Riešenie rovnice ( 2^{x+1} = 4^{x-3} ) patrí do---\nA) množiny ( (-infty, 0) cup (0, infty) )\nB) intervalu ( (2, 3) )\nC) intervalu ( (1, 2) )\nD) intervalu ( (0, 1) )\nE) intervalu ( (1, infty) )', 'MC: The solution to the equation ( 2^{x+1} = 4^{x-3} ) belongs to---\nA) set ( (-infty, 0) cup (0, infty) )\nB) interval ( (2, 3) )\nC) interval ( (1, 2) )\nD) interval ( (0, 1) )\nE) interval ( (1, infty) )', 'B'),
(41, 'Algebra', 'Algebra', 'MC: Výraz ( left( frac{1}{a} + 1 \right) : left( a + 2 + frac{1 - 2(a+1)^2}{a} \right) ) sa pre ( a \neq 0 ), ( a \neq -1 ) rovná výrazu---\nA) Žiadna z ostatných odpovedí nie je správna\nB) ( frac{1}{2a} )\nC) ( frac{1}{a} )\nD) ( frac{1}{2} )\nE) ( frac{1}{1 + a} )', 'MC: The expression ( left( frac{1}{a} + 1 \right) : left( a + 2 + frac{1 - 2(a+1)^2}{a} \right) ) for ( a \neq 0 ), ( a \neq -1 ) equals---\nA) None of the other answers is correct\nB) ( frac{1}{2a} )\nC) ( frac{1}{a} )\nD) ( frac{1}{2} )\nE) ( frac{1}{1 + a} )', 'D'),
(42, 'Funkcie', 'Functions', 'MC: Lineárna funkcia ( f(x) = 3x + 1 )---\nA) má práve jeden nulový bod, a to ( frac{1}{3} )\nB) má práve jeden nulový bod, a to 1\nC) má dva nulové body, a to ( frac{1}{3} ) a 1\nD) Žiadna z ostatných odpovedí nie je pravdivá\nE) nemá žiadny nulový bod', 'MC: The linear function ( f(x) = 3x + 1 )---\nA) has exactly one zero, namely ( frac{1}{3} )\nB) has exactly one zero, namely 1\nC) has two zeros, ( frac{1}{3} ) and 1\nD) None of the other answers is correct\nE) has no zeros', 'D'),
(43, 'Rovnice', 'Equations', 'MC: Rovnicia ( |x - 2| = 5 ) má množinu riešení---\nA) {1, 5}\nB) {7}\nC) {-3, 7}\nD) {-3, 7}\nE) {-7, 3}', 'MC: The equation ( |x - 2| = 5 ) has the solution set---\nA) {1, 5}\nB) {7}\nC) {-3, 7}\nD) {-3, 7}\nE) {-7, 3}', 'C'),
(44, 'Funkcie', 'Functions', 'MC: Graf funkcie ( f(x) = 3x^2 - 5x + 2 )---\nA) leží celý nad osou x\nB) leží celý pod osou x\nC) žiadna z ostatných odpovedí nie je správna\nD) pretína os x v dvoch bodoch\nE) sa dotýka osi x v jednom bode', 'MC: The graph of the function ( f(x) = 3x^2 - 5x + 2 )---\nA) lies entirely above the x-axis\nB) lies entirely below the x-axis\nC) none of the other answers is correct\nD) intersects the x-axis in two points\nE) touches the x-axis in one point', 'D'),
(45, 'Kombinatorika', 'Combinatorics', 'MC: Koľkými spôsobmi sa dá rozdeliť pravidelný šesťuholník ( ABCDEF ) na štyri neprekrývajúce sa trojuholníky?---\nA) Práve šiestimi\nB) Práve dvanástimi\nC) Práve trinástimi\nD) Práve osemnástimi\nE) Žiadna z ostatných odpovedí nie je správna', 'MC: In how many ways can a regular hexagon ( ABCDEF ) be divided into four non-overlapping triangles?---\nA) Exactly six\nB) Exactly twelve\nC) Exactly thirteen\nD) Exactly eighteen\nE) None of the other answers is correct', 'B'),
(46, 'Rovnice', 'Equations', 'MC: Množina riešení rovnice ( 2 sin x = 	an x ) je---\nA) ( left{ frac{pi}{3} + kpi; k in mathbb{Z} \right} )\nB) ( left{ kpi; k in mathbb{Z} \right} cup left{ frac{pi}{3} + kpi; k in mathbb{Z} \right} )\nC) Rovnica nemá riešenie\nD) ( left{ x in mathbb{R}; x = frac{pi}{3} + 2kpi; k in mathbb{Z} \right} cup left{ x = -frac{pi}{3} + 2kpi; k in mathbb{Z} \right} )\nE) ( left{ frac{pi}{3}; k in mathbb{Z} \right} )', 'MC: The solution set of the equation ( 2 sin x = 	an x ) is---\nA) ( left{ frac{pi}{3} + kpi; k in mathbb{Z} \right} )\nB) ( left{ kpi; k in mathbb{Z} \right} cup left{ frac{pi}{3} + kpi; k in mathbb{Z} \right} )\nC) The equation has no solution\nD) ( left{ x in mathbb{R}; x = frac{pi}{3} + 2kpi; k in mathbb{Z} \right} cup left{ x = -frac{pi}{3} + 2kpi; k in mathbb{Z} \right} )\nE) ( left{ frac{pi}{3}; k in mathbb{Z} \right} )', 'D'),
(47, 'Geometria', 'Geometry', 'MC: V rovine ležia dva trojuholníky. Ich prienik je úsečka. Ich zjednotením je:---\nA) Trojuholník alebo štvoruholník\nB) Trojuholník, štvoruholník, päťuholník alebo šesťuholník\nC) Trojuholník, štvoruholník alebo päťuholník\nD) Trojuholník\nE) Štvoruholník', 'MC: Two triangles lie in a plane. Their intersection is a segment. Their union is:---\nA) Triangle or quadrilateral\nB) Triangle, quadrilateral, pentagon or hexagon\nC) Triangle, quadrilateral or pentagon\nD) Triangle\nE) Quadrilateral', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `datetime` datetime NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_slovak_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_slovak_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `user_id`, `datetime`, `city`, `country`) VALUES
(4, 2, '2025-05-18 00:51:14', 'Bratislava', 'Slovensko');

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE `test_questions` (
  `id` int NOT NULL,
  `test_id` int NOT NULL,
  `question_id` int NOT NULL,
  `answered_correctly` tinyint(1) DEFAULT NULL,
  `time_taken` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `test_questions`
--

INSERT INTO `test_questions` (`id`, `test_id`, `question_id`, `answered_correctly`, `time_taken`) VALUES
(5, 4, 5, 0, 5.7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_slovak_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_slovak_ci NOT NULL,
  `api_token` varchar(64) COLLATE utf8mb4_slovak_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `api_token`) VALUES
(2, 'xhusek@stuba.sk', '$2y$10$u0PayNPtcmeNrbFrxg8Bt.j6nriuOuzEXkBIRdw5ygrU0d894iMNy', '3fbfc3c69d3ea39b925ab4026d03c13da32cd41adf2402bf20dc135f9470bdac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD CONSTRAINT `test_questions_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`),
  ADD CONSTRAINT `test_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
