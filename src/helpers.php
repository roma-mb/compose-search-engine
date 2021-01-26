<?php

function dd($expression): void
{
    echo '<pre>';
    var_dump($expression);
    echo '</pre>';
    die();
}

function printList(array $values): void
{
    foreach ($values as $value) {
        echo $value;
    }
}
