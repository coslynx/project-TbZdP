<?php

require_once '../utils/trie.php';
require_once '../utils/errorHandling.php';

function search($query) {
    $trie = new Trie();

    // Load precomputed indices from disk
    $indices = json_decode(file_get_contents('indices.json'), true);

    // Populate trie with precomputed indices
    foreach ($indices as $word => $result) {
        $trie->insert($word, $result);
    }

    // Search for query in trie
    $results = $trie->search($query);

    // Limit search results to a maximum of ten
    $results = array_slice($results, 0, 10);

    return $results;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['query']) && strlen($data['query']) >= 3) {
        $query = $data['query'];
        $results = search($query);

        echo json_encode($results);
    } else {
        echo json_encode(['error' => 'Minimum query length is 3 characters']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>