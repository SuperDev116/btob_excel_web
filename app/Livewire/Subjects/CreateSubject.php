<?php

namespace App\Livewire\Subjects;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('被検者作成')]
class CreateSubject extends Component
{
    #[Validate('required', message: '名前は必須です。')]
    public $first_name = '';
    
    #[Validate('required', message: '苗字は必須です。')]
    public $last_name = '';
    
    #[Validate('required', message: '生年月日は必須です。')]
    public $dob = '2001-01-01';
    
    #[Validate('required', message: '性別は必須です。')]
    public $gender = '';

    public function store()
    {
        $this->validate();

        Subject::create([
            'user_id' => Auth::id(),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'dob' => $this->dob,
            'gender' => $this->gender,
        ]);

        $this->reset();

        session()->flash('message', '被検者が作成されました。');

        return redirect()->route('subjects.index');
    }
    
    public function render()
    {
        return view('livewire.subjects.create-subject');
    }
}
