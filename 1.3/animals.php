<?php
$continents = [
'Africa' => [
'Okapia johnstoni', 
'Gazella dorcas', 
'Choeropsis liberiensis', 
'Potamochoerus porcus', 
'Viverra', 'Cercopithecus', 
'Papio', 'Giraffa', 
'Panthera pardus', 
'Acinonyx'
],
'Australia' => [
'Phascolarctos cinereus', 
'Rattus fuscipes', 
'Sarcophilus harrisii', 
'Tachyglossus aculeatus', 
'Trichosurus vulpecula', 
'Vombatus ursinus', 
'Zaglossus bruijni', 
'Tiliqua', 
'Macropus rufus', 
'Pteropus vampyrus'
]
];

$fantastic = [];
$animal_words = [[], []];
$two_words = [];

foreach($continents as $animals) {
    foreach($animals as $animal) {
        $words = explode(' ', $animal);
        if (count($words) == 2) {
            $two_words[] = $animal;
            $animal_words[0][] = $words[0];
            $animal_words[1][] = $words[1];
        }
    }
}

shuffle($animal_words[0]);
shuffle($animal_words[1]);
for ($i = 0; $i < count($two_words); $i++) {
    $new_animal = $animal_words[0][$i] . " " . $animal_words[1][$i];
    $fantastic[] = $new_animal;
}

echo "<pre>";
print_r($fantastic);
echo "</pre>";
