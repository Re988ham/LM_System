<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Advertisement\AdvertisementCreateRequest;
use App\Http\Requests\Dashboard\Advertisement\AdvertisementUpdateRequest;
use App\Services\Dashboard\AdsService;
use App\Services\Dashboard\SpecializationService;
use Exception;

class AdsController extends Controller
{
    private $adsService;
    private $specializationService;

    public function __construct(AdsService $adsService, SpecializationService $specializationService)
    {
        $this->adsService = $adsService;
        $this->specializationService = $specializationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = $this->adsService->list();
        return view('dashboard.pages.advertisements.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->specializationService->getAllSpecializationsChoices();
        return view('dashboard.pages.advertisements.create', compact('specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdvertisementCreateRequest $request)
    {
        try {
            $ad = $this->adsService->store($request->validated());
            return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.advertisements.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ad = $this->adsService->findById($id);
        $specializations = $this->specializationService->getAllSpecializationsChoices();
        return view('dashboard.pages.advertisements.update', compact(
            'ad',
            'specializations'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvertisementUpdateRequest $request)
    {
        try {
            $ad = $this->adsService->update($request->validated());
            return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement created successfully.');
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
            $this->adsService->destroy($id);
            return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.advertisements.index')->with('error', $e->getMessage());
        }
    }
}
