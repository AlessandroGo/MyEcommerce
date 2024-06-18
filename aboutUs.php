<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/mystyle.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include_once('./template/navtop.php'); ?>
    </header>

    <main class="mb-auto mt-5 pt-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <h1>About Us</h1>
            </div>
            <div class="row p-4 gx-5">
                <div class="col">
                    <div class="row">
                        COMPANY PROFILE
                    </div>
                    <div class="row">
                        Phambili Agencies CC – Wholesaler and Book Distributor
                        The Company is operational since 1994 and has grown to a medium size family owned business.
                        Our Company was founded by Maria Lastrucci who has had a long career in the book trade spanning more than 40 years. The company is now managed by her two very capable daughters Rosanna Kalogiannis and Marina Gomes. The staff complement is 5 full time employees and 4 free-lance sales representatives covering all the provinces in South Africa.
                        The Company has their own warehouse, stock-holds, and effects their own distribution within South Africa.
                        The bulk of the Trade is with well-known bookstores for example Exclusive Books, Wordsworth Group, Bargain Books, Van Schaiks, PNA and several other independently owned bookstores across South Africa.

                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        During the 29 years of trade there has been several trends and transformation within the Publishing Industry and the Company has been able to adjust and grow to keep abreast with the trends.
                        Phambili has their own publishing brand, mainly focusing on Afrikaans Language children books and has experienced tremendous growth in this field with some reprints running for the fourth time. The retail market has received these publications very enthusiastically and it has been well supported throughout South Africa.
                        We have an excellent library division that supplies Provincial and Urban Libraries with new publications that are released into the market almost daily. The focus has further been extended to many school suppliers that provides schools with Library resources and selected readers for pupils on a National level.
                        The core stock covers a wide spectrum from Fiction to non-fiction for Adults, teenagers, pre-teen, and pre-school readers. The non- fiction titles cover academic, craft/art techniques, business, parenting, family health, home improvement / DIY, self-help, and biographies. We also supply various gift box sets, journals, and audio books as well.
                    </div>
                    <div class="row">
                        Phambili Agencies is an affiliated member of the Publishers Association of South Africa (PASA) and our membership number is P004. This can be verified through PASA on Tel +27 762 9083 or email pasa@publishsa.co.za.
                    </div>
                </div>
            </div>

        </div>

    </main>


    <?php include_once('./template/navbot.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>