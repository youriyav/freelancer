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
<h2>Bienvenue sur Teranga-Dev</h2>
<div>
   <p>Bonjour {!! $name !!} </p>
   <p>L'équipe Teranga-Dev vous souhaite la bienvenue sur la plateforme </p>
   <p>Pour activer votre compte veuillez cliquer sur le <a href="{!! $link !!}" id="btnValidate">lien</a> suivant</p>
</div>
<div>

</div>
</body>
</html>