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
            'reg_no' => $row['reg_no'],
            'full_name' => $row['full_name'],
            'initials' => $row['initials'],
            'last_name' => $row['last_name'],
            'title' => $row['title'],
            'gender' => $row['gender'],
            'citizenship' => $row['citizenship'],
            'unique_id' => $row['unique_id'],
            'dob' => $row['dob'],
            'permanent_address_line1' => $row['permanent_address_line1'],
            'permanent_address_line2' => $row['permanent_address_line2'],
            'permanent_address_line3' => $row['permanent_address_line3'],
            'city' => $row['city'],
            'telephone' => $row['telephone'],
            'email' => $row['email'],
            'reg_fee' => $row['reg_fee'],
            'paid_branch' => $row['paid_branch'],
            'paid_date' => $row['paid_date'],
            'designation' => $row['designation'],
        ]);
    }
}
