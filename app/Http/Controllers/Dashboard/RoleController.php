<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\ReportCreateRequest;
use App\Http\Requests\Dashboard\Role\ReportUpdateRequest;
use App\Services\Dashboard\RoleService;
use Exception;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleService->list();
        return view('dashboard.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportCreateRequest $request)
    {
        try {
            $role = $this->roleService->store($request->validated());
            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->roleService->findById($id);
        return view('dashboard.pages.roles.update', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportUpdateRequest $request)
    {
        try {
            $role = $this->roleService->update($request->validated());
            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
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
            $this->roleService->destroy($id);
            return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.roles.index')->with('error', $e->getMessage());
        }
    }
}
