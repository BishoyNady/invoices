<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\invoice_detail;
use App\Models\invoice_attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoiceDetailController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice_detail  $invoice_detail
     * @return \Illuminate\Http\Response
     */
    public function show(invoice_detail $invoice_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice_detail  $invoice_detail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $getid = DB::table('notifications')->where('data->id',$id)->pluck('id');
        // DB::table('notifications')->where('id',$getid)->update(['read_at'=>now()]);

        

        $invoices = invoice::where('id',$id)->first();
        $details  = invoice_Detail::where('id_Invoice',$id)->get();
        $attachments  = invoice_attachment::where('invoice_id',$id)->get();

        
        return view('invoices.details_invoice',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoice_detail  $invoice_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice_detail $invoice_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoice_detail  $invoice_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = invoice_attachment::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function open_file($invoice_number,$file_name)

    {
        
        
        $dir="Attachments";
        $file = public_path($dir.'/'.$invoice_number.'/'.$file_name);      
        return response()->file($file);
    }

    public function get_file($invoice_number,$file_name)

    {
        $dir="Attachments";
        $file = public_path($dir.'/'.$invoice_number.'/'.$file_name);
        return response()->download($file);
    }
}
