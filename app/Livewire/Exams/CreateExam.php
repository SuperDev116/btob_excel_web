<?php

namespace App\Livewire\Exams;

use Livewire\Component;

use App\Models\Exam;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('検査データ一覧')]
class CreateExam extends Component
{
    public $subject;
    public $exams;

    #[Validate('required', message: '日付は必須です。')]
    public $date = '';
    
    #[Validate('required', message: '結果は必須です。')]
    public $result = '';

    public function mount($subject)
    {
        $this->subject = $subject;
        $this->exams = $subject->exams()->get();
    }

    public function render()
    {
        return view('livewire.exams.create-exam');
    }

    public function store()
    {
        $this->validate();

        Exam::create([
            'subject_id' => $this->subject->id,
            'date' => $this->date,
            'result' => $this->result,
        ]);

        $this->reset(['date', 'result']);

        session()->flash('message', '検査データが作成されました。');

        return redirect()->route('subject.exams.index', [
            'subject' => $this->subject
        ]);
    }
}
