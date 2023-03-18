<?php

namespace App\Services;

use Illuminate\Support\Str;

class NameComparisonService
{
    /**
     * Compare two names and return the percentage of similarity.
     *
     * @param string $name1
     * @param string $name2
     * @return float
     */
    public function compareNames(string $name1, string $name2): float
    {
        $name1 = $this->normalizeString($name1);
        $name2 = $this->normalizeString($name2);

        // Calculate the Jaro distance between the names
        $jaroDistance = similar_text($name1, $name2) / 100;

        // Calculate the length of the common prefix between the names
        $prefixLength = 0;
        $maxLength = max(strlen($name1), strlen($name2));
        for ($i = 0; $i < $maxLength && isset($name1[$i]) && isset($name2[$i]) && $name1[$i] === $name2[$i]; $i++) {
            $prefixLength++;
        }

        // Calculate the Jaro-Winkler distance between the names with a prefix weight of 0.05
        $jaroWinklerDistance = $jaroDistance + ($prefixLength * 0.05 * (1 - $jaroDistance));

        // Calculate the percentage of similarity and constrain it to the range of 0 to 100
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
