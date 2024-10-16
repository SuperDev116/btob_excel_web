<?php

namespace App\Livewire\Subjects;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

use Livewire\Attributes\Title;

#[Title('被検者管理')]
class ShowSubjects extends Component
{
    public function create()
    {
        return redirect()->route('subjects.create');
    }
    
    public function delete(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index');
    }

    public function show(Subject $subject)
    {
        return redirect()->route('subjects.show', [
            "subject" => $subject,
        ]);
    }

    public function show_exams(Subject $subject)
    {
        return redirect()->route('subject.exams.index', [
            'subject' => $subject,
        ]);
    }

    public function render()
    {
        $subjects = Subject::where('user_id', Auth::id())
                            ->orderByDesc('created_at')
                            ->paginate(10);

        return view('livewire.subjects.show-subjects', [
            'subjects' => $subjects
        ]);
    }
}
