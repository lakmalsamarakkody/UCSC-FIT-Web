<?php

namespace App\Imports;

use App\Models\TempResult;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Throwable;

HeadingRowFormatter::default('none');

class ResultsImport implements ToModel, WithHeadingRow
{
    use Importable;

    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $exam_schedule_id;

    public function __construct($exam_schedule_id)
    {
        $this->exam_schedule_id = $exam_schedule_id;
    }

    public function model(array $row)
    {
        if ($row['Reg No.'] == Null || $row['Reg No.'] == "") {
        }
        else {
            return new TempResult([
                'exam_schedule_id' =>  $this->exam_schedule_id,
                'student_reg_no' => $row['Reg No.'],
                'grade' => $row['Grade/100.00']
            ]);
        }
        
    }

}
