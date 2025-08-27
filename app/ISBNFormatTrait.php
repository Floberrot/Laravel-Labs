<?php

namespace App;

trait ISBNFormatTrait
{
    private const int ISBN_10 = 10;
    private const int ISBN_13 = 13;

    public function toIsbn(string $id): string
    {
        if (strlen($id) === self::ISBN_10) {
            return "ISBN 10 - $id";
        }

        if (strlen($id) === self::ISBN_13) {
            return "ISBN 10 - $id";
        }

        throw new \Exception('isbn length should be 10 or 13');
    }
}
