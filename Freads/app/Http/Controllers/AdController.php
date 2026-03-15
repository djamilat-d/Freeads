<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function index(){
        $ads= Ad::all();

        return view('ads.acceuil', compact('ads'));
    }

    public function create(){
        return view('ads.create');
    }

    public function store(Request $request){
        $request->validate(['image'=>'required|image|mimes:jpeg,png,jpg|max:2048',]);
        $data = $request->all();
        $data['user_id']= Auth::id();
        //$data['image'] = "photo.jpeg";
        if($request->hasFile('image')){
            $n_image=time().'.'.$request->image->extension(); 
            $request->image->move(public_path('images'),$n_image);
            $data['image'] = 'images/' . $n_image;
        }
        Ad::create($data);
        return redirect()->route('acceuil');
    }

    public function edit($id){
        $ad= Ad::findOrFail($id);
        if($ad->user_id !== auth()->id()){
            return redirect()->route('acceuil')->with('error','Ce n\'est pas votre annonce donc impossible de la modifier');
        }
        return view('ads.edit',compact('ad'));
    }

    public function update(Request $request,$id){
       $ad= Ad::findOrFail($id);
       $data =$request->all();

       if($request->hasFile('image')){
        $n_image=time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$n_image);
        $data['image'] = 'images/' . $n_image;
       }
       $ad->update($data);
       return redirect()->route('acceuil');
    }

    public function destroy($id){
        $ad= Ad::findOrFail($id);

        if($ad->user_id === auth()->id()){
            $ad->delete();
        }
        return redirect()->route('acceuil');
    }
}
