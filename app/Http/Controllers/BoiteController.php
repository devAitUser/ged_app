<?php

namespace App\Http\Controllers;

use App\Models\boite;
use Illuminate\Http\Request;

class BoiteController extends Controller
{

    public function index()
    {
        //$boites=Boite::all();

       $boites=Boite::latest()->paginate(5);
       return view('boite.index',compact('boites'));

    }


    public function create()
    {
        return view('boite.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'objet'=>'required',
            'num_boite'=>'required',
            'premier_date'=>'required',
            'dernier_date'=>'required',
            'code_topographe'=>'required'
        ]);
        $boite=Boite::create($request->all());
         return redirect()->route('boites.index')
         ->with('success','La  boîte est ajoutée avec success');
    }

    public function show(boite $boite)
    {
        return view('boite.show',compact('boite'));
    }

    public function edit(boite $boite)
    {
        return view('boite.edit',compact('boite'));
    }

    public function update(Request $request, boite $boite)
    {
        $request->validate([
            'objet'=>'required',
            'num_boite'=>'required',
            'premier_date'=>'required',
            'dernier_date'=>'required',
            'code_topographe'=>'required'
        ]);
        $boite->update($request->all());
         return redirect()->route('boites.index')
         ->with('success','La  boîte est modifiée avec success');
    }

    public function destroy(boite $boite)
    {
        $boite->delete();
        return redirect()->route('boites.index')
         ->with('success','boite deleted successfully');
    }
}
