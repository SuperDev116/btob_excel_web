<?php

namespace App\Livewire\Exams;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Exam;

use Livewire\Attributes\Title;

#[Title('検査データ管理')]
class ShowExams extends Component
{
    public $subject;

    #[Validate('required', message: '名は必須です。')]
    public $date = '';
    
    #[Validate('required', message: '姓は必須です。')]
    public $result = '';

    public function mount($subject)
    {
        $this->subject = $subject;
    }

    public function render()
    {
        $page_exams = Exam::where('subject_id', $this->subject->id)
                        ->orderByDesc('date')
                        ->paginate(10);

        return view('livewire.exams.show-exams', [
            'page_exams' => $page_exams,
        ]);
    }
    
    public function delete(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('subject.exams.index', [
            'subject' => $this->subject
        ]);
    }

    public function select(Exam $exam)
    {
        $selected_exam = $exam;
        
        return redirect()->route('subject.exams.index', [
            'subject' => $this->subject,
            'selected_exam' => $selected_exam,
        ]);
    }
}
