<?php

namespace App\Services\Application\BlogWedget;

use App\Models\Comment;
use App\Models\Country;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Services\GeneralServices\ImageService;
use App\Services\GeneralServices\NotificationService;
use App\Traits\FCMNotification;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;

class BlogService{

    use FCMNotification;

    /**
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function createpost($data)
    {

       $destinationPath ='/images/posts/';
       $userid = Auth::user()->id;

        if (isset($data['image_url'])) {
            $data['image_url'] = ImageService::saveImage($data['image_url'],$destinationPath );
        }
        $data['user_id']=$userid;
        $user_name = User::find($userid);
        $notificationService = new NotificationService();
        $notificationService->send('EDUspark', "{$user_name->name} added a new post");
//        $this->dispatchNotification('EDUspark', "{$user_name->name} Added a new post");

        $post = Post::create($data);

        return $post;
    }

    public function createcomment($data)
    {
        $userid = Auth::user()->id;

        $data['user_id']=$userid;
        $comment = Comment::create($data);
        return $comment;
    }

    public function createlike($data)
    {
        $userid = Auth::user()->id;

        $data['user_id']=$userid;
        $like = Like::create($data);
        return $like;
    }
    public function getposts()
    {
        $posts= Post::all();
        foreach ($posts as $post) {
            $user = User::find($post->user_id);
            $country = Country::find($user->country_id);
            $post['auther name'] = $user->name;
            $post['auther country'] = $country->name;
            $post['auther image'] = $user->image;
        }
        return $posts;
    }
    public function getcomments($post_id)
    {

        $comments=Comment::where('post_id',$post_id)
        ->get();
        foreach ($comments as $comment) {
            $user = User::find($comment->user_id);
            $comment['auther name'] = $user->name;
            $comment['auther image'] = $user->image;
        }        return $comments;
    }
}
