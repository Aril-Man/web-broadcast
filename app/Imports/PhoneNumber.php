<?php

namespace App\Imports;

use App\Models\Receiver;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PhoneNumber implements ToCollection, SkipsEmptyRows, WithBatchInserts, WithUpserts, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    private $counting = 0;
    private $rows = null;

    public function collection(Collection $rows)
    {
        $this->counting += $rows->count();
        $this->rows = $rows;
        return $rows;
    }

    function data() {
        return $this->rows;
    }

    function getCounting() : int {
        return $this->counting;
    }

    public function validateHeaderRow($headerRow)
    {

        $expectedColumns = [
            'phone'
        ];

        $headerKeys = array_keys($headerRow);

        if (count($headerKeys) !== count($expectedColumns)) {
            return false;
        }

        if( $headerRow[0] !== $expectedColumns[0]) {
               return false;
        }

        return true;

    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'id';
    }

    public function headingRow(): int
    {
        return 1;
    }
}