<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

use Livewire\Attributes\Title;
use Livewire\Atrributes\Validate;

class ShowUser extends Component
{
    public $user;

    public $name = '';
    public $phone = '';
    public $email = '';

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ];
    }

    protected $messages = [
        'name.required' => '機関名は必須です。',
        'phone.required' => '電話番号は必須です。',
        'email.required' => 'メールアドレスは必須です。',
        'email.email' => 'メールアドレスの形式ではありません。',
    ];

    public function render()
    {
        return view('livewire.admin.show-user', [
            'user' => $this->user
        ]);
    }

    public function mount($user)
    {
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->email = $user->email;
    }

    public function update()
    {
        $this->user->update($this->validate());
        return redirect()->route('users.index');
    }
}
