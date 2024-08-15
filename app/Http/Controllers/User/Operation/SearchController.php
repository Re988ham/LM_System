<?php

namespace App\Http\Controllers\User\Operation;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Course;
use App\Models\Specialization;
use App\Models\User;
use App\Requests\Operations\SearchValidation;
use App\Services\GeneralServices\ImageComparisonService;
use App\Services\GeneralServices\ImageService;
use App\Services\GeneralServices\ResponseService;
use App\Services\GeneralServices\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use SapientPro\ImageComparator\ImageComparator;

class SearchController extends Controller
{
    public SearchService $searchService;
    public ResponseService $responseService;
    public ImageComparisonService $comparisonService;

    public function __construct(SearchService $searchService, ImageComparisonService $comparisonService, ResponseService $responseService)
    {
        $this->searchService = $searchService;
        $this->responseService = $responseService;
        $this->comparisonService = $comparisonService;
    }

    public function search(SearchValidation $request, $spec_id = null, $country_id = null): \Illuminate\Http\JsonResponse
    {
        $query = $request->input('query');

        $results = $this->searchService->searchCourses($query, $spec_id, $country_id);

        $this->searchService->saveSearch($query);

        $lastSearches = $this->searchService->getLastSearches();

        return response()->json([
            'success' => true,
            'results' => $results,
            'last_searches' => $lastSearches,
        ]);
    }





    public function getcoursesbyimage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return [];
        }

        $destinationPath = '/images/search/';
        $imagePath = ImageService::saveImage($request->file('image'), $destinationPath);
        $imagefinalpath = public_path($imagePath);

        $cacheKey = 'image_comparison_' . md5_file($imagefinalpath);
        $similarImages = Cache::get($cacheKey);

        if ($similarImages) {
            if (file_exists($imagefinalpath)) {
                unlink($imagefinalpath);
            }
            return $similarImages;
        }

        $imageComparator = new ImageComparator();
        $imagesDirectory = public_path('images/courses');
        $images = array_diff(scandir($imagesDirectory), ['.', '..']);

        $similarImages = [];

        foreach ($images as $image) {
            $currentImageFullPath = $imagesDirectory . '/' . $image;

            if ($currentImageFullPath === $imagefinalpath) {
                continue;
            }

            if (file_exists($currentImageFullPath)) {
                $similarity = $imageComparator->compare($imagefinalpath, $currentImageFullPath);

                if ($similarity > 80) {
                    $similarImageRelativePath = '/images/courses/' . $image;

                    $foundCourses = Course::where('image', 'like', '%' . $similarImageRelativePath . '%')
                        ->where('status', 'accepted')
                        ->chunk(10, function($chunk) use(&$courses){

                            foreach($chunk as $course){
                                $countryid =$course->country_id;
                                $specializeid=$course->specialization_id;
                                $autherid=$course->user_id;
                                $country =Country::find($countryid);
                                $specialization=Specialization::find($specializeid);
                                $author=User::find($autherid);
                                $course['country_id']= $country ? $country->name : 'Unknown Country';
                                $course['specialization_id']= $specialization ? $specialization->name : 'Unknown Specialization';
                                $course['user_id']= $author ? $author->name : 'Unknown Author';



                                $courses[] = $course;

                            }
                        });
                }
            }
        }

        Cache::put($cacheKey, $courses, now()->addMinutes(10));

        if (file_exists($imagefinalpath)) {
            unlink($imagefinalpath);
        }

        return $courses;
    }
}
