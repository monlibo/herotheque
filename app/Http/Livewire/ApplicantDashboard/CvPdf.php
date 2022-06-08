<?php

namespace App\Http\Livewire\ApplicantDashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CvPdf extends Component
{
    public function generate()
    {
        //dd('linert');
        $data = [
            'user' => Auth::user(),
            'skills' => collect(Auth::user()->profile->skills),
            'languages' => collect(Auth::user()->profile->languages),
            'experiences' => Auth::user()->profile->proExperiences,
            'trainings' => Auth::user()->profile->trainings
        ];

        $pdf = PDF::loadView('livewire.applicant-dashboard.cv-pdf',$data)->output();
        return response()->streamDownload(
            fn () => print($pdf),
            "filename.pdf"
        );




    }

    public function render()
    {
        return view(
            'livewire.applicant-dashboard.cv-pdf',
            [
                'user' => Auth::user(),
                'skills' => collect(Auth::user()->profile->skills),
                'languages' => collect(Auth::user()->profile->languages),
                'experiences' => Auth::user()->profile->proExperiences,
                'trainings' => Auth::user()->profile->trainings
            ]
        );
    }
}
