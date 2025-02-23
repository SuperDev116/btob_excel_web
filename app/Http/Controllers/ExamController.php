<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subject $subject, Exam $selected_exam = null)
    {
        if ($selected_exam == null)
        {
            $selected_exam = $subject->exams()->orderBy('created_at', 'asc')->get()->last();
        }

        return view('exams.index', [
            'subject' => $subject,
            'selected_exam' => $selected_exam,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }

    public function print(Exam $exam)
    {
        $subject = $exam->subject()->first();
        $user = User::find($subject->user_id);

        return view('pdf.graph-report', [
            'user' => $user,
            'subject' => $subject,
            'exam' => $exam
        ]);
    }
}
