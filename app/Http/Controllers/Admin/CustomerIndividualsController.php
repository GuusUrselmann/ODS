<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator; 
use App\Customer;
use App\ContactInformation;
use App\User;

class CustomerIndividualsController extends Controller
{
    public function individuals()
    {
        $individuals = Customer::all();

        return view('admin.customers.individuals.individuals', ['individuals' => $individuals]);
    }

    public function add()
    {
        return view('admin.customers.individuals.add');
    }

    public function edit()
    {
        $individual = Customer::find(request('id'));

        return view('admin.customers.individuals.edit', ['individual' => $individual]);
    }

    public function save()
    {
        $individual = new Customer();
        $user = new User();
        $contact_information = new ContactInformation();

        $contact_information->street_name = request('street_name');
        $contact_information->house_number = request('house_number');
        $contact_information->city = request('city');
        $contact_information->zipcode = request('zipcode');
        $contact_information->email = request('email');
        $contact_information->phone = request('phone');

        $contact_information->save();

        $user->username = request('username');
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');

        $user->save();

        $individual->preferred_payment_method = request('preferred_payment_method');

        $individual->save();

        return redirect('/admin/klanten/particulieren');
    }

    /**
     * Update existing individual customer.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|max:50',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'street_name' => 'required|max:100',
            'house_number' => 'required|numeric',
            'city' => 'required|max:50',
            'zipcode' => 'required|alpha_num|max:6',
            'phone' => 'required|max:20',
            'email' => 'required|email',
            'preferred_payment_method' => 'required', 
        ]);

        $individual = Customer::find(request('customer_id'));
        $user = User::find($individual->user_id);
        $contact_information = ContactInformation::find($individual->contact_information_id);

        $contact_information->street_name = request('street_name');
        $contact_information->house_number = request('house_number');
        $contact_information->city = request('city');
        $contact_information->zipcode = request('zipcode');
        $contact_information->phone = request('phone');

        $contact_information->save();

        $user->username = request('username');
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');

        $user->save();

        $individual->preferred_payment_method = request('preferred_payment_method');

        $individual->save();

        return redirect('/admin/klanten/particulieren');
    }

    public function delete()
    {
        $individual = Customer::find(request('id'));
        $user = User::find($individual->user_id);
        $contact_information = ContactInformation::find($individual->contact_information_id);

        $contact_information->delete();
        $user->delete();
        $individual->delete();

        return redirect('/admin/klanten/particulieren');
    }
}
