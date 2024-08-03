<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UserCreateRequest;
use App\Http\Requests\Dashboard\User\UserUpdateRequest;
use App\Services\Dashboard\CountryService;
use App\Services\Dashboard\UserService;
use Exception;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private UserService $userService;
    private CountryService $countryService;

    public function __construct(UserService $userService, CountryService $countryService)
    {
        $this->userService = $userService;
        $this->countryService = $countryService;
    }

    public function index()
    {
        $users = $this->userService->list();
        return view('dashboard.pages.users.index', compact('users'));
    }

    public function store(UserCreateRequest $request)
    {
        try {
            $user = $this->userService->create($request->validated());
            return redirect()->route('admin.users.index')->with('success', 'User created successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function create()
    {
        $countries = $this->countryService->list()->pluck('name', 'id');
        $roles = Role::where('name', '!=', 'super-admin')->pluck('name', 'id');
        return view('dashboard.pages.users.create', compact('countries', 'roles'));
    }

    public function edit(string $id)
    {
        $user = $this->userService->findById($id);
        $countries = $this->countryService->list()->pluck('name', 'id');
        $roles = Role::where('name', '!=', 'super-admin')->pluck('name', 'id');
        return view('dashboard.pages.users.update', compact(
            'user', 'countries', 'roles'
        ));
    }

    public function update(UserUpdateRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->userService->update($validatedData['id'], $validatedData);
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->userService->destroy($id);
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.users.index')->with('error', $e->getMessage());
        }
    }


}
