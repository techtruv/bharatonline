<?php

namespace App\Http\Controllers;

use App\Models\LedgerMaster;
use App\Models\AccountGroup;
use Illuminate\Http\Request;
use Validator;
use Auth;

class LedgerMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = LedgerMaster::with(['group', 'creator', 'updater'])
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $groups = AccountGroup::where('status', 'Active')->orderBy('group_name')->get();
        $types = ['General', 'Party', 'Vehicle', 'Consignee', 'Consignor', 'Self Vehicle'];
        
        return view('admin.ledgerMaster', compact('records', 'groups', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = AccountGroup::where('status', 'Active')->orderBy('group_name')->get();
        $types = ['General', 'Party', 'Vehicle', 'Consignee', 'Consignor', 'Self Vehicle'];

        return view('admin.ledgerMaster', compact('groups', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'type' => 'required|in:General,Party,Vehicle,Consignee,Consignor,Self Vehicle',
            'name' => 'required|string|max:255|unique:ledger_masters,name',
            'short_name' => 'nullable|string|max:50',
            'under_group_id' => 'nullable|exists:account_groups,id',
            'opening_balance' => 'nullable|numeric|min:0',
            'dr_cr' => 'required|in:DR,CR',
            'balance_type' => 'required|in:Bill by Bill,On Account',
            'status' => 'required|in:Active,Inactive',
            'remarks' => 'nullable|string',
            
            // Corporate Address Tab
            'address_line_1' => 'nullable|string',
            'state' => 'nullable|string|max:100',
            'telephone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:15',
            'contact_person_name' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:15',
            'contact_person_designation' => 'nullable|string|max:100',
            'contact_person_mobile_2' => 'nullable|string|max:15',
            'gst_number' => 'nullable|string|max:20',
            'gst_registration_type' => 'nullable|in:Registered,Unregistered',
            
            // Other Details Tab
            'pan_no' => 'nullable|string|max:20',
            'aadhar_no' => 'nullable|string|max:20',
            'service_tax_no' => 'nullable|string|max:20',
            'credit_days' => 'nullable|integer|min:0',
            'credit_limit' => 'nullable|numeric|min:0',
            'credit_bills' => 'nullable|integer|min:0',
            'follow_up' => 'nullable|in:Inform Only,Stop Billing',
            'collection_day' => 'nullable|integer|min:1|max:31',
            'category' => 'required|in:Distributor,Stockist,Wholesaler,Retailer,None',
            'bill_desc_percent' => 'nullable|numeric|min:0|max:100',
            
            // Personal Details Tab
            'bank_name' => 'nullable|string|max:255',
            'bank_branch' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|max:11',
            'account_no' => 'nullable|string|max:50',
            'bank_address' => 'nullable|string',
            'dob' => 'nullable|date',
            'dom' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $input['created_by'] = Auth::user()->id;
        $input['updated_by'] = Auth::user()->id;
        $input['opening_balance'] = $input['opening_balance'] ?? 0;

        LedgerMaster::create($input);

        return redirect(route('ledgerMaster.index'))
            ->with('success', 'Ledger Master created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $records = LedgerMaster::with(['group', 'creator', 'updater'])
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $data = LedgerMaster::find($id);
        
        if (!$data) {
            return redirect(route('ledgerMaster.index'))
                ->with('error', 'Ledger Master not found');
        }

        $groups = AccountGroup::where('status', 'Active')->orderBy('group_name')->get();
        $types = ['General', 'Party', 'Vehicle', 'Consignee', 'Consignor', 'Self Vehicle'];

        return view('admin.ledgerMaster', compact('records', 'data', 'groups', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ledger = LedgerMaster::find($id);

        if (!$ledger) {
            return redirect(route('ledgerMaster.index'))
                ->with('error', 'Ledger Master not found');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'type' => 'required|in:General,Party,Vehicle,Consignee,Consignor,Self Vehicle',
            'name' => 'required|string|max:255|unique:ledger_masters,name,' . $id,
            'short_name' => 'nullable|string|max:50',
            'under_group_id' => 'nullable|exists:account_groups,id',
            'opening_balance' => 'nullable|numeric|min:0',
            'dr_cr' => 'required|in:DR,CR',
            'balance_type' => 'required|in:Bill by Bill,On Account',
            'status' => 'required|in:Active,Inactive',
            'remarks' => 'nullable|string',
            
            // Corporate Address Tab
            'address_line_1' => 'nullable|string',
            'state' => 'nullable|string|max:100',
            'telephone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:15',
            'contact_person_name' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:15',
            'contact_person_designation' => 'nullable|string|max:100',
            'contact_person_mobile_2' => 'nullable|string|max:15',
            'gst_number' => 'nullable|string|max:20',
            'gst_registration_type' => 'nullable|in:Registered,Unregistered',
            
            // Other Details Tab
            'pan_no' => 'nullable|string|max:20',
            'aadhar_no' => 'nullable|string|max:20',
            'service_tax_no' => 'nullable|string|max:20',
            'credit_days' => 'nullable|integer|min:0',
            'credit_limit' => 'nullable|numeric|min:0',
            'credit_bills' => 'nullable|integer|min:0',
            'follow_up' => 'nullable|in:Inform Only,Stop Billing',
            'collection_day' => 'nullable|integer|min:1|max:31',
            'category' => 'required|in:Distributor,Stockist,Wholesaler,Retailer,None',
            'bill_desc_percent' => 'nullable|numeric|min:0|max:100',
            
            // Personal Details Tab
            'bank_name' => 'nullable|string|max:255',
            'bank_branch' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|max:11',
            'account_no' => 'nullable|string|max:50',
            'bank_address' => 'nullable|string',
            'dob' => 'nullable|date',
            'dom' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $input['updated_by'] = Auth::user()->id;
        $input['opening_balance'] = $input['opening_balance'] ?? 0;

        $ledger->update($input);

        return redirect(route('ledgerMaster.index'))
            ->with('success', 'Ledger Master updated successfully');
    }

    /**
     * Delete the specified resource.
     */
    public function destroy($id)
    {
        $ledger = LedgerMaster::find($id);

        if (!$ledger) {
            return redirect(route('ledgerMaster.index'))
                ->with('error', 'Ledger Master not found');
        }

        $ledger->delete();

        return redirect(route('ledgerMaster.index'))
            ->with('success', 'Ledger Master deleted successfully');
    }

    /**
     * Get ledgers by type (AJAX)
     */
    public function getByType($type)
    {
        $ledgers = LedgerMaster::where('type', $type)
            ->where('status', 'Active')
            ->select('id', 'name', 'short_name')
            ->get();

        return response()->json($ledgers);
    }

    /**
     * Verify GST Number (AJAX)
     */
    public function verifyGst(Request $request)
    {
        $gstNumber = $request->input('gst_number');

        // Validation for GST format (15 characters, alphanumeric)
        if (!preg_match('/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/', $gstNumber)) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Invalid GST Number format'
            ]);
        }

        // Here you can add API call to verify GST from GSTIN API
        // For now, we'll just validate the format
        return response()->json([
            'status' => 'valid',
            'message' => 'GST Number format is valid'
        ]);
    }
}
