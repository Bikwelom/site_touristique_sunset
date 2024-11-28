<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos de Sunset</title>
    <style>
        /*reset de la page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

      /*integration de la police dans la page */          
        @font-face {
            font-family: 'Chivo';
            src: url('fonts/static/Chivo-ExtraBold.ttf') format('ttf'),
                url('fonts/static/Chivo-ExtraBoldItalic.ttf') format('ttf');
            font-weight:900;
            font-style: normal;
        }
        body {
            font-family: 'Chivo', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        /* header de la pageee */
        header {
            background-color: #fca311;
            padding: 10px;
            text-align: center;
        }
        /* titre h1 about */
        header h1 {
            color: #fff;
            font-size: 36px;
        }
        /* corps de ma page */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-flow:column;
            gap:0.8em;
        }
        /* contenu de la page */
        .about-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 2em;
        }
        .about-content h2 {
            font-size: 2.5em;
            margin-bottom: 1em;
        }
        .about-content p {
            font-size: 1.2em;
            max-width: 800px;
        }
        .about-images {
            display: flex;
            justify-content:center;
            gap: 20px;
        }
        .about-images img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        
        footer {
            background-color: #8ecae6;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>À propos de Sunset</h1>
</header>

<div class="container">
    <img src="asset/img4.jpg" alt="">
    <section class="about-content">
        <p>
            Nous sommes un site touristique basé à Kinshasa, avec pour mission de vous faire découvrir les plus belles destinations et aventures à travers le Congo. 
            Que vous cherchiez des voyages culturels, des circuits d’aventures, ou simplement des moments de détente, Sunset est là pour vous accompagner.
        </p>
        <p>
            Avec une équipe passionnée par les voyages et la culture, nous vous garantissons des expériences inoubliables, que vous soyez en quête de découvertes, d'histoire ou de relaxation. Explorez Kinshasa et ses environs avec nos services personnalisés et vivez des moments mémorables.
        </p>

        <div class="about-images">
            <img src="asset/img.jpg" alt="Vue de Kinshasa">
            <img src="asset/img2.jpg" alt="Nature autour de Kinshasa">
            <img src="asset/img3.jpg" alt="Aventure en plein air">
        </div>
    </section>
</div>

<footer>
    <p>2024 Michéé Bikwelo. Tous droits réservés.</p>
</footer>

</body>
</html>
