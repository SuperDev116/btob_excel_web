<?php

namespace App\Livewire\Subjects;

use Livewire\Component;
use App\Models\Subject;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('被検者情報')]
class ShowSubject extends Component
{
    public $subject;

    #[Validate('required', message: '名前は必須です。')]
    public $first_name;
    
    #[Validate('required', message: '苗字は必須です。')]
    public $last_name;
    
    #[Validate('required', message: '生年月日は必須です。')]
    public $dob;
    
    #[Validate('required', message: '性別は必須です。')]
    public $gender;

    public function mount($subject)
    {
        $this->subject = $subject;
        $this->first_name = $subject->first_name;
        $this->last_name = $subject->last_name;
        $this->dob = $subject->dob;
        $this->gender = $subject->gender;
    }

    public function update()
    {
        $this->subject->update($this->validate());
        return redirect()->route('subjects.index');
    }

    public function render(Subject $subject)
    {
        return view('livewire.subjects.show-subject', [
            'subject' => $subject
        ]);
    }
}
