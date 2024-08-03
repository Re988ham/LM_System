<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Specialization\SpecializationCreateRequest;
use App\Http\Requests\Dashboard\Specialization\SpecializationUpdateRequest;
use App\Services\Dashboard\SpecializationService;
use Exception;
use Illuminate\Validation\ValidationException;

class SpecializationController extends Controller
{
    /**
     * @var SpecializationService
     */
    private $specializationService;

    public function __construct(SpecializationService $specializationService)
    {
        $this->specializationService = $specializationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specializations = $this->specializationService->list();
        return view('dashboard.pages.specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.specializations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecializationCreateRequest $request)
    {
        try {
            $specialization = $this->specializationService->store($request->all());
            return redirect()->route('admin.specializations.index')->with('success', 'Specialization created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $specialization = $this->specializationService->findById($id);
        return view('dashboard.pages.specializations.show', compact('specialization'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $specialization = $this->specializationService->findById($id);
        return view('dashboard.pages.specializations.update', compact('specialization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpecializationUpdateRequest $request)
    {
        try {
            $specialization = $this->specializationService->update($request->all());
            return redirect()->route('admin.specializations.index')->with('success', 'Specialization created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->specializationService->destroy($id);
            return redirect()->route('admin.specializations.index')->with('success', 'Specialization deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.specializations.index')->with('error', $e->getMessage());
        }
    }
}
