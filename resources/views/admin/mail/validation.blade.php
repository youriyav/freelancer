<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        body
        {
            width: 50%;
            font-size: 1.2em;
        }
        h2{
            background-color: #428bca;
            height: 80px;
           text-align: center;
            padding-top: 25px;
            color: white;
        }
        #btnValidate
        {
            background-color:#428bca ;
            padding: 5px;
            padding-left: 10px;
            padding-right: 10px;
            font-size: 1.1em;
            border-radius: 5px;
            color: white;
        }

    </style>
</head>
<body>
<h2>Teranga-Dev</h2>
<div>
   <p>Bonjour {!! $name !!} </p>
    <p>Votre projet <span style="font-weight: bold">{!! $titre !!}</span> vient d'être valider par l'équipe de modération.</p>
    <p>Celui est visible au niveau la plateforme. Vos pouvez dès maintenant recevoir les offres des prestataires intéressés</p>
   <p>Très cordialement,</p>
   <p>L'équipe de teranga-dev.com</p>
</div>
<hr style="color: blue">
<div>

</div>
</body>
</html>