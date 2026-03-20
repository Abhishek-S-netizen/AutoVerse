<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\CommunityPosts;
use App\Models\CommunityReply;

class CommunityController extends Controller
{
    public function show($slug) {
        $user = Auth::user();
        $car = Car::where("slug",$slug)->firstOrFail();

        $hasAccess = $user->rentals()->where("status","completed")->where("car_id",$car->id)->exists();
        
        if (!$hasAccess) {
            abort(403);
        }

        $posts = $car->communityPosts()->with(["user", "replies.user"])->paginate(6);
        return view("community_page", compact("car", "posts"));
    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:community_posts,id',
            'reply' => 'required'
        ]);

        CommunityReply::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'reply' => $request->reply,
        ]);

        return back();
    }

    public function storePost(Request $request) {
        $request->validate([
            'post_title' => 'required|max:255',
            'post_content' => 'required',
        ]);

        CommunityPosts::create([
            'user_id' => auth()->id(),
            'car_id' => $request->car_id,
            'post_title' => $request->post_title,
            'post' => $request->post_content,
        ]);

        return back()->with('success', 'Post created successfully!');
    }

    public function showAdminCarCommunity($slug) {
        $car = Car::where("slug",$slug)->firstOrFail();
        $posts = $car->communityPosts()->with(["user","replies.user"])->paginate(6);
        return view("admin_car_community", compact("car","posts"));
    }

    public function deleteAdminPost(Request $request) {
        $request->validate([
            "post_id" => "required|exists:community_posts,id"
        ]);

        $postID = $request->post_id;

        $post = CommunityPosts::where("id",$postID)->firstOrFail();
        $post->delete();
        return redirect()->back()->with("success","Post deleted successfully");
    }

    public function deleteAdminReply(Request $request) {
        $request->validate([
            "reply_id" => "required|exists:community_replies,id"
        ]);

        $replyID = $request->reply_id;
        $reply = CommunityReply::where("id",$replyID)->firstOrFail();
        $reply->delete();

        return redirect()->back()->with("success","Reply deleted successfully");
    }
}
