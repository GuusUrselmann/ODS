<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;

class CustomerCompaniesController extends Controller
{
    public function companies()
    {
        $companies = Company::all();

        return view('admin.customers.companies.companies', ['companies' => $companies]);
    }

    public function add()
    {
        return view('admin.customers.companies.add');
    }

    public function edit()
    {
        $company = Company::find(request('id'));

        return view('admin.customers.companies.edit', ['company' => $company]);
    }

    public function save()
    {
        $company = new Company();

        $company->name = request('name');
        $company->legal_number = request('legal_number');
        $company->tax_number = request('tax_number');
        $company->address = request('address');
        $company->house_number = request('house_number');
        $company->city = request('city');
        $company->zipcode = request('zipcode');
        $company->email = request('email');
        $company->phonenumber = request('phonenumber');
        $company->status = request('status');
        
        $company->save();

        return redirect('/admin/klanten/bedrijven');
    }

    public function update()
    {
        $company = Company::find(request('company_id'));

        $company->name = request('name');
        $company->legal_number = request('legal_number');
        $company->tax_number = request('tax_number');
        $company->address = request('address');
        $company->house_number = request('house_number');
        $company->city = request('city');
        $company->zipcode = request('zipcode');
        $company->email = request('email');
        $company->phonenumber = request('phonenumber');
        $company->status = request('status');
        
        $company->save();

        return redirect('/admin/klanten/bedrijven');
    }

    public function delete()
    {
        $company = Company::find(request('id'));
        $company->delete();
        
        return redirect('/admin/klanten/bedrijven');
    }
}
