<?php

namespace App\Http\Controllers;

use App\Models\FormData;
use App\Models\Image;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function storeData(Request $request){

       try{    
        $formData = new FormData();
        $formData->issue = $request->input('issue');
        $formData->description = $request->input('description');
        $formData->priority = $request->input('priority');
        $formData->department = $request->input('department');
        $formData->issuedby = $request->input('issuedby');

        $formData->save();

        if($request->hasFile('images')){
            foreach($request->file('images') as $key=>$image){
                $imageName = $image->store('images','public');

                $newImage = new Image();

                $newImage->image_name = $imageName;
                $newImage->description = $request->input('descriptions')[$key]??'';
                $newImage->form_data_id = $formData->id;
                $newImage->save();
            }
        }
        

        //return response()->json(['message' => 'Form data stored successfully']);
        return redirect()->back()->with('success', 'Reported Sucessfully');

        }catch(\Exception $e){
            return response()->json(['error'=>'An Error occured while processing data'], 500);
        }
    }

    public function showData(){

        $data = FormData::with(['comments', 'images'])->paginate(10);

        return view('dashboard', compact('data'));
    }

    /*
    public function search(Request $request){
        $searchText = $request->input('searchText');

        $filteredData = FormData::where('description', 'LIKE', '%'.$searchText.'%')->get();

        return response()->json($filteredData);
    }
    */

}
