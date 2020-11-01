<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $category = $request->category;

        $query = Restaurant::query();
        if($name){
            $query->where('name', 'like', '%' . $name . '%');
        }
        if($category){
                $query->whereHas('Category', function($q) use ($category){
                    $q->Where('name', 'like', '%' . $category . '%');
            });
        }
        $restaurants = $query->paginate(5);
        $restaurants->appends(compact('name', 'category'));
        // // $restaurants = Restaurant::simplepaginate(10);
        // if(!empty($name)){
        //     $restaurants = Restaurant::where('name', 'like', '%' . $name . '%');
        // } else {
        //     $restaurants = Restaurant::all();
        // }



        // $restaurants = Restaurant::all();
        // $restaurants = $restaurants->sortByDesc('reccomended');
        // $restaurants = DB::table('restaurants')->orderByRaw('reccomended IS NULL ASC')->orderBy('reccomended', 'ASC')->get();
        return view('restaurants.index', compact('restaurants'));
    }

    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurants.show', compact('restaurant'));
    }
}
