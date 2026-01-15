<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120'],
            'phone' => ['required','string','max:40'],
            'email' => ['required','email','max:190'],

            'housing_type' => ['nullable','string','max:60'],
            'lat' => ['nullable','numeric'],
            'lng' => ['nullable','numeric'],
            'area_m2' => ['nullable','integer','min:0'],
            'geojson' => ['nullable','string'],
            'bill_monthly' => ['nullable','string','max:20'],
        ]);

        $data['ip'] = $request->ip();
        $data['user_agent'] = substr((string) $request->userAgent(), 0, 255);

        Lead::create($data);

        return response()->json(['ok' => true], 201);
    }
}
