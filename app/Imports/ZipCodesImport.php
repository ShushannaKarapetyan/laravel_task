<?php

namespace App\Imports;

use App\ZipCode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ZipCodesImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     * @return ZipCode
     */
    public function model(array $row)
    {
        return new ZipCode([
            'zip' => $row[0],
            'town' => $row[1],
            'category' => $row[2],
            'district' => $row[3],
            'country' => $row[4],
            'court_name' => $row[5],
            'court_address' => $row[6],
            'court_zip' => $row[7],
            'court_town' => $row[8],
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
