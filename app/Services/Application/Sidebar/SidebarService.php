<?php

namespace App\Services\Application\Sidebar;

use App\Models\Book;
use App\Models\Enrollment;
use App\Models\Mylibrary;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class SidebarService{
    public function getmycourses(){

        $userid = Auth::user()->id;
        $courses=Enrollment::where('user_id',$userid)->get();

        return $courses;
    }

    public function getlibrarycontent()
    {
        return Book::all() ;
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

    public function getmylibrary(){

        $userid = Auth::user()->id;
        $Mylibrary=Mylibrary::where('user_id',$userid);

        return $Mylibrary;
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

            $newXp = $userWallet->xp + $bookRecord->xp;
            $deleted = Mylibrary::where('book_id', $book_id)->delete();
            $userWallet->update(['xp' => $newXp]);

            return [
                'my_library' => $deleted,
                'current_balance' => $newXp,
                'message' => 'Book refunded successfully'
            ];

        } catch (\Exception $e) {
            return ['error' => 'Something went wrong: ' . $e->getMessage()];
        }
    }

}
