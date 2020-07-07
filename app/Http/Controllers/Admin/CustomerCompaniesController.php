<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;
use App\ContactInformation;

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
        $contact_information = new ContactInformation();
        
        $contact_information->street_name = request('street_name');
        $contact_information->house_number = request('house_number');
        $contact_information->city = request('city');
        $contact_information->zipcode = request('zipcode');
        $contact_information->email = request('email');
        $contact_information->phone = request('phone');
        
        $contact_information->save();
        
        $company->name = request('name');
        $company->contact_information_id = $contact_information->id;
        $company->legal_number = request('legal_number');
        $company->tax_number = request('tax_number');
        $company->status = request('status');
        
        $company->save();

        return redirect('/admin/klanten/bedrijven');
    }

    public function update()
    {
        $company = Company::find(request('company_id'));
        $contact_information = ContactInformation::find($company->contact_information_id);

        $company->name = request('name');
        $company->legal_number = request('legal_number');
        $company->tax_number = request('tax_number');
        $company->status = request('status');
        
        $company->save();

        $contact_information->street_name = request('street_name');
        $contact_information->house_number = request('house_number');
        $contact_information->city = request('city');
        $contact_information->zipcode = request('zipcode');
        $contact_information->email = request('email');
        $contact_information->phone = request('phone');
        
        $contact_information->save();

        return redirect('/admin/klanten/bedrijven');
    }

    public function delete()
    {
        $company = Company::find(request('id'));
        $company->delete();
        
        return redirect('/admin/klanten/bedrijven');
    }
}
