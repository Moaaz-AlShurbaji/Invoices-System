<?php

namespace App\Http\Controllers;

use App\Models\Invoice_Attachments;
use App\Models\Invoice_Detail;
use App\Models\invoices;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.invoices');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('invoices.add_invoice', compact("sections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        #This function will insert data into 3 tables (invoices, invoice_details, invoice_attachments)
        invoices::create([
            "invoice_number" => $request -> invoice_number,
            "invoice_date" => $request -> invoice_date,
            "due_date" => $request -> due_date,
            "product" => $request -> product,
            "section_id" => $request -> section_id,
            "amount_collection" => $request -> amount_collection,
            "amount_commission" => $request -> amount_commission,
            "discount" => $request -> discount,
            "value_vat" => $request -> value_vat,
            "rate_vat" => $request -> rate_vat,
            "total" => $request -> total,
            "status" => "غير مدفوعة",
            "value_statues" => 2,
            "note" => $request -> note,
            "user" => Auth::user()->email
        ]);

        $invoice_id = invoices::latest()->first()->id;

        Invoice_Detail::create([
            "invoice_id" => $invoice_id,
            "invoice_number" => $request -> invoice_number,
            "product" => $request -> product,
            "section" => $request -> section_id,
            "status" => "غير مدفوعة",
            "Value_Status" => 2,
            "note" => $request -> note,
            "user" => Auth::user()->email
        ]);

        if($request -> hasFile('pic'))
        {
            $invoice_id = invoices::latest()->first()->id;
            $image = $request -> file('pic');
            $file_name = $image -> getClientOriginalName();
            
            Invoice_Attachments::create([
                'file_name' => $file_name,
                'invoice_number' => $request -> invoice_number,
                'Created_by' => Auth::user()->email,
                'invoice_id' => $invoice_id
            ]);

            //move image to folder
            $request->pic->move(public_path('attachments/'.' '.$invoice_id), $file_name);
        }
        return redirect() -> back() -> with('message','تم اضافة الفاتورة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }
}
