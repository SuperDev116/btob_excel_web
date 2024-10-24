<?php

namespace App\Livewire\Exams;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Exam;

use PDF;

use Livewire\Attributes\Title;

#[Title('検査データ管理')]
class Graph extends Component
{
    public $subject;
    public $last_exam;

    public function mount($subject)
    {
        $this->subject = $subject;
        $this->last_exam = $subject->exams()->orderBy('created_at', 'asc')->get()->last();
    }

    public function render()
    {
        return view('livewire.exams.graph', [
            'subject' => $this->subject,
            'last_exam' => $this->last_exam,
        ]);
    }

    public function print()
    {
        // $pdf = PDF::loadView('pdf.graph-report', [
        //     'subject' => $this->subject,
        //     'last_exam' => $this->last_exam
        // ]);

        // return $pdf->download('graph-report.pdf');
        return redirect()->route('print.exam', $this->last_exam->id);
    }
}
