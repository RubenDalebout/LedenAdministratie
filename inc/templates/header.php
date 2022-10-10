<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: index.php");
    die();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('mvc/controller/controller.php');
$controller = new Controller();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Leden administratie</title>

    <!-- Style -->
    <link rel="stylesheet" href="./inc/libraries/fontawesome/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Righteous&family=Sarabun&display=swap');

        :root {
          /* General variables */
          --top-bottom-height: 50px;
          --grid-gap: 0px;

          /* Main  fonts*/
          --font-righteous: 'Righteous', cursive;
          --font-sarabun: 'Sarabun', sans-serif;

          /* Colors */
          --body-background: #fcfcfc;
          --body-color: #fff;
          --content-color: #000;
        }

        /* Global classes fonts */
        h1, h2, h3, h4, h5, h6 {
          font-family: var(--font-righteous);
        }

        p, a, th, td {
          font-family: var(--font-sarabun);
          margin-top: 0;
          margin-bottom: .5rem;
        }
        
        /* Global classes text styling */
        .text-start {
          text-align: start;
        }

        .text-center {
          text-align: center;
        }

        .text-end {
          text-align: end;
        }

        body {
            display: grid;
            grid-template-columns: auto auto auto auto auto auto auto auto auto auto auto auto;
            gap: var(--grid-gap);
            margin: 0;
            background: var(--body-background);
            color: var(--body-color);
        }

        header {
            grid-column: 1/13;
            height: var(--top-bottom-height);
            background: #212121;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        header h1:hover {
            cursor: default;
        }

        header h1::selection {
            color: none;
            background: none;
        }

        main {
            grid-column: 1/13;
            display: grid;
            grid-template-columns: auto auto auto auto auto auto;
            gap: 10px;
            height: calc(100vh - var(--top-bottom-height) * 2 - var(--grid-gap) * 2);
            min-height: 300px;
        }

        main nav {
            grid-column: 1/1;
            background: #333333;
        }

        main nav ul {
          list-style-type: none;
          padding: 0;
          margin: 0;
        }

        main nav a {
          text-decoration: none;
          color: unset;
          display: block;
          padding: 1rem;
          position: relative;
        }

        main nav a:hover::after {
          content: '';
          position: absolute;
          left: 0;
          top: 0;
          height: 100%;
          width: 5px;
          background: red;
        }

        main nav a.active::after {
          content: '';
          position: absolute;
          left: 0;
          top: 0;
          height: 100%;
          width: 5px;
          background: rgb(216, 0, 0);
        }

        main nav i {
            width: 32px;
        }

        main section {
            grid-column: 2/13;
            color: var(--content-color);
            overflow-y: auto;
            padding: 1rem;
        }

        /* Buttons */
        button {
            padding: .5rem 1rem;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: 700;

            transition: all .5s ease;
        }

        button.primary {
            border-color: #6363a8;
            background-color: #8080d9;
            color: white;
        }

        button.primary:hover {
            border-color: #47477c;
            background-color: #6969b4;
        }

        button.good {
            border-color: #54b354;
            background-color: #6ae56a;
            color: white;
        }

        button.good:hover {
            border-color: #387838;
            background-color: #50af50;
            color: white;
        }

        button.watchout {
            border-color: #d1b200;
            background-color: #ffd700;
            color: white;
        }

        button.watchout:hover {
            border-color: #a38a00;
            background-color: #b59a00;
            color: white;
        }

        button.failure {
            border-color: #a91d1d;
            background-color: #de2727;
            color: white;
        }

        button.failure:hover {
            border-color: #5c1010;
            background-color: #871818;
            color: white;
        }

        button:hover {
            cursor: pointer;
            transition: all .5s ease;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 .5rem 1rem rgba(0,0,0, .15);
            border-radius: 10px;
            margin: 0.5rem 0;
        }

        table th {
            font-weight: bold;
            text-align: start;
            background: #333333;
            color: white;
        }

        table thead tr:first-of-type th:first-of-type {
            border-top-left-radius: 10px;
        }

        table thead tr:first-of-type th:last-of-type {
            border-top-right-radius: 10px;
        }

        table tbody tr:last-of-type td:first-of-type {
            border-bottom-left-radius: 10px;
        }

        table tbody tr:last-of-type td:last-of-type {
            border-bottom-right-radius: 10px;
        }

        table th, table td {
            padding: 0.5rem 1rem;
        }

        table tbody tr:nth-child(odd) {
            background: #fff;
        }

        table tbody tr:nth-child(even) {
            background: #f2f2f2;
        }

        table tbody tr:hover {
            background: #ddd;
        }

        footer {
            background: #212121;
            grid-column: 1/13;
            height: var(--top-bottom-height);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        footer h5:hover {
            cursor: default;
        }

        footer h5::selection {
            color: none;
            background: none;
        }
        
        .error {
            color: #de2727;
        }
    </style>

    <link rel="stylesheet" href="./inc/libraries/fontawesome/css/all.min.css">
</head>
<body>
    <header>
        <section>
          <h1><?php echo basename(substr($_SERVER['SCRIPT_NAME'], 1), '.php'); ?> - Leden-Administratie Paneel</h1>
        </section>
    </header>
    <main>
        <nav>
            <ul>
                <li>
                    <a href="./dashboard.php" <?php if (basename(substr($_SERVER['SCRIPT_NAME'], 1), '.php') === 'dashboard') echo 'class="active"'; ?>><i class="fa-solid fa-house"></i> Dashboard</a>
                </li>
                <li>
                    <a href="./boekjaar.php" <?php if (basename(substr($_SERVER['SCRIPT_NAME'], 1), '.php') === 'boekjaar') echo 'class="active"'; ?>><i class="fa-solid fa-calender"></i> Boekja(a)r(en)</a>
                </li>
                <li>
                    <a href="./families.php" <?php if (basename(substr($_SERVER['SCRIPT_NAME'], 1), '.php') === 'families') echo 'class="active"'; ?>><i class="fa-solid fa-people-group"></i> Familie(s)</a>
                </li>
                <li>
                    <a href="./leden.php" <?php if (basename(substr($_SERVER['SCRIPT_NAME'], 1), '.php') === 'leden') echo 'class="active"'; ?>><i class="fa-solid fa-people-group"></i> Leden</a>
                </li>
                <li>
                    <a href="./contributies.php" <?php if (basename(substr($_SERVER['SCRIPT_NAME'], 1), '.php') === 'contributies') echo 'class="active"'; ?>><i class="fa-solid fa-coins"></i> Contributie(s)</a>
                </li>
                <li>
                    <a href="./logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Uitloggen</a>
                </li>
            </ul>
        </nav>