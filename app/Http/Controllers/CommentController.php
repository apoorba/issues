<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\FormData;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function showComments(FormData $formData){
        $dataWithComments = FormData::with('comments')->find($formData->id);
        return view('comment', compact('dataWithComments'));
    }

    public function storeComment(Request $request){
        $newComment = new Comment();
        $newComment->form_data_id = $request->input('form_data_id');
        $newComment->user_id = auth()->user()->id;
        $newComment->content = $request->input('comment');
        $newComment->save();

        return redirect()->back()->with('success', 'Comment added sucessfully');

    }
}
