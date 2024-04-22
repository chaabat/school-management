<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
 
<body>
    <head>
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold"> </h2>
                
            </div>
            <div>
                <p class="text-sm text-gray-600">Téléphone : {{$teacher->phone}}</p>
                <p class="text-sm text-gray-600">Email : {{$teacher->email}}</p>
                <p class="text-sm text-gray-600">Adress : {{$teacher->adress}}</p>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <h1>ATTESTATION DE TRAVAIL</h1>
            <p>Nous soussignés société  nom de la sociétédomiciliée à  adresse de la société, attestons par la présente que <br> {{$teacher->name}},<br> Immatriculé à la CNSS sous le numéro XXXXXXXXXX, est employé au sein de notre société en qualité de Nom du poste. <br>

 

                Et ce depuis le {{ \Carbon\Carbon::parse($teacher->created_at)->format('Y-m-d') }} à ce jour.

                
                 <br>
                
                La présente attestation lui est délivrée à sa demande pour servir et valoir ce que de droit.
                
                 
                <br>
                 Fait à Lieu   Le :  {{ \Carbon\Carbon::now()->format('d') }} </p>
        </div>
</body>
</html>
   