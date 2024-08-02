<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Country\CountryCreateRequest;
use App\Http\Requests\Dashboard\Country\CountryUpdateRequest;
use App\Services\Dashboard\CountryService;
use Exception;

class CountryController extends Controller
{
    /**
     * @var CountryService
     */
    private $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = $this->countryService->list();
        return view('dashboard.pages.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryCreateRequest $request)
    {
        try {
            $country = $this->countryService->store($request->validated());
            return redirect()->route('admin.countries.index')->with('success', 'Country created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.countries.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = $this->countryService->findById($id);
        return view('dashboard.pages.countries.update', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryUpdateRequest $request)
    {
        try {
            $country = $this->countryService->update($request->validated());
            return redirect()->route('admin.countries.index')->with('success', 'Country created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->countryService->destroy($id);
            return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.countries.index')->with('error', $e->getMessage());
        }
    }
}
