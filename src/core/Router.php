<?php

namespace core;

class Router
{
    public function route(string $uri_path): void
    {
        switch ($uri_path) {
            case "/":
            case "/index":
            case "/home":
                echo "It works!";
                break;
        }
    }