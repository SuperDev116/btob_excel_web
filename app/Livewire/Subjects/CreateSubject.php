<?php

namespace App\Livewire\Subjects;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;

#[Title('被検者作成')]
class CreateSubject extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $dob = '2001-01-01';
    public $gender = '';

    protected function rules()
    {
        return [
            'first_name' => [
                'required',
                'regex:/^[A-Z0-9]+$/',
            ],
            'last_name' => [
                'required',
                'regex:/^[A-Z0-9]+$/',
            ],
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
        ];
    }

    protected $messages = [
        'first_name.required' => '名は必須です。',
        'first_name.regex' => '名は半角大文字の英字または数字のみを含めることができます。',
        'last_name.required' => '姓は必須です。',
        'last_name.regex' => '姓は半角大文字の英字または数字のみを含めることができます。',
        'dob.required' => '生年月日は必須です。',
        'dob.date' => '生年月日は有効な日付である必要があります。',
        'gender.required' => '性別は必須です。',
        'gender.in' => '性別の値が無効です。',
    ];

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
    
    public function save_input()
    {
        $this->validate();

        $new_subject = Subject::create([
            'user_id' => Auth::id(),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'dob' => $this->dob,
            'gender' => $this->gender,
        ]);

        $this->reset();

        session()->flash('message', '被検者が作成されました。');

        return redirect()->route('subject.exams.index', [
            'subject' => $new_subject
        ]);
    }
    
    public function render()
    {
        return view('livewire.subjects.create-subject');
    }
}
