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
            'gender' => 'required|in:male,female,other', // assuming valid values
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
