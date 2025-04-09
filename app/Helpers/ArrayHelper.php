<?php

namespace App\Helpers;

class ArrayHelper
{
    /**
     * Extract IDs from a nested array.
     *
     * @param array $data
     * @return array
     */
    public static function extractIds(array $data): array
    {
        $result = [];
        foreach ($data as $key => $items) {
            $result[$key] = array_column($items, 'id');
        }
        return $result;
    }
}
