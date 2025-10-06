<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Request;
use Inertia\Inertia;

class OrgChartController extends Controller
{
    public function index()
    {
           return Inertia::render('Employee/OrgChart', [
            'filters' =>  Request::only(['search','selectedOffice','selectedPosition','selectedStatus']),
           ]);
    }
}
