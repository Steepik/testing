<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('home', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()) {
            $validator = Validator::make($request->except(['_token', '_method']), [
                'name' => 'required|min:1',
                'surname' => 'required|min:1',
                'email' => 'email|unique:contacts,email',
                'phone' => 'required|min:6',
                'birth' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(Lang::get($validator->errors()->first()));
            }
            Contact::create($request->except(['_token', '_method']));

            return response()->json(['success' => true], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        if(is_null($contact)) return redirect('/home');
        return view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax()) {
            $validator = Validator::make($request->except(['_token', '_method']), [
                'email' => 'email|unique:contacts,email,' . $id,
            ]);

            if ($validator->fails()) {
                return response()->json(Lang::get($validator->errors()->first()));
            }

            $contact = Contact::find($id);
            $result = $contact->update($request->except(['_token', '_method']));
            if ($result) {
                return response()->json(['success' => true], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if($contact->destroy($id)) {
            return response()->json(['success' => true], 200);
        }
    }
}
