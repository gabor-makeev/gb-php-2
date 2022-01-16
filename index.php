<?php

namespace Hello_1;

function sayTen() {
    echo 10;
}

namespace Hello_2;

function sayTen() {
    echo "Ten";
}

echo \Hello_1\sayTen();