<?php

namespace App\Services;

use Illuminate\Support\Str;

class NameComparisonService
{
    /**
     * Compara dos nombres y retorna el porcentaje de coincidencias.
     *
     * @param string $name1
     * @param string $name2
     * @return float
     */
    public function compareNames(string $name1, string $name2): float
    {
        $name1 = $this->normalizeString($name1);
        $name2 = $this->normalizeString($name2);

        // Calcula la distancia Jaro entre los nombres
        $jaroDistance = similar_text($name1, $name2) / 100;

        // Calcula la longitud del prefijo común entre los nombre
        $prefixLength = 0;
        $maxLength = max(strlen($name1), strlen($name2));
        for ($i = 0; $i < $maxLength && isset($name1[$i]) && isset($name2[$i]) && $name1[$i] === $name2[$i]; $i++) {
            $prefixLength++;
        }

        // Calcula la distancia Jaro-Winkler entre los nombres con un ancho del prefijo de 0.05
        $jaroWinklerDistance = $jaroDistance + ($prefixLength * 0.05 * (1 - $jaroDistance));

        // Calcula el porcentaje de coincidencias y restringirlo a un rango entre 0 y 100
        $similarityPercentage = $jaroWinklerDistance * 100;
        return max(0, min(100, $similarityPercentage));
    }

    private function normalizeString(string $name): string
    {
        // Normalize the strings (e.g. to lowercase and remove accents)
        $name = Str::ascii(Str::lower(trim($name)));
        $name = str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $name);
        // Remove any non-letter or non-digit characters and multiple spaces
        $name = preg_replace('/[^a-z0-9 ]/', '', $name);
        $name = preg_replace('/\s+/', ' ', $name);
        return $name;
    }
}
