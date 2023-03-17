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
        // Normalize the strings (e.g. to lowercase and remove accents)
        $name1 = Str::ascii(Str::lower(trim($name1)));
        $name2 = Str::ascii(Str::lower(trim($name2)));

        // Calculate the Levenshtein distance between the names
        $levenshteinDistance = levenshtein($name1, $name2);

        // Calculate the maximum length between the two names
        $maxLength = max(strlen($name1), strlen($name2));

        // Calculate the percentage of similarity
        $similarityPercentage = ($maxLength - $levenshteinDistance) / $maxLength * 100;

        return $similarityPercentage;
    }
}
