<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = $request -> validate([
            'section_name' => 'required|unique:sections',
            'description' => 'required'
        ]);

        $section = Section::create([
            'section_name' => $request -> section_name,
            'description' => $request -> description,
            'created_by' => $request -> created_by
        ]);

        return redirect() -> back() -> with(["message" => "تم إضافة القسم بنجاح"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request -> id;
         $this -> validate($request,[
            'section_name' => 'required',Rule::unique('sections')->ignore($id),
            ##Rule unique ignore (we use this if we have a unique value that will not be updated)
            'description' => 'required'
        ]);

        $section = Section::FindorFail($id);
        $section -> update([
                            "section_name" => $request -> section_name,
                            "description" => $request -> description
                           ]);
        return redirect() -> back() -> with(["message" => "تم تعديل القسم بنجاح"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request -> id;
        $section = Section::FindorFail($request -> id);
        $section -> delete();
        return redirect() -> back();
    }
}
