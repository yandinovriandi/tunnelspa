<?php

function formatRupiah($string): array|string
{
    return str_replace(',', '.', number_format($string));
}
