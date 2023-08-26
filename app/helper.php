<?php

function extractFilename($filename) {
    $pos = strpos($filename, '_'); // Find the position of the first underscore

    if ($pos !== false) {
        $newFilename = '_' . substr($filename, $pos + 1); // Extract the part after the underscore
        return $newFilename;
    } else {
        return "Invalid filename format"; // Handle the case where there's no underscore
    }
}

// $originalFilename = "1691852589_1691748720_callbackfnct.png";
// $newFilename = extractFilename($originalFilename);
// echo $newFilename; // Output: _callbackfnct.png