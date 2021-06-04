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
    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function model(array $row)
    {
        if ($row['First name'] == Null || $row['First name'] == "") {
        }
        else {
            $exam = $this->details['exam'];
            $subject = $this->details['subject'];
            $examType = $this->details['examType'];
            // echo $examType;
            return new TempResult([
                'exam_id' =>  $exam,
                'subject_id' =>  $subject,
                'exam_type_id' =>  $examType,
                'student_reg_no' => substr($row['First name'], 0, 10),
                'grade' => $row['Grade/100.00']
            ]);
        }
        
    }

}
