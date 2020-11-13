<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;
use App\StandardExtra;
use App\StandardExtraOption;

class StandardExtrasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct() {
         $this->middleware('auth');
     }

    public function standardextras() {
        $standard_extras = StandardExtra::all();
        return view('admin.standardextras.standardextras', compact('standard_extras'));
    }

    public function add() {
        return view('admin.standardextras.add');
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/standaard-extras/toevoegen'))->with('errors', $errors);
        }
        $standard_extra = StandardExtra::create([
            'name' => $request->input('name'),
            'name_slug' => Str::slug($request->input('name'), '_'),
            'type' => $request->input('type')
        ]);
        foreach($request->input('extra_options') as $extra_option) {
            $amount = $extra_option['extra_amount'] != null? $extra_option['extra_amount'] : 0;
            StandardExtraOption::create([
                'name' => $extra_option['name'],
                'name_slug' => Str::slug($extra_option['name'], '_'),
                'extra_amount' => str_replace(',', '.', $amount),
                'standard_extra_id' => $standard_extra->id
            ]);
        }
        return redirect(url('/admin/standaard-extras'));
    }

    public function edit($id) {
        $standard_extra = StandardExtra::where('id', $id)->with('options')->first();
        return view('admin.standardextras.edit', compact('standard_extra'));
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/standaard-extras/bewerken/'.$id))->with('errors', $errors);
        }
        $standard_extra = StandardExtra::find($id);
        $standard_extra->update([
            'name' => $request->input('name'),
            'name_slug' => Str::slug($request->input('name'), '_'),
            'type' => $request->input('type')
        ]);
        $stored_options = $standard_extra->options;
        foreach($request->input('extra_options') as $extra_option) {
            if(StandardExtraOption::where('standard_extra_id', $id)->where('name_slug', Str::slug($request->input('name'), '_'))->first()) {
                $standard_extra_option = StandardExtraOption::where('standard_extra_id', $id)->where('name_slug', Str::slug($request->input('name'), '_'))->first();
                $amount = $extra_option['extra_amount'] != null? $extra_option['extra_amount'] : 0;
                $standard_extra_option->update([
                    'name' => $extra_option['name'],
                    'name_slug' => Str::slug($amount, '_'),
                    'extra_amount' => $extra_option['extra_amount']
                ]);
                $stored_options->forget($standard_extra_option->id);
            }
            else {
                $amount = $extra_option['extra_amount'] != null? $extra_option['extra_amount'] : 0;
                StandardExtraOption::create([
                    'name' => $extra_option['name'],
                    'name_slug' => Str::slug($extra_option['name'], '_'),
                    'extra_amount' => str_replace(',', '.', $amount),
                    'standard_extra_id' => $standard_extra->id
                ]);
            }
        }
        foreach($stored_options as $stored_option) {
            $stored_option->delete();
        }
        return redirect(url('/admin/standaard-extras'));
    }
}
