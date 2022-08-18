<?php

namespace App\Http\Controllers;

use App\Models\Invoice_Attachments;
use App\Models\Invoice_Detail;
use App\Models\invoices;
use Illuminate\Http\Request;

class InvoiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $invoice = invoices::where('id',$id)->first();
        $details = Invoice_Detail::where('invoice_id',$id)->get();
        $attachments = Invoice_Attachments::where('invoice_id',$id)->get();
        //dd($details);
        return view("invoices.invoice_details",compact('invoice','details','attachments'));
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
     * @param  \App\Models\Invoice_Detail  $invoice_Detail
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_Detail $invoice_Detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice_Detail  $invoice_Detail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice_Detail  $invoice_Detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_Detail $invoice_Detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice_Detail  $invoice_Detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice_Detail $invoice_Detail)
    {
        //
    }
}
