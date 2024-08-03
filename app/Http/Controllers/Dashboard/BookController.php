<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Book\BookCreateRequest;
use App\Http\Requests\Dashboard\Book\BookUpdateRequest;
use App\Services\Dashboard\BookService;
use App\Services\Dashboard\SpecializationService;
use Exception;

class BookController extends Controller
{
    private $bookService;
    private $specializationService;

    public function __construct(BookService $bookService, SpecializationService $specializationService)
    {
        $this->bookService = $bookService;
        $this->specializationService = $specializationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->bookService->list();
        return view('dashboard.pages.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->specializationService->getAllSpecializationsChoices();
        return view('dashboard.pages.books.create', compact('specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookCreateRequest $request)
    {
        try {
            $book = $this->bookService->store($request->validated());
            return redirect()->route('admin.books.index')->with('success', 'Quiz created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.books.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = $this->bookService->findById($id);
        return view('dashboard.pages.books.update', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request)
    {
        try {
            $book = $this->bookService->update($request->validated());
            return redirect()->route('admin.books.index')->with('success', 'Quiz created successfully.');
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
            $this->bookService->destroy($id);
            return redirect()->route('admin.books.index')->with('success', 'Quiz deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.books.index')->with('error', $e->getMessage());
        }
    }
}
