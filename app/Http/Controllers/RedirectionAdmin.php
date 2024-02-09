<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectionAdmin extends Controller
{
    public function redirection($option){
        switch ($option) {
            case 'projects':
                return view('dashboard',[
                    'option'=>$option
                ]);
                break;
            case 'judges':
                return view('livewire.admin.judges');
                break;
            case 'reports':
                return view('livewire.admin.reports');
                break;
            case 'settings':
                return view('livewire.admin.settings');
                break;
        }
    }
}
