<?php

namespace App\Http\Controllers\Party;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class PartiesController extends Controller
{
    public function parties_index()
    {
        $parties_record = Party::paginate(2);
        return view('pages.parties_type.parties-table', compact('parties_record'));
    }

    public function parties_create_form_view()
    {
        $parties_type = ['Client', 'Employee', 'Vendor'];
    
        return view('pages.parties_type.parties-form', compact('parties_type'));
    }

    public function parties_create_form_store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:30', 'email'],
            'password' => ['required', 'string', 'min:6', 'max:8'],
            'parties_type' => ['required', 'string', 'max:20'],
        ]);

        $fields = [
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'parties_type' => $validated['parties_type'],
            'status' => 'non-verified',
        ];

        $parties_status = Party::create($fields);

        if ($parties_status) {
            return redirect()->route('parties.type.info')->with('success', 'Party created successfully.');
        } else {
            return redirect()->route('parties.type.info')->with('error', 'Party creation failed.');
        }
    }


    public function parties_edit_form_view(string $id)
    {
        $party = Party::findOrFail($id);
        $parties_type = ['Client', 'Employee', 'Vendor'];
        return view('pages.parties_type.parties-edit-form', compact('party', 'parties_type'));
    }


    public function parties_update_form_store(Request $request, string $id)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:30', 'email'],
            'password' => ['required', 'string', 'min:6', 'max:8'],
            'parties_type' => ['required', 'string', 'max:20'],
        ]);

        $party = Party::findOrFail($id);

        $party->email = $validated['email'];
        $party->password = bcrypt($validated['password']);
        $party->parties_type = $validated['parties_type'];
        $party->status = 'non-verified';

        if ($party->save()) {
            return redirect()->route('parties.type.info')->with('success', 'Party updated successfully.');
        } else {
            return redirect()->route('parties.type.info')->with('error', 'Party update failed.');
        }
    }

    public function parties_delete_record(string $id){
        $msg = null;
        try{
            $find_party = Party::where('id', $id)->first();
            $msg = 'Party deleted successfully.';
            if($find_party != null){
                $find_party->delete();
                return redirect()->route('parties.type.info')->with('success', $msg);
            }
        }catch(Exception $e){
            return redirect()->route('parties.type.info')->with('error', $msg = $e->getMessage());
        }
    }


    public function update_party_status($table, $id, $value)
    {
        $fields = null;
        if($table != null && $id != null && $value != null){
            $fields = array('status' => $value);
        }
        // $where = array('id' => $id);
        $update = DB::table($table)->where('id', $id)->update($fields);
        $msg = "Record has been successfully ";
        if ($update != null) {
            $action = ($value == 'verified') ? 'verified' : 'non-verified';
            return redirect()->back()->with('success', $msg . $action);
        } else {
            return redirect()->back()->with('error', $msg = "Something went wrong, please try again");
        }
    }

    public function search_process(Request $request)
    {
        $query = $request->input('query');

        $request->validate([
            'query' => 'required|string|max:100',
        ]);

        // search the parties based on the query
        $parties = Party::where('email', 'LIKE', "%{$query}%")
                        ->orWhere('parties_type', 'LIKE', "%{$query}%")
                        ->orWhere('status', 'LIKE', "%{$query}%")
                        ->paginate(5);

        // return the view with the search results
        return view('pages.parties_type.parties-table', ['parties_record' => $parties, 'serial_no' => 1]);

    }
}
