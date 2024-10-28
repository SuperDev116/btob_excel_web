<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('subjects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
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
    public function show(Subject $subject)
    {
        return view('subjects.show', [
            'subject' => $subject
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function print(Subject $subject)
    {
        $exams = $subject->exams()->orderBy('date', 'asc')->get();;

        return view('pdf.line-graph-report', [
            'subject' => $subject,
            'exams' => $exams
        ]);
    }

    public function csv_download(Subject $subject)
    {
        // $subjects = Subject::where('user_id', Auth::id())->with('exams')->get();
        $subjects = Subject::where('user_id', Auth::id())->with(['exams' => function ($query) {
            $query->orderBy('date');
        }])->get();
        
        $content = "Name,Date,Result\n";

        foreach ($subjects as $subject)
        {
            foreach ($subject->exams as $exam)
            {
                $row = $subject->first_name . ' ' . $subject->last_name . ',' . $exam->date . ',' . $exam->result;
                $content .= $row . "\n";
            }
        }

        $datetime = date('Y-m-d_H-i-s');
        $filename = Auth::user()->name . '_exams_' . $datetime . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo $content;
        exit();
    }
}
