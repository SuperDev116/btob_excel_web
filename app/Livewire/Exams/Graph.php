<?php

namespace App\Livewire\Exams;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Exam;

use Livewire\Attributes\Title;

#[Title('検査データ管理')]
class Graph extends Component
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
        return view('livewire.exams.graph', [
            'subject' => $this->subject,
            'exams' => $this->exams
        ]);
    }
}
