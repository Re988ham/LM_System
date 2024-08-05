<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Type\TypeCreateRequest;
use App\Http\Requests\Dashboard\Type\TypeUpdateRequest;
use App\Services\Dashboard\TypeService;
use Exception;

class TypeController extends Controller
{
    /**
     * @var TypeService
     */
    private $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->typeService = $typeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = $this->typeService->list();
        return view('dashboard.pages.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeCreateRequest $request)
    {
        try {
            $type = $this->typeService->store($request->validated());
            return redirect()->route('admin.types.index')->with('success', 'Type created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.types.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = $this->typeService->findById($id);
        return view('dashboard.pages.types.update', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeUpdateRequest $request)
    {
        try {
            $type = $this->typeService->update($request->validated());
            return redirect()->route('admin.types.index')->with('success', 'Type created successfully.');
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
            $this->typeService->destroy($id);
            return redirect()->route('admin.types.index')->with('success', 'Type deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.types.index')->with('error', $e->getMessage());
        }
    }
}
