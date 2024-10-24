<?php

namespace App\Livewire\Exams;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Exam;

use PDF;

use Livewire\Attributes\Title;

#[Title('検査データ管理')]
class LineGraph extends Component
{
    public $subject;
    public $exams;

    public function mount($subject)
    {
        $this->subject = $subject;
        $this->exams = $subject->exams()->orderBy('date', 'asc')->get();
    }
    
    public function render()
    {
        return view('livewire.exams.line-graph', [
            'subject' => $this->subject,
            'exams' => $this->exams
        ]);
    }

    public function print()
    {        
        // $pdf = PDF::loadView('pdf.line-graph-report', [
        //     'subject' => $this->subject,
        //     'exams' => $this->exams
        // ]);

        // return $pdf->download($this->subject->id . 'line-graph-report.pdf');
        return redirect()->route('print.subject', $this->subject->id);
    }

}
