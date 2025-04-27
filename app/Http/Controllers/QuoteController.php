<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\SolarContract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;

class QuoteController extends Controller
{
    // Show quote form
    public function create($contractId)
    {
        $contract = SolarContract::findOrFail($contractId);
        return view('solar.quotes.create', compact('contract'));
    }

    // Store new quote
    public function store(Request $request, $contractId)
    {
        $request->validate([
            'type' => 'required|in:initial,final',
            'amount' => 'required|numeric',
            
        ]);
        $details = $request->input('details');
        $contract = SolarContract::findOrFail($contractId);
        if (is_array($details)) {
            $details = collect($details)
                ->map(fn($val, $key) => ucfirst($key) . ': ' . $val)
                ->implode("\n");
        }
        // Create quote
        $quote = new Quote([
            'contract_id' => $contract->_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'details' => $details,
            'created_by' => auth()->id(),
        ]);

        $quote->save();

        // PDF generation
        $pdfName = 'quote_' . $quote->_id . '.pdf';
        $pdf = PDF::loadView('solar.quotes.pdf', compact('quote', 'contract'));
        Storage::disk('public')->put("quotes/{$pdfName}", $pdf->output());
        $quote->pdf_path = "quotes/{$pdfName}";

        // Word generation
        $docxName = 'quote_' . $quote->_id . '.docx';
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText("Quote for {$contract->customer_name}");
        $section->addText("Type: {$quote->type}");
        $section->addText("Amount: ₹{$quote->amount}");
        $section->addText("Details: {$quote->details}");
        $docxPath = storage_path("app/public/quotes/{$docxName}");
        $phpWord->save($docxPath, 'Word2007');
        $quote->docx_path = "quotes/{$docxName}";

        $quote->save();

        return redirect()->route('solar_contracts.show', $contractId)->with('success', 'Quote generated successfully.');
    }

    // Optional: View/download quote
    public function show($id)
    {
        $quote = Quote::findOrFail($id);
        $contract = SolarContract::findOrFail($quote->contract_id);

        return view('quotes.show', compact('quote', 'contract'));
    }
    public function indexGrouped()
    {
        $quotes = \App\Models\Quote::all()->groupBy('contract_id');

        // Optional: Load related contract for customer name
        $contracts = \App\Models\SolarContract::whereIn('_id', $quotes->keys())->get()->keyBy('_id');

        return view('solar.quotes.grouped_index', compact('quotes', 'contracts'));
    }

}
