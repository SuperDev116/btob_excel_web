<?php

namespace App\Livewire\Subjects;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

use Livewire\Attributes\Title;

#[Title('被検者管理')]
class ShowSubjects extends Component
{
    public $search = '';

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
        $selected_exam = $subject->exams()->orderBy('created_at', 'asc')->get()->last();
        
        return redirect()->route('subject.exams.index', [
            'subject' => $subject,
            'selected_exam' => $selected_exam,
        ]);
    }

    public function render()
    {
        $subjects = Subject::where('user_id', Auth::id())
                            ->where(function ($query) {
                                $query->where('last_name', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('first_name', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy('last_name')
                            ->paginate(10);

        return view('livewire.subjects.show-subjects', [
            'subjects' => $subjects
        ]);
    }

    public function filter()
    {
        $subjects = Subject::where('user_id', Auth::id())
                            ->where(function ($query) {
                                $query->where('last_name', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('first_name', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy('last_name')
                            ->paginate(10);

        return view('livewire.subjects.show-subjects', [
            'subjects' => $subjects
        ]);
    }
}
