<?php

function handleSearchError($errorCode) {
    switch ($errorCode) {
        case 1:
            return "Invalid search query. Please try again.";
            break;
        case 2:
            return "Search query too short. Please enter at least three characters.";
            break;
        case 3:
            return "No results found. Please try a different search query.";
            break;
        default:
            return "An error occurred. Please try again later.";
    }
}

?>