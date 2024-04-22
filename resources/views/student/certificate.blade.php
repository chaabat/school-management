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
                <p class="text-sm text-gray-600">Téléphone : {{$student->phone}}</p>
                <p class="text-sm text-gray-600">Email : {{$student->email}}</p>
                <p class="text-sm text-gray-600">Adress : {{$student->adress}}</p>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <h1>ATTESTATION DE Scolarité</h1>
            <p>Nous soussignés société  nom de la sociétédomiciliée à  adresse de la société, attestons par la présente que <br> {{$student->name}},<br> Notre étudiant 

 

                Et ce depuis le {{ \Carbon\Carbon::parse($student->created_at)->format('Y-m-d') }} à ce jour.

                
                 <br>
                
                La présente attestation lui est délivrée à sa demande pour servir et valoir ce que de droit.
                
                 
                <br>
                 Fait à Lieu   Le :  {{ \Carbon\Carbon::now()->format('d-m-Y') }} </p>
        </div>
</body>
</html>
   