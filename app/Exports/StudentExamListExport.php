<?php

namespace App\Exports;

use App\Models\Exam\Schedule;
use App\Models\Student;
use App\Models\Student\hasExam;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class StudentExamListExport implements FromQuery
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
        // GET SCCHEDULE IDS FOR EXAM
        $schedule_ids = array();
        $scheduleIds = Schedule::where('exam_id', $this->exam_id)->where('subject_id', $this->subject_id)->where('exam_type_id', $this->exam_type_id)->where('schedule_release',0)->get();
        foreach($scheduleIds as $scheduleId):
           array_push($schedule_ids,$scheduleId->id);
        endforeach;

        // GET STUDENT IDS
        $student_ids = array();
        $studentIds = hasExam::whereIn('exam_schedule_id', $schedule_ids)->where('schedule_status', 'Approved')->get();
        foreach($studentIds as $studentId):
            array_push($student_ids,$studentId->student_id);
        endforeach;
        return Student::query()->select('id','reg_no','full_name')->whereIn('id',$student_ids)->distinct();
    }
}