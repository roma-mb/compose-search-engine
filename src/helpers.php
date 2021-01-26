<?php

function dd($expression): void
{
    echo '<pre>';
    var_dump($expression);
    echo '</pre>';
    die();
}
