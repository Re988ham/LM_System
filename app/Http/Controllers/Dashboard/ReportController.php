<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Report\ReportCreateRequest;
use App\Http\Requests\Dashboard\Report\ReportUpdateRequest;
use App\Services\Dashboard\ReportService;
use Exception;

class ReportController extends Controller
{
    /**
     * @var ReportService
     */
    private $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = $this->reportService->list();
        return view('dashboard.pages.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportCreateRequest $request)
    {
        try {
            $report = $this->reportService->store($request->validated());
            return redirect()->route('admin.reports.index')->with('success', 'Report created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.reports.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $report = $this->reportService->findById($id);
        return view('dashboard.pages.reports.update', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportUpdateRequest $request)
    {
        try {
            $report = $this->reportService->update($request->validated());
            return redirect()->route('admin.reports.index')->with('success', 'Report created successfully.');
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
            $this->reportService->destroy($id);
            return redirect()->route('admin.reports.index')->with('success', 'Report deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.reports.index')->with('error', $e->getMessage());
        }
    }
}
