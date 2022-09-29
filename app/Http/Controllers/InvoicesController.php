<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\invoices;
use App\Notifications\noti_CreatInvoices;
use App\invoices_details;
use App\invoices_attechments;
use App\sections;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Notifications\NotificationInvoicePaid;
use App\User;

// Excel
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    function __construct()
    {
         $this->middleware('permission:الفواتير', ['only' => ['index']]);
    }



    public function index($id = null)
    {
        // condition 
        if($id === 'paid'){
            $table_data = invoices::where('Value_Status',2)->get();
            return view('invoices.invoices_paid',compact('table_data'));
        }else if ($id === 'Partial'){
            $table_data = invoices::where('Value_Status',3)->get();
            return view('invoices.Invoice_Partial',compact('table_data'));
        }else{
            $table_data = invoices::all();
            return view('invoices.invoices',compact('table_data'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        return view('invoices.add_invoices',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 1,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 1,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attechments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        //$user = User::first();
        $user = User::get();

        // $details = [
        //         'greeting' => 'Hi Artisan',
        //         'body' => 'This is our example notification tutorial',
        //         'thanks' => 'Thank you for visiting codechief.org!',
        // ];
        $invoices = Invoices::latest()->first();
        Notification::send($user, new noti_CreatInvoices($invoices));
       // $user->notify(new \App\Notifications\noti_CreatInvoices($invoices));
        //%%% mail %%%
        // $user = User::get();
        // $invoices = invoices::latest()->first();
        // Notification::send($user, new NotificationInvoicePaid($invoices));

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices,$id)
    {
        $sections =  sections::all();
        $invoice = invoices::find($id)->first();
        //return $invoice;
        return view('invoices.editing_invoices',compact('sections','invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = invoices::find($id);
        //return $request;
        $table->invoice_number = $request->invoice_number;
        $table->invoice_Date = $request->invoice_Date;
        $table->Due_date = $request->Due_date;
        $table->product = $request->product;
        $table->section_id = $request->Section;
        $table->Amount_collection = $request->Amount_collection;
        $table->Amount_Commission = $request->Amount_Commission;
        $table->Discount = $request->Discount;
        $table->Value_VAT = $request->Value_VAT;
        $table->Rate_VAT = $request->Rate_VAT;
        $table->Total = $request->Total;
        $table->note = $request->note;
        $table->update();
        return redirect('invoices')->with('successfuly', 'تم تعديل الفاتورة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function invoices_trash(){
        $table_data = invoices::onlyTrashed()->get();
        return view('invoices.invoicesTrash',compact('table_data'));
    }
    public function restore_invoice($id){
        Invoices::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('successfuly', 'تم اعادة الفاتورة بنجاح');
    }
    public function destroy($id)
    {
        $data_table = invoices::find($id);
        if (!empty($data_table->invoice_number)) {

            Storage::disk('public_uploads')->deleteDirectory($data_table->invoice_number);
        }
        $data_table->forceDelete();
        return redirect()->back()->with('delete_msg','تم حذف الفاتورة بنجاح');
    }
    public function ToTrash($id){
        $data_table =  invoices::find($id);
        $data_table->delete();
        return redirect()->back()->with('delete_msg','تم نقل الفاتورة الي سلة المهملات بنجاح');
    }
    public function getproducts($id){
        $products = DB::table('products')->where('section_id',$id)->pluck('product_name','id');
        return json_encode($products);
    }
    // Excel
    public function export() 
    {
        return Excel::download(new invoices, 'Invoices.xlsx');
    }
    public function Status_show($id){
        $invoice = invoices::find($id);
        $sections = sections::all();
        return view('invoices.status_invoices',compact('invoice','sections'));
    }
    public function status_update(Request $request,$id){

        //return $request->Status;
        $data_table = invoices::find($id);
        if($request->Status === '2'){
            $data = new invoices_details;
            $data->id_Invoice = $id;
            $data->invoice_number = $request->invoice_number;
            $data->product = $request->product;
            $data->Section = $request->Section;
            $data->Status = "مدفوعة";
            $data->Value_Status = $request->Status;
            $data->note = $request->note;
            $data->Payment_Date = $request->Payment_Date;
            $data->user = (Auth::user()->name);
            $data->save();
        }else if($request->Status === '3'){
            $data = new invoices_details;
            $data->id_Invoice = $id;
            $data->invoice_number = $request->invoice_number;
            $data->product = $request->product;
            $data->Section = $request->Section;
            $data->Status = "مدفوعة جزئيا";
            $data->Value_Status = $request->Status;
            $data->note = $request->note;
            $data->Payment_Date = $request->Payment_Date;
            $data->user = (Auth::user()->name);
            $data->save();
        }
        // Update the Payment date
        $data_table->Value_Status = $request->Status;
        //$data_table->Payment_Date = $request->Payment_Date;
        $data_table->update();

        // Creat the invoice details status
        // Redirect
        session()->flash('Status_Update');
        return redirect('/invoices');
        
    }
    public function PrintInvoice($id){
        $invoice_data = invoices::where('id',$id)->first();
        return view('invoices.printInvoice',compact('invoice_data'));
    }
    // Export Excel
    public function exportExcel(){
        return Excel::download(new InvoicesExport, 'users.xlsx');
    }
    public function MarkAsRead_All(Request $request){
        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }

    }
}
