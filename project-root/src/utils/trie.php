<?php

class TrieNode {
    public $children = [];
    public $isEndOfWord = false;
    
    public function __construct() {
        $this->children = array_fill(0, 26, null);
    }
}

class Trie {
    private $root;

    public function __construct() {
        $this->root = new TrieNode();
    }

    public function insert($word) {
        $node = $this->root;
        $length = strlen($word);

        for ($i = 0; $i < $length; $i++) {
            $index = ord($word[$i]) - ord('a');
            if (!$node->children[$index]) {
                $node->children[$index] = new TrieNode();
            }
            $node = $node->children[$index];
        }

        $node->isEndOfWord = true;
    }

    public function search($word) {
        $node = $this->root;
        $length = strlen($word);

        for ($i = 0; $i < $length; $i++) {
            $index = ord($word[$i]) - ord('a');
            if (!$node->children[$index]) {
                return false;
            }
            $node = $node->children[$index];
        }

        return $node !== null && $node->isEndOfWord;
    }
}

$trie = new Trie();
$words = ["apple", "banana", "cherry", "date", "fig", "grape", "kiwi", "lemon", "mango", "orange"];

foreach ($words as $word) {
    $trie->insert($word);
}

$searchWord = "lemon";
if ($trie->search($searchWord)) {
    echo "$searchWord is found in the trie.";
} else {
    echo "$searchWord is not found in the trie.";
}
?>