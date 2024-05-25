<?php

namespace App\Http\Controllers\Party;

use Carbon\Carbon;
use App\Models\Party;
use Illuminate\Http\Request;
use App\Models\PartiesInformation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class PartiesInformationController extends Controller
{
    public function parties_info_index()
    {

        $parties_record = PartiesInformation::paginate(2);

        // create an array to hold the parties types
        $parties_type = [];

        // fetch the parties types based on parties_type_id from parties_information records
        foreach ($parties_record as $record) {
            $party = DB::table('parties')->select('parties_type')->where('id', $record->parties_type_id)->first();
            $parties_type[$record->id] = $party ? $party->parties_type : null;
        }


        if($parties_record){
            return view('pages.parties_info.parties-table', compact('parties_record', 'parties_type'));
        }
        return view('pages.parties_info.parties-table');
    }

    public function parties_info_create_form_view()
    {
        // get all Party records
        $party = Party::all(); 
        // call the static method
        $parties_type = Party::get_available_parties_type($party); 

        return view('pages.parties_info.parties-form', compact('parties_type'));
    }

    public function parties_info_create_form_store(Request $request)
    {
        $validated = $request->validate([
            'parties_type_id' => ['required', 'integer'],
            'fullname' => ['required', 'string', 'min:3', 'max:30'],
            'contact' => ['required', 'string', 'min:11', 'max:13'],
            'address' => ['required', 'string', 'min:8', 'max:100'],
            'account_holder_name' => ['required', 'string', 'min:3', 'max:30'],
            'account_no' => ['required', 'string', 'min:8', 'max:11'], 
            'bank_name' => ['required', 'string', 'min:6', 'max:30'],
            'ifsc_code' => ['required', 'string', 'regex:/^[A-Z]{4}[A-Z]{2}[A-Z]{2}[0-9]{3}$/'],
            'branch_address' => ['required', 'string', 'min:8', 'max:100'],
        ]);

        if($validated){
            $party_info_inserted = DB::table('parties_information')->insert([
                'parties_type_id' => $request->parties_type_id,
                'fullname' => $request->fullname,
                'contact' => $request->contact,
                'address' => $request->address,
                'account_holder_name' => $request->account_holder_name,
                'account_no' => $request->account_no,
                'bank_name' => $request->bank_name,
                'ifsc_code' => $request->ifsc_code,
                'branch_address' => $request->branch_address,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if($party_info_inserted){
                return redirect()->route('parties.info')->with('success', 'Parties record inserted successfully.');
            }else{
                return redirect()->route('parties.info')->with('error', 'Parties record insertion failed.');
            }
        }
        
    }


    public function parties_info_edit_form_view(string $id)
    {
        $party = PartiesInformation::findOrFail($id);
        $parties_type = ['Client', 'Employee', 'Vendor'];
        return view('pages.parties_info.parties-edit-form', compact('party', 'parties_type'));
    }

    public function parties_info_update_form_store(Request $request, string $id)
    {
        $validated = $request->validate([
            'fullname' => ['required', 'string', 'min:3', 'max:30'],
            'contact' => ['required', 'string', 'min:11', 'max:13'],
            'address' => ['required', 'string', 'min:8', 'max:100'],
            'account_holder_name' => ['required', 'string', 'min:3', 'max:30'],
            'account_no' => ['required', 'string', 'min:8', 'max:11'], 
            'bank_name' => ['required', 'string', 'min:6', 'max:30'],
            'ifsc_code' => ['required', 'string', 'regex:/^[A-Z]{4}[A-Z]{2}[A-Z]{2}[0-9]{3}$/'],
            'branch_address' => ['required', 'string', 'min:8', 'max:100'],
        ]);

        if($validated){
            $party_info = PartiesInformation::findOrFail($id);

            $party_info->fullname = $validated['fullname'];
            $party_info->contact = $validated['contact'];
            $party_info->address = $validated['address'];
            $party_info->account_holder_name = $validated['account_holder_name'];
            $party_info->account_no = $validated['account_no'];
            $party_info->bank_name = $validated['bank_name'];
            $party_info->ifsc_code = $validated['ifsc_code'];
            $party_info->branch_address = $validated['branch_address'];

            $party_info_updated = $party_info->save();

            if($party_info_updated){
                return redirect()->route('parties.info')->with('success', 'Parties record updated successfully.');
            }else{
                return redirect()->route('parties.info')->with('error', 'Parties record updation failed.');
            }
        }
        
    }

    public function parties_info_delete_record(string $id)
    {
        $msg = null;
        try{
            $find_party = PartiesInformation::where('id', $id)->first();
            $msg = 'Party deleted successfully.';
            if($find_party != null){
                $find_party->delete();
                return redirect()->route('parties.info')->with('success', $msg);
            }
        }catch(Exception $e){
            return redirect()->route('parties.info')->with('error', $msg = $e->getMessage());
        }
    }


    public function search_info_process(Request $request)
    {
        $query = $request->input('query');

        $request->validate([
            'query' => 'required|string|max:100',
        ]);

        // search the parties based on the query
        $parties_record = PartiesInformation::where('fullname', 'LIKE', "%{$query}%")
                        ->orWhere('contact', 'LIKE', "%{$query}%")
                        ->orWhere('account_holder_name', 'LIKE', "%{$query}%")
                        ->orWhere('account_no', 'LIKE', "%{$query}%")
                        ->orWhere('bank_name', 'LIKE', "%{$query}%")
                        ->orWhere('ifsc_code', 'LIKE', "%{$query}%")
                        ->orWhere('branch_address', 'LIKE', "%{$query}%")
                        ->paginate(5);

        // Check if there are any records
        if ($parties_record->isEmpty()) {
            return view('pages.parties_info.parties-table', [
                'parties_record' => null,
                'serial_no' => 1,
                'message' => 'No records found for your search query.'
            ]);
        } else {
            return view('pages.parties_info.parties-table', [
                'parties_record' => $parties_record,
                'serial_no' => 1,
                'message' => null
            ]);
        }

    }
}
