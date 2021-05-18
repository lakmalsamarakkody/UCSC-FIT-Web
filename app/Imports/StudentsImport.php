<?php

namespace App\Imports;

use App\Models\TempStudent;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Throwable;

HeadingRowFormatter::default('none');


class StudentsImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TempStudent([
            'reg_no' => $row['regno'],
            'full_name' => $row['fname'],
            'unique_id' => $row['uniqueid'],
            'telephone' => $row['telno'],
            'email' => $row['email'],
            'designation' => $row['designation'],
        ]);
    }
}
