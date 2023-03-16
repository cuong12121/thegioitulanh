<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\redirectLink;

class redirectLinkController extends Controller
{
    public function index()
    {

        return view('redirect.create');
    }

    public function store(Request $request)
    {
        
        $redirects = new redirectLink();
        $redirects->request_path = $request->request_path;
        $redirects->target_path  = $request->target_path;
        $redirects->save();
        return redirect(route('redirect.list'));
    }

    public function update(Request $request, $id)
    {
        $redirect = redirectLink::find($id);
        if(!empty($redirect)){
            $redirect->request_path = $request->request_path;
            $redirect->target_path  = $request->target_path;
            $redirect->save();
        }
        return redirect(route('redirect.list'));
    }

    public function remove(Request $request, $id)
    {
        $redirect = redirectLink::find($id);
        if(!empty($redirect)){

            $redirect->delete();
        }   

        return redirect(route('redirect.list'));
    }
    
    public function show($id)
    {
        $redirect = redirectLink::find($id);
        return view('redirect.create', compact('redirect'));
    }

    public function list()
    {
        $list = redirectLink::orderBy('updated_at', 'desc')->paginate(12);
        return view('redirect.list', compact('list'));

    }
}
