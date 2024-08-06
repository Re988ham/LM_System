<?php

namespace App\Services\Application\Sidebar;

use App\Models\Book;
use App\Models\Country;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Mylibrary;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class SidebarService{
    public function getmycourses()
    {
        $userId = Auth::user()->id;

        // Retrieve enrolled courses
        $enrollmentCourses = Enrollment::where('user_id', $userId)->get();
        $courseIds = $enrollmentCourses->pluck('course_id');
        $courses = Course::whereIn('id', $courseIds)->get();

        // Iterate over the courses and add the additional information
        foreach ($courses as $course) {
            $country = Country::find($course->country_id);
            $specialization = Specialization::find($course->specialization_id);
            $author = User::find($course->user_id);

            $course['country_name'] = $country ? $country->name : 'Unknown Country';
            $course['specialization_name'] = $specialization ? $specialization->name : 'Unknown Specialization';
            $course['author_name'] = $author ? $author->name : 'Unknown Author';
        }

        return $courses;
    }


    public function unjoin($course_id){

        $userid = Auth::user()->id;
        $Enrollmentcourse=Enrollment::where('user_id',$userid)
            ->where('course_id',$course_id)->delete();

        return ['deleted course :' => $Enrollmentcourse ,
            'course unjoin successfully'];

    }
    public function getlibrarycontent()
    {
        $Books = Book::all();
        foreach ($Books as $Book) {
        $specialization = Specialization::find($Book->specialization_id);
        $Book['specialization_name'] = $specialization ? $specialization->name : 'Unknown Specialization';
        return $Books;
        }
    }

    public function getMyXp(): array
    {
        $userId = Auth::user()->id;
        $myWallet = Wallet::where('user_id', $userId)->first();

        if ($myWallet) {
            $xp = $myWallet->xp;
            return ['Your xp is :' => $xp];
        } else {
            return ['Your xp is :' => 0]; // or handle it as per your logic
        }
    }


    public function updateMyXp($xp)
    {
        $userId = Auth::id();
        $userWallet = Wallet::firstOrCreate(
            ['user_id' => $userId],
            ['xp' => 0]
        );

        $userWallet->increment('xp', $xp);

        return [
            'Added to your xp' => $xp,
            'Your current xp is' => $userWallet->xp
        ];
    }

    public function getmylibrary()
    {
        $userid = Auth::user()->id;
        $Mylibrary = Mylibrary::where('user_id', $userid)->get();
        $bookIds = $Mylibrary->pluck('book_id');
        $Books = Book::whereIn('id', $bookIds)->get();
        foreach ($Books as $Book) {
            $specialization = Specialization::find($Book->specialization_id);
            $Book['specialization_name'] = $specialization ? $specialization->name : 'Unknown Specialization';
            return $Books;
        }
        return $Books;
    }


    public function payFromLibrary($book_id)
    {
        try {
            $userId = Auth::user()->id;
            $inMyLibrary = Mylibrary::where('user_id', $userId)
                ->where('book_id', $book_id)
                ->exists();

            if ($inMyLibrary) {
                return response()->json(['message' => 'You already have this book in your library'], 400);
            }

            $userWallet = Wallet::where('user_id', $userId)->first();
            if (!$userWallet) {
                return response()->json(['error' => 'User wallet not found'], 404);
            }

            $bookXp = Book::where('id', $book_id)->value('xp');
            if (is_null($bookXp)) {
                return response()->json(['error' => 'Book not found'], 404);
            }

            if ($userWallet->xp < $bookXp) {
                return response()->json(['message' => 'You do not have enough XP to pay for this book'], 400);
            }

            $userWallet->decrement('xp', $bookXp);

            $libraryEntry = Mylibrary::create([
                'book_id' => $book_id,
                'user_id' => $userId,
            ]);

            return response()->json([
                'my_library' => $libraryEntry,
                'message' => 'Book paid successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function refundFromMyLibrary($book_id)
    {
        try {
            $userId = Auth::user()->id;
            $bookRecord = Mylibrary::where('book_id', $book_id)->first();
            if (!$bookRecord) {
                return ['error' => 'Book not found in user library'];
            }

            $userWallet = Wallet::where('user_id', $userId)->first();
            if (!$userWallet) {
                return ['error' => 'User wallet not found'];
            }

            $book = Book::find($book_id);
            if (!$book) {
                return ['error' => 'Book not found'];
            }

            $newXp = $userWallet->xp + $book->xp;
            $bookRecord->delete();
            $userWallet->xp = $newXp;
            $userWallet->save();

            return [
                'deleted book_id of my_library' => $book_id,
                'current_balance' => $newXp,
                'message' => 'Book refunded successfully'
            ];

        } catch (\Exception $e) {
            return ['error' => 'Something went wrong: ' . $e->getMessage()];
        }
    }


}
