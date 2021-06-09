<?php

namespace App\Exports;

use App\Models\Exam\Schedule;
use App\Models\Student;
use App\Models\Student\hasExam;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentExamListExport implements FromQuery,ShouldAutoSize,WithProperties,WithHeadings,WithStyles
{
    use Exportable;
    // private $fileName = 'StudentExamListExport.xlsx';
    // private $writerType = Excel::XLSX;
    /**
    * Optional headers
    */
    // private $headers = [
    //     'Content-Type' => 'text/csv',
    // ];

    public function properties(): array
    {
        return [
            'creator'        => 'Lakmal Samarakkody',
            'lastModifiedBy' => 'Lakmal Samarakkody',
            'title'          => 'Student Exam List Export',
            'description'    => 'student list of particular exam',
            'subject'        => 'studentList',
            'keywords'       => 'students,exam,export,spreadsheet',
            'category'       => 'export',
            'manager'        => 'Lakmal Samarakkody',
            'company'        => 'UCCS',
        ];
    }

    public function headings(): array
    {
        return ["Student ID", "Registration number", "Full Name"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            //'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            //'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function forExam(int $exam)
    {
        $this->exam_id = $exam;
        return $this;
    }

    public function forSubject(int $subject)
    {
        $this->subject_id = $subject;
        return $this;
    }

    public function forExamType(int $examType)
    {
        $this->exam_type_id = $examType;
        return $this;
    }

    public function query()
    {
        // // GET SCCHEDULE IDS FOR EXAM
        // $schedule_ids = array();
        // $scheduleIds = Schedule::where('exam_id', $this->exam_id)->where('subject_id', $this->subject_id)->where('exam_type_id', $this->exam_type_id)->where('schedule_release',0)->get();
        // foreach($scheduleIds as $scheduleId):
        //    array_push($schedule_ids,$scheduleId->id);
        // endforeach;

        // // GET STUDENT IDS
        // $student_ids = array();
        // $studentIds = hasExam::whereIn('exam_schedule_id', $schedule_ids)->where('schedule_status', 'Approved')->get();
        // foreach($studentIds as $studentId):
        //     array_push($student_ids,$studentId->student_id);
        // endforeach;
        // return Student::query()->select('id','reg_no','full_name')->whereIn('id',$student_ids)->distinct();

        return DB::table('students')
            ->join('student_exams', 'students.id', '=', 'student_exams.student_id')
            ->join('exam_schedules', 'student_exams.exam_schedule_id', '=', 'exam_schedules.id')
            ->select('students.id', 'students.reg_no', 'students.full_name')
            ->where('exam_schedules.exam_id', $this->exam_id)
            ->where('exam_schedules.subject_id', $this->subject_id)
            ->where('exam_schedules.exam_type_id', $this->exam_type_id)
            ->orderBy('students.id')
            ->distinct();
    }
}