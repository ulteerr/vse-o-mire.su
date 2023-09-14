<?php

const VITE_HOST = 'http://localhost:5133';
function vite(string $entry): string
{
    return "\n" . jsTag($entry)
        . "\n" . jsPreloadImports($entry)
        . "\n" . cssTag($entry);
}

function isDev(string $entry): bool
{

    static $exists = null;
    if ($exists !== null) {
		return $exists;
    }
    $handle = curl_init(VITE_HOST . '/' . $entry);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_NOBODY, true);
	
    curl_exec($handle);
    $error = curl_errno($handle);
    curl_close($handle);
	
    return $exists = !$error;
}
function jsTag(string $entry): string
{
	$url = isDev($entry)
	? VITE_HOST . '/' . $entry
	: assetUrl($entry);
    if (!$url) {
        return '';
    }
    return '<script type="module" crossorigin src="'
        . $url
        . '"></script>';
}

function jsPreloadImports(string $entry): string
{
    if (isDev($entry)) {
        return '';
    }

    $res = '';
    foreach (importsUrls($entry) as $url) {
        $res .= '<link rel="modulepreload" href="'
            . $url
            . '">';
    }
    return $res;
}

function cssTag(string $entry): string
{
    if (isDev($entry)) {
        return '';
    }

    $tags = '';
    foreach (cssUrls($entry) as $url) {
        $tags .= '<link rel="stylesheet" href="'
            . $url
            . '">';
    }
    return $tags;
}

function getManifest(): array
{
    $content = file_get_contents(__DIR__ . '/build/manifest.json');
    return json_decode($content, true);
}

function assetUrl(string $entry): string
{
    $manifest = getManifest();
    return isset($manifest[$entry])
        ? '/build/' . $manifest[$entry]['file']
        : '';
}

function importsUrls(string $entry): array
{
    $urls = [];
    $manifest = getManifest();

    if (!empty($manifest[$entry]['imports'])) {
        foreach ($manifest[$entry]['imports'] as $imports) {
            $urls[] = '/build/' . $manifest[$imports]['file'];
        }
    }
    return $urls;
}

function cssUrls(string $entry): array
{
    $urls = [];
    $manifest = getManifest();

    if (!empty($manifest[$entry]['css'])) {
        foreach ($manifest[$entry]['css'] as $file) {
            $urls[] = '/build/' . $file;
        }
    }
    return $urls;
}