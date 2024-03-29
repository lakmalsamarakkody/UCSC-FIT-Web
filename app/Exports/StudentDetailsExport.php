<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray; 
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentDetailsExport implements FromArray, withHeadings
{
    protected $student_array;

    public function __construct(array $student_array)
    {
        $this->student_array = $student_array;
    }


    public function headings(): array{
        return [
            'regno',
            'Fname',
            'AInitial',
            'ASName',
            'title',
            'ANICNo',
            'ADOB',
            'telno',
            'email',
            'Qualification',
            'ver'
        ];
    }

    public function array(): array
    {
        return $this->student_array;
    }
}
