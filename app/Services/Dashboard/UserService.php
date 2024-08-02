<?php

namespace App\Services\Dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageService;


class UserService
{

    public function list(): Collection
    {
        // for not show auth user in users table
        $authenticatedUserId = Auth::id();
        $otherUsers = User::where('id', '!=', $authenticatedUserId)->get();
        return $otherUsers;
    }

    public function create(array $data): User
    {
        if (isset($data['image'])) {
            $destinationPath = public_path('images/users/');
            $data['image'] = ImageService::saveImage($data['image'], $destinationPath);
        }
        return User::create($data);
    }

    public function update($id, array $data): User
    {
        $user = $this->findById($id);
        $imagePath = public_path('images/users/') . $user->image;
        $deleted = ImageService::deleteImage($imagePath);
        if (isset($data['image'])) {
            $destinationPath = public_path('images/users/');
            $data['image'] = ImageService::saveImage($data['image'], $destinationPath);
        }
        $user->update($data);
        return $user->fresh();
    }


    public function findById($id): User
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function destroy($id)
    {
        $user = $this->findById($id);
        $user->delete();
    }
}
