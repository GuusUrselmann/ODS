<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerIndividualsController extends Controller
{
    public function individuals()
    {
        // $individuals = Individuals::all();
        $individuals = [];

        return view('admin.customers.individuals.individuals', ['individuals' => $individuals]);
    }

    public function add()
    {
        return view('admin.customers.individuals.add');
    }

    public function edit()
    {
        return view('admin.customers.individuals.edit');
    }

    public function save()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
