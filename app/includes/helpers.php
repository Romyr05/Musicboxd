<?php

// Get the base URL path for all links
function getBasePath(): string {
    $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
    return $scriptDir === '\\' || $scriptDir === '/' ? '' : $scriptDir;
}

// Generate a URL with the correct base path
function url(string $path): string {
    return getBasePath() . $path;
}
