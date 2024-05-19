<?php

namespace App\Http\Controllers\Party;

use App\Http\Controllers\Controller;
use App\Models\PartiesInformation;
use App\Models\Party;
use Illuminate\Http\Request;

class PartiesInformationController extends Controller
{
    public function parties_info_index()
    {
        // $parties_record = PartiesInformation::paginate(2);
        return view('pages.parties_info.parties-table');
    }

    public function parties_info_create_form_view()
    {
        $party = Party::first();

        // dd($parties_id);
        $parties_type =  PartiesInformation::whereBelongsTo($parties_id)->get();
        dd($parties_type);
    
        return view('pages.parties_info.parties-form');
    }

    public function parties_info_create_form_store()
    {

    }


    public function search_info_process()
    {

    }
}
