<?php

function view(string $filename, array $data = []): void
{
    // create variables from the associative array
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once '../app/views/' . $filename . '.php';
}

function redirect_to(string $url): void
{
    header('Location: ../views/' . $url);
    exit;
}
