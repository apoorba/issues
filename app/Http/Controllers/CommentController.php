<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\FormData;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function showComments(FormData $formData){
        
        $dataWithComments = FormData::with(['comments', 'images'])->find($formData->id);
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

    public function acceptIssue(Request $request){
        $accept = FormData::findOrFail($request->input('form_data_id'));

        $accept->status = 'Accepted';
        $accept->updated_by = auth()->user()->name;
        $accept->save();

        return redirect()->back()->with('success', 'Issue has been accepted successfully');
        
    }

    public function solveIssue(Request $request){
        $solve = FormData::findOrFail($request->input('form_data_id'));
        $solve->status = 'Solved';
        $solve->updated_by = auth()->user()->name;
        $solve->save();

        return redirect()->back()->with('success', 'Issue has been solved successfully');
    }
}
