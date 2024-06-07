<?php

// Include necessary files
require_once 'utils/trie.php';
require_once 'utils/errorHandling.php';

// Function to precompute indices for fast search
function precomputeIndices($articles)
{
    $trie = new Trie();

    foreach ($articles as $index => $article) {
        $words = explode(' ', $article); // Split article into words

        foreach ($words as $word) {
            $word = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '', $word)); // Remove special characters and convert to lowercase

            if (strlen($word) >= 3) {
                $trie->insert($word, $index); // Insert word into trie with index of the article
            }
        }
    }

    return $trie;
}

// Sample data (Replace with actual articles data)
$articles = [
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
    "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
];

// Precompute indices for fast search
$trie = precomputeIndices($articles);

// Store precomputed indices in disk for quick access
file_put_contents('indices.txt', serialize($trie));

?>