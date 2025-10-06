<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Request;
use Inertia\Inertia;

class LibraryController extends Controller
{
      public function index()
    {
           return Inertia::render('Employee/Profile', [
            'filters' =>  Request::only(['search','selectedOffice','selectedPosition','selectedStatus']),
           ]);
    }
}
