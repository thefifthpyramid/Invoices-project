<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\sections;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table_data = sections::all();
        return view("sections.section",compact('table_data'));
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
        $input = $request->all();
        //return $input;
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',],[
                'section_name.required' => 'اسم القسم الزامي',
                'section_name.unique' => 'هذا القسم موجود بالفعل',
                'description.required' => 'وصف القسم الزامي',
        ]);
        //$b_exist = sections::where('section_name','=',$input['section_name'])->exists();
        //if ($validatedData) {
            //session()->flash("ErorrMsg","القسم موجود من قبل");
            //return redirect('/sections');
        //}else{
        sections::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => (Auth::user()->name)
        ]);
        session()->flash("successfuly","تمت اضافة القسم بنجاح");
        return redirect('/sections');
       // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $id = $request->id;
        // //return $input;
        $validatedData = $request->validate([
            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',],[
                'section_name.required' => 'فشلت عمليةالتعديل: يرجي ملئ حقل اسم القسم',
                'section_name.unique' => 'فشلت عملية التعديل: هذاالقسم موجود بالفعل',
                'description.required' =>  'فشلت عمليةالتعديل: يرجي ملئ حقل وصف القسم'
        ]);
        $section = sections::find($id);
        $section->section_name = $request->input('section_name');
        $section->description = $request->input('description');
        $section->update();
        return redirect()->back()->with('update_msg','تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = sections::find($id);
        $section->delete();
        return redirect()->back()->with('delete_msg','تم حذف القسم بنجاح');
    }
}
