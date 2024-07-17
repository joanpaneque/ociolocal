<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(User $user)
    {
        if (auth()->user()->id !== $user->id) {
            abort(403, 'You are not authorized to view this page.');
        }

        return Inertia::render('Companies/Index', [
            'companies' => auth()->user()->companies()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Companies/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        if (auth()->user()->id !== $user->id) {
            abort(403, 'You are not authorized to view this page.');
        }

        $error = [];

        // VALIDATIONS

        //
        // company_name
        //
        $company = $user->companies()->where('company_name', strtolower(trim($request->company_name)))->first();
        if ($company) {
            $error['company_name'] = "El nombre de la empresa {$request->company_name} ya existe";
        }

        //
        // company_email
        //
        if (!filter_var($request->company_email, FILTER_VALIDATE_EMAIL)) {
            $error['company_email'] = "El email {$request->company_email} no es válido";
        }

        //
        // company_phone
        //
        if (!preg_match('/^[0-9]{9}$/', $request->company_phone)) {
            $error['company_phone'] = "El teléfono {$request->company_phone} no es válido";
        }

        //
        // company_nif
        //
        // No validation needed

        //
        // legal_representative_email
        //
        if (!filter_var($request->legal_representative_email, FILTER_VALIDATE_EMAIL)) {
            $error['legal_representative_email'] = "El email {$request->legal_representative_email} no es válido";
        }

        //
        // legal_representative_phone
        //
        if (!preg_match('/^[0-9]{9}$/', $request->legal_representative_phone)) {
            $error['legal_representative_phone'] = "El teléfono {$request->legal_representative_phone} no es válido";
        }

        //
        // iban
        //
        if (!$this->validateIBAN($request->iban)) {
            $error['iban'] = "El IBAN {$request->iban} no es válido";
        }

        if (count($error) > 0) {
            return back()->withErrors($error);
        }

        // move the image to the public folder with a unique hash
        $image = $request->file('image');
        $hash = md5($image->getClientOriginalName() . time());
        $image->move(public_path('images'), $hash);
        $imagePath = "/images/{$hash}";

        // Create the company
        $user->companies()->create([
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
            'company_nif' => $request->company_nif,
            'legal_representative_name' => $request->legal_representative_name,
            'legal_representative_email' => $request->legal_representative_email,
            'legal_representative_phone' => $request->legal_representative_phone,
            'iban' => $request->iban,
            'image' => $imagePath
        ]);

        return redirect()->route('users.companies.index', $user->id);
    }

    private function validateIBAN($iban)
    {
        // Remove spaces and convert to uppercase
        $iban = strtoupper(str_replace(' ', '', $iban));

        // Check the general length and country-specific lengths
        $ibanLengths = [
            'AL' => 28, 'AD' => 24, 'AT' => 20, 'AZ' => 28, 'BH' => 22, 'BE' => 16,
            'BA' => 20, 'BR' => 29, 'BG' => 22, 'CR' => 22, 'HR' => 21, 'CY' => 28,
            'CZ' => 24, 'DK' => 18, 'DO' => 28, 'EE' => 20, 'FO' => 18, 'FI' => 18,
            'FR' => 27, 'GE' => 22, 'DE' => 22, 'GI' => 23, 'GR' => 27, 'GL' => 18,
            'GT' => 28, 'HU' => 28, 'IS' => 26, 'IE' => 22, 'IL' => 23, 'IT' => 27,
            'JO' => 30, 'KZ' => 20, 'KW' => 30, 'LV' => 21, 'LB' => 28, 'LI' => 21,
            'LT' => 20, 'LU' => 20, 'MT' => 31, 'MR' => 27, 'MU' => 30, 'MC' => 27,
            'MD' => 24, 'ME' => 22, 'NL' => 18, 'MK' => 19, 'NO' => 15, 'PK' => 24,
            'PS' => 29, 'PL' => 28, 'PT' => 25, 'QA' => 29, 'RO' => 24, 'SM' => 27,
            'SA' => 24, 'RS' => 22, 'SK' => 24, 'SI' => 19, 'ES' => 24, 'SE' => 24,
            'CH' => 21, 'TN' => 24, 'TR' => 26, 'AE' => 23, 'GB' => 22, 'VG' => 24
        ];

        $countryCode = substr($iban, 0, 2);

        // Check if the country code exists in the list and if the length matches
        if (!isset($ibanLengths[$countryCode]) || strlen($iban) != $ibanLengths[$countryCode]) {
            return false;
        }

        // Move the first four characters to the end of the string
        $ibanRearranged = substr($iban, 4) . substr($iban, 0, 4);

        // Replace each letter in the string with two digits
        $ibanNumeric = '';
        foreach (str_split($ibanRearranged) as $char) {
            if (ctype_alpha($char)) {
                $ibanNumeric .= ord($char) - 55; // Convert letter to number (A=10, B=11, ..., Z=35)
            } else {
                $ibanNumeric .= $char;
            }
        }

        // Perform the modulo operation
        $checkSum = intval(substr($ibanNumeric, 0, 1));
        for ($i = 1; $i < strlen($ibanNumeric); $i++) {
            $checkSum = ($checkSum * 10 + intval($ibanNumeric[$i])) % 97;
        }

        return $checkSum == 1;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Company $company)
    {

        if (auth()->user()->id !== $user->id) {
            abort(403, 'You are not authorized to view this page.');
        }

        return Inertia::render('Companies/Show', [
            'company' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}