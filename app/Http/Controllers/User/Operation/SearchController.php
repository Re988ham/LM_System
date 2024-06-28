<?php

namespace App\Http\Controllers\User\Operation;

use App\Http\Controllers\Controller;
use App\Requests\Operations\SearchValidation;
use App\Services\GeneralServices\ResponseService;
use App\Services\GeneralServices\SearchService;

class SearchController extends Controller
{
    public SearchService $searchService;
    public ResponseService $responseService;

    public function __construct(SearchService $searchService, ResponseService $responseService)
    {
        $this->searchService = $searchService;
        $this->responseService = $responseService;
    }

    public function search(SearchValidation $request): \Illuminate\Http\JsonResponse
    {
        $query = request()->input('query');

        // Use the service to search courses by name
        $results = $this->searchService->searchCourses($query);

        // Save the search term in the database
        $this->searchService->saveSearch($query);

        // Get the last 5 searches from the cache
        $lastSearches = $this->searchService->getLastSearches();

        // Return the results along with the last searches
        return response()->json([
            'success' => true,
            'results' => $results,
            'last_searches' => $lastSearches,
        ]);
    }


//    public function getData()
//    {
//        $cachedData = Cache::get('cached_data');
//
//        if ($cachedData) {
//            return response()->json($cachedData);
//        }
//
//        $data = Search::all();
//
//        Cache::put('cached_data', $data, 60); // Cache the data for 60 minutes
//
//        return response()->json($data);
//    }

}
