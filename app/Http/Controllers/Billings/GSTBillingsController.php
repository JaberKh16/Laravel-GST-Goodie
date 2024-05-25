<?php

namespace App\Http\Controllers\Billings;

use Carbon\Carbon;
use App\Models\Party;
use App\Models\GSTBillings;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Models\PartiesInformation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class GSTBillingsController extends Controller
{
    public function gst_billings_index()
    {
        $gst_billings_record = GSTBillings::paginate(2);
        return view('pages.billings.gst-bill-table', compact('gst_billings_record'));
    }

    public function gst_billings_create_form_view()
    {
        // get all Party records
        $party = Party::all(); 
        // call the static method
        $parties_type = Party::get_available_parties_type($party); 
        // get the invoice generated code
        $invoice_code = $this->generate_invoice_code(12);

        return view('pages.billings.gst-bill-form', compact('parties_type', 'invoice_code'));
    }

    public function generate_invoice_code($length)
    {
        // ensure the length is at least the minimum required to have both letters and digits
        if ($length < 5) {
            throw new InvalidArgumentException('Length must be at least 5');
        }

        // Calculate the number of letters and digits needed
        $numLetters = 4;
        $numDigits = $length - $numLetters;

        // Generate the letters and digits
        $letters = Str::upper(Str::random($numLetters));
        $digits = substr(str_shuffle(str_repeat('0123456789', $numDigits)), 0, $numDigits);

        // Combine the letters and digits
        $invoice_code = $letters . $digits;

        return $invoice_code;
    }
    
    public function gst_billings_create_form_store(Request $request)
    {
        $validated = $request->validate([
            'parties_type_id' => ['required', 'integer'],
            'invoice_date' => ['required', 'string', 'max:15'],
            'invoice_no' => ['required', 'string', 'regex:/^[A-Z]{4}[0-9]{8}$/'],
            'item_description' => ['required', 'string',  'max:300'],
            'cgst_rate' => ['required', 'string', 'digits_between:1,5'],
            'sgst_rate' => ['required', 'string', 'digits_between:1,5'],
            'igst_rate' => ['required', 'string', 'digits_between:1,5'],
            'cgst_amount' => ['required', 'string', 'digits_between:1,5'],
            'sgst_amount' => ['required', 'string', 'digits_between:1,5'],
            'igst_amount' => ['required', 'string', 'digits_between:1,5'],
            'tax_amount' => ['required', 'string', 'digits_between:1,5'],
            'net_amount' => ['required', 'string', 'digits_between:1,5'],
            'total_amount' => ['required', 'string', 'digits_between:1,5'],
            'declaration' => ['required', 'string', 'min:6', 'max:30'], 
        ]);

        if($validated){
            // get the total amount
            $total_amount = $this->calculate_total_amount($request);

            $gst_info_inserted = DB::table('g_s_t_billings')->insert([
                'parties_type_id' => $request->parties_type_id,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_description' => $request->item_description,
                'cgst_rate' => $request->cgst_rate,
                'sgst_rate' => $request->sgst_rate,
                'igst_rate' => $request->igst_rate,
                'cgst_amount' => $request->cgst_amount,
                'sgst_amount' => $request->sgst_amount,
                'igst_amount' => $request->igst_amount,
                'tax_amount' => $request->tax_amount,
                'net_amount' => $request->net_amount,
                'total_amount' => $total_amount,
                'declaration' => $request->declaration,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if($gst_info_inserted){
                return redirect()->route('gst.billings.info')->with('success', 'GST Billing record inserted successfully.');
            }else{
                return redirect()->route('gst.billings.info')->with('error', 'GST Billing record insertion failed.');
            }
        }
    }

    public function calculate_total_amount(Request $request)
    {
        $total_amount = $request->cgst_amount * $request->cgst_rate   + $request->sgst_amount * $request->sgst_rate + $request->igst_amount * $request->igst_rate;
        return $total_amount;  
    }


    public function gst_billings_edit_form_view(string $id)
    {
        $billings = GSTBillings::findOrFail($id);
        return view('pages.billings.gst-bill-edit-form', compact('billings'));
    }

      public function gst_billings_update_form_store(Request $request, string $id)
    {
        $validated = $request->validate([
            'invoice_date' => ['required', 'string', 'max:15'],
            'invoice_no' => ['required', 'string', 'regex:/^[A-Z]{4}[0-9]{8}$/'],
            'item_description' => ['required', 'string',  'max:300'],
            'cgst_rate' => ['required', 'string', 'digits_between:1,5'],
            'sgst_rate' => ['required', 'string', 'digits_between:1,5'],
            'igst_rate' => ['required', 'string', 'digits_between:1,5'],
            'cgst_amount' => ['required', 'string', 'digits_between:1,5'],
            'sgst_amount' => ['required', 'string', 'digits_between:1,5'],
            'igst_amount' => ['required', 'string', 'digits_between:1,5'],
            'tax_amount' => ['required', 'string', 'digits_between:1,5'],
            'net_amount' => ['required', 'string', 'digits_between:1,5'],
            'total_amount' => ['required', 'string', 'digits_between:1,5'],
            'declaration' => ['required', 'string', 'min:6', 'max:30'], 
        ]);

        if($validated){
            // get the total amount
            $total_amount = $this->calculate_total_amount($request);

            // find the data
            $gst_info = GSTBillings::findOrFail($id);
            
            $gst_info->invoice_date = $validated['invoice_date'];
            $gst_info->invoice_no = $validated['invoice_no'];
            $gst_info->item_description = $validated['item_description'];
            $gst_info->cgst_rate = $validated['cgst_rate'];
            $gst_info->sgst_rate = $validated['sgst_rate'];
            $gst_info->igst_rate = $validated['igst_rate'];
            $gst_info->cgst_amount = $validated['cgst_amount'];
            $gst_info->sgst_amount = $validated['sgst_amount'];
            $gst_info->igst_amount = $validated['igst_amount'];
            $gst_info->tax_amount = $validated['tax_amount'];
            $gst_info->total_amount = $validated['total_amount'];
            $gst_info->declaration = $validated['declaration'];

            $gst_info_updated = $gst_info->save();

            if($gst_info_updated){
                return redirect()->route('gst.billings.info')->with('success', 'GST Billing record updated successfully.');
            }else{
                return redirect()->route('gst.billings.info')->with('error', 'GST Billing record updation failed.');
            }
        }
    }


    public function gst_billings_delete_record(string $id)
    {
        $msg = null;
        try{
            $find_party = GSTBillings::where('id', $id)->first();
            $msg = 'Billings deleted successfully.';
            if($find_party != null){
                $find_party->delete();
                return redirect()->route('gst.billings.info')->with('success', $msg);
            }
        }catch(Exception $e){
            return redirect()->route('gst.billings.info')->with('error', $msg = $e->getMessage());
        }
    }

    public function search_info_process(Request $request)
    {
        $query = $request->input('query');

        $request->validate([
            'query' => 'required|string|max:100',
        ]);

        // search the parties based on the query
        $gst_billings_record = GSTBillings::where('invoice_date', 'LIKE', "%{$query}%")
                        ->orWhere('invoice_no', 'LIKE', "%{$query}%")
                        ->orWhere('item_description', 'LIKE', "%{$query}%")
                        ->orWhere('created_at', 'LIKE', "%{$query}%")
                        ->paginate(5);

        // return the view with the search results
        // return view('pages.billings.gst-bill-table', ['gst_billings_record' => $gst_billings_record, 'serial_no' => 1]);


        // check if there are any records
        if ($gst_billings_record->isEmpty()) {
            return view('pages.billings.gst-bill-table', [
                'gst_billings_record' => null,
                'serial_no' => 1,
                'message' => 'No records found for your search query.'
            ]);
        } else {
            return view('pages.billings.gst-bill-table', [
                'gst_billings_record' => $gst_billings_record,
                'serial_no' => 1,
                'message' => null
            ]);
        }
    }


}
