<?php
// Function to convert a string into camelCase format
function toCamelCase($string) {
    $str = strtolower($string);            // Convert all letters to lowercase
    $words = explode(' ', $str);           // Split the string into words
    $camelCase = array_shift($words);      // Take the first word as is
    foreach ($words as $word) {
        $camelCase .= ucfirst($word);      // Capitalize the first letter of each remaining word and append
    }
    return $camelCase;
}
?>
