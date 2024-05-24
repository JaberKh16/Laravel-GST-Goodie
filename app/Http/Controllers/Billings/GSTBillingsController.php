<?php

namespace App\Http\Controllers\Billings;

use App\Models\Party;
use App\Models\GSTBillings;
use Illuminate\Http\Request;
use App\Models\PartiesInformation;
use App\Http\Controllers\Controller;

class GSTBillingsController extends Controller
{
    public function gst_billings_index()
    {
        $gst_billings = GSTBillings::all();
        return view('pages.billings.gst-bill-table');
    }

    public function gst_billings_create_form_view()
    {
        // get all Party records
        $party = PartiesInformation::all(); 
        // call the static method
        $parties_type = Party::get_available_parties_type($party); 
        return view('pages.billings.gst-bill-form', compact('party'));
    }
}
