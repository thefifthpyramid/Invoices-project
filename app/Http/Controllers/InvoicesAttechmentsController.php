<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\invoices_attechments;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class InvoicesAttechmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'file_name' => 'mimes:pdf,jpeg,png,jpg',
        
        ], [
            'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);
        
        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();

        $attachments =  new invoices_attechments();
        $attachments->file_name = $file_name;
        $attachments->invoice_number = $request->invoice_number;
        $attachments->invoice_id = $request->invoice_id;
        $attachments->Created_by = Auth::user()->name;
        $attachments->save();
        
        // move pic
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'. $request->invoice_number), $imageName);
        
        session()->flash('Add', 'تم اضافة المرفق بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices_attechments  $invoices_attechments
     * @return \Illuminate\Http\Response
     */
    public function show($folder_name,$file_name)
    {
        
        $file_path = app_path().'/../public/Attachments/'.$folder_name.'/'.$file_name;
        //return$file_path;
        return Storage::download($file_path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices_attechments  $invoices_attechments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attechments $invoices_attechments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices_attechments  $invoices_attechments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attechments $invoices_attechments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices_attechments  $invoices_attechments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = invoices_attechments::find($id);
        $file_path = app_path().'/../public/Attachments/'.$item->invoice_number.'/'.$item->file_name;

        File::delete($file_path);
        $item->delete();
        return redirect()->back()->with('delete_msg','تم حذف القسم بنجاح');
    }
}
