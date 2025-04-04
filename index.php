<?php


function getPokemonData()
{
    // 1) genera número aleatorio
    $Numero=rand(1,151);
    // 2) lee el contenido de la api
    $texto=file_get_contents("https://pokeapi.co/api/v2/pokemon/$Numero") ;
    // 3) lo decodifica
    $pokemon=json_decode($texto,true);
    // 4) Creo un objeto pokemon (me quedo sólo con los datos que necesito):
    $tipos=[];
    foreach ($pokemon["types"] as $key => $value) {
        // Si hay más de un tipo, lo iteramos
        if (isset($value["type"]["name"])) {
            array_push($tipos, $value["type"]["name"]);
        }
    }
    $abilities=[];
    foreach($pokemon["abilities"]as $key =>$value){
        if(isset($value["ability"]["name"])){
            array_push($abilities,$value["ability"]["name"]);
        }
    }
    
    $card=[
        "nombre"=>$pokemon["name"],
    "imagen"=>$pokemon["sprites"]['front_default'],
    "shiny"=>$pokemon["sprites"]["front_shiny"],

    "tipos"=>$tipos,
    "habilidades"=>$abilities
    ];

    return $card;

    // nombre (name)
    // imagen (sprites[front_default])
    // tipos (types[]-> dentro de cada elemento [type][name])

}


$pokemon1 = getPokemonData();
$pokemon2 = getPokemonData();
$pokemon3 = getPokemonData();
$pokemon4 = getPokemonData();
$pokemon5 = getPokemonData();



function renderCards($pokeArray)
{
if($pokeArray["tipos"][0]=="fire"){
    $class="fuego";
}elseif($pokeArray["tipos"][0]=="water"){
    $class="agua";
}elseif($pokeArray["tipos"][0]=="grass"){
    $class="planta";
}elseif($pokeArray["tipos"][0]=="electric"){
    $class="electrico";
}elseif($pokeArray["tipos"][0]=="dragon"){
    $class="dragón";
}elseif($pokeArray["tipos"][0] == "fighting"){
    $class = "lucha";
}
elseif($pokeArray["tipos"][0] == "flying"){
    $class = "volador";
}
elseif($pokeArray["tipos"][0] == "ghost"){
    $class = "fantasma";
}
elseif($pokeArray["tipos"][0] == "ground"){
    $class = "tierra";
}
elseif($pokeArray["tipos"][0] == "ice"){
    $class = "hielo";
}
elseif($pokeArray["tipos"][0] == "normal"){
    $class = "normal";
}
elseif($pokeArray["tipos"][0] == "poison"){
    $class = "veneno";
}
elseif($pokeArray["tipos"][0] == "psychic"){
    $class = "psiquico";
}
elseif($pokeArray["tipos"][0] == "rock"){
    $class = "roca";
}elseif($pokeArray["tipos"][0]=="bug"){
    $class="bicho";
}





    $probshiny=rand(1,20);
    echo "<div class='carta $class'>";

    if ($probshiny==1){
        $class ='shiny';
        $img = 'shiny';
    }elseif($pokeArray["tipos"][0]=="water"&&$probshiny!=1){
        $class='agua';
        $img='imagen';
    }elseif($pokeArray["tipos"][0]=="fire"&&$probshiny!=1){
        $class='fuego';
        $img='imagen';
    }elseif($pokeArray["tipos"][0]=="grass"&&$probshiny!=1){
        $class='planta';
        $img='imagen';
    }elseif($pokeArray["tipos"][0]=="electric"&&$probshiny!=1){
        $class='electrico';
        $img='imagen';
    }
    else{
        $class ='';
        $img = 'imagen';
    }



echo "    <div class='img-container $class'>";
echo '        <img src="' . $pokeArray[$img] . '" alt="' . $pokeArray["nombre"] . '">';

    echo '    </div>';
    echo '    <div class="datos">';
    echo '        <h3>' . ucfirst($pokeArray["nombre"]) . '</h3>';
    
    echo '        <div class="tipos-pokemon">';
    foreach ($pokeArray["tipos"] as $tipo) {
        echo '            <span>' . ucfirst($tipo) . '</span>';
    };
    
    echo '        </div>';
    echo '        <div class="habilidades-pokemon">';
    foreach ($pokeArray["habilidades"] as $habilidad) {
        echo '            <span>' . ucfirst($habilidad) . '</span>';
    }
    echo '        </div>';
    echo '    </div>';
    echo '</div>';


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeWeb</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

</head>

<body>
<h1>GENERADOR DE 5 CARTAS(1ª GENERACION)</h1>

    </section>
    <div id="pokecartas">
        <?php 
        renderCards($pokemon1);
        renderCards($pokemon2);
        renderCards($pokemon3);
        renderCards($pokemon4);
        renderCards($pokemon5);

        ?>

    </div>
    <a class="boton" href="http://localhost/UF1846_pokecartas/">Nuevas Cartas</a>
</body>

</html>