<?php

namespace App\Http\Controllers;

use App\Models\HsnMaster;
use Illuminate\Http\Request;

class HSNMasterController extends Controller
{
    /**
     * Display a listing of HSN Masters
     */
    public function index(Request $request)
    {
        $query = HsnMaster::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->search($request->search);
        }

        // Pagination
        $hsnMasters = $query->orderBy('hsn_code')->paginate(50);

        return view('admin.hsnMaster', [
            'hsnMasters' => $hsnMasters,
            'searchTerm' => $request->input('search'),
        ]);
    }

    /**
     * Show the form for creating a new HSN Master
     */
    public function create()
    {
        return view('admin.hsn_form', [
            'isEdit' => false,
            'hsnMaster' => null
        ]);
    }

    /**
     * Store a newly created HSN Master in storage
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'hsn_code' => 'required|string|max:255|unique:hsn_masters,hsn_code',
            'type' => 'required|string|max:255',
            'commodity' => 'required|string|max:255',
            'sgst_percent' => 'required|numeric|min:0|max:100',
            'cgst_percent' => 'required|numeric|min:0|max:100',
            'igst_percent' => 'required|numeric|min:0|max:100',
        ]);

        // Create HSN Master
        HsnMaster::create($validated);

        return redirect()->route('hsnMaster.index')
            ->with('success', 'HSN Master created successfully!');
    }

    /**
     * Show the form for editing the specified HSN Master
     */
    public function edit(HsnMaster $hsnMaster)
    {
        return view('admin.hsn_form', [
            'isEdit' => true,
            'hsnMaster' => $hsnMaster
        ]);
    }

    /**
     * Update the specified HSN Master in storage
     */
    public function update(Request $request, HsnMaster $hsnMaster)
    {
        // Validation - exclude current record from unique check
        $validated = $request->validate([
            'hsn_code' => 'required|string|max:255|unique:hsn_masters,hsn_code,' . $hsnMaster->id,
            'type' => 'required|string|max:255',
            'commodity' => 'required|string|max:255',
            'sgst_percent' => 'required|numeric|min:0|max:100',
            'cgst_percent' => 'required|numeric|min:0|max:100',
            'igst_percent' => 'required|numeric|min:0|max:100',
        ]);

        // Update HSN Master
        $hsnMaster->update($validated);

        return redirect()->route('hsnMaster.index')
            ->with('success', 'HSN Master updated successfully!');
    }

    /**
     * Remove the specified HSN Master from storage
     */
    public function destroy(HsnMaster $hsnMaster)
    {
        try {
            $hsnMaster->delete();

            return redirect()->route('hsnMaster.index')
                ->with('success', 'HSN Master deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting HSN Master: ' . $e->getMessage());
        }
    }

    /**
     * AJAX endpoint: Get HSN Master by code
     */
    public function getByCode($code)
    {
        $hsn = HsnMaster::where('hsn_code', $code)->first();

        if (!$hsn) {
            return response()->json([
                'success' => false,
                'message' => 'HSN code not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $hsn->id,
                'hsn_code' => $hsn->hsn_code,
                'commodity_name' => $hsn->commodity_name,
                'sgst_rate' => $hsn->sgst_rate,
                'cgst_rate' => $hsn->cgst_rate,
                'igst_rate' => $hsn->igst_rate,
                'cess_rate' => $hsn->cess_rate,
                'total_tax_rate' => $hsn->total_tax_rate,
                'is_exempted' => $hsn->is_exempted,
                'is_nil_rated' => $hsn->is_nil_rated,
            ]
        ]);
    }

    /**
     * AJAX endpoint: Get HSN Masters by type
     */
    public function getByType($type)
    {
        $hsnMasters = HsnMaster::byType($type)->active()->get();

        return response()->json([
            'success' => true,
            'data' => $hsnMasters->map(function ($hsn) {
                return [
                    'id' => $hsn->id,
                    'hsn_code' => $hsn->hsn_code,
                    'commodity_name' => $hsn->commodity_name,
                    'formatted_tax' => $hsn->formatted_tax,
                ];
            })
        ]);
    }

    /**
     * AJAX endpoint: Calculate tax amount
     */
    public function calculateTax(Request $request)
    {
        $request->validate([
            'hsn_id' => 'required|exists:hsn_masters,id',
            'amount' => 'required|numeric|min:0',
            'tax_type' => 'nullable|in:SGST,CGST,IGST,TOTAL_GST'
        ]);

        $hsn = HsnMaster::findOrFail($request->hsn_id);
        $amount = $request->amount;
        $taxType = $request->tax_type ?? 'TOTAL_GST';

        if (!$hsn->isTaxable()) {
            return response()->json([
                'success' => true,
                'tax_amount' => 0,
                'total_amount' => $amount,
                'message' => 'This HSN is tax exempted'
            ]);
        }

        $taxRate = $hsn->getTaxRateByType($taxType) / 100;
        $taxAmount = $amount * $taxRate;
        $totalAmount = $amount + $taxAmount;

        return response()->json([
            'success' => true,
            'amount' => $amount,
            'tax_rate' => $hsn->getTaxRateByType($taxType),
            'tax_amount' => round($taxAmount, 2),
            'total_amount' => round($totalAmount, 2),
            'is_exempted' => $hsn->is_exempted,
            'is_nil_rated' => $hsn->is_nil_rated,
        ]);
    }
}
