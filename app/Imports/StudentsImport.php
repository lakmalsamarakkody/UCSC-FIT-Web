<?php

namespace App\Imports;

use App\Models\TempStudent;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Throwable;

HeadingRowFormatter::default('none');


class StudentsImport implements ToModel,WithHeadingRow
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
            'reg_no' => $row['RegNo'],
            'full_name' => $row['FullName'],
            'initials' => $row['Initials'],
            'last_name' => $row['LastName'],
            'title' => $row['Title'],
            'gender' => $row['Gender'],
            'citizenship' => $row['Citizenship'],
            'unique_id' => $row['UniqueId'],
            'dob' => gmdate("Y-m-d", (($row['Dob'] - 25569) * 86400)),
            'permanent_address_line1' => $row['PermanentAddressLine1'],
            'permanent_address_line2' => $row['PermanentAddressLine2'],
            'permanent_address_line3' => $row['PermanentAddressLine3'],
            'city' => $row['City'],
            'telephone' => $row['Telephone'],
            'email' => $row['Email'],
            'reg_fee' => $row['RegFee'],
            'paid_branch' => $row['PaidBranch'],
            'paid_date' => gmdate("Y-m-d", (($row['PaidDate'] - 25569) * 86400)),
            'designation' => $row['Designation'],
        ]);
    }
}
