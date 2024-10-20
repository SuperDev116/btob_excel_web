<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Livewire\Attributes\Title;

#[Title('検査データ管理')]
class ShowUsers extends Component
{
    public function render()
    {
        return view('livewire.admin.show-users');
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
