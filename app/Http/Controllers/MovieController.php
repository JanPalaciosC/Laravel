<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::with('category')->get();
        $categories = Category::all();
        $id = Auth::id(); 
        $myloans = Loan::where('user_id','=',$id)->get();
        if(Auth::user()->role == 'admin')
        {
            return view('movies.index', compact('movies', 'categories'));
        }
        else{
            return view('movies.clientMovies', compact('movies', 'categories','myloans'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $categories = Category::all();
        $movies = Movie::with('category')->get();
        $users = User::all();
        $loans = Loan::all();


        return view('dashboard', compact('categories', 'movies', 'users','loans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = Movie::create($request->all());
        
        if ($request->hasFile('cover_file')) 
        {
            $file = $request->file('cover_file');
            $file_name = 'cover_movie'.$movie->id.'.'.$file->getClientOriginalExtension();
            $path = $request->file('cover_file')->storeAs(
                'img', $file_name
            );

            $movie->cover= $file_name;
            $movie->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function get(Movie $movie)
    {
        if($movie) {
            return response()->json([
                'message' => 'Consulta exitosa',
                'code' => '200',
                'data' => $movie
            ]);
        }

        return response()->json([
            'message' => 'No se pudo eliminar el registro',
            'code' => '400',
            'data' => array()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $movie = Movie::find($request->id);

        if($movie)
        {
            if($movie->update($request->all()))
            {
                return redirect()->back();
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if ($movie) {
           if ($movie->delete()) {
               return response()->json([
                    'message' => 'Registro eliminado correctamente',
                    'code' => '200',
                ]);
           }
        }
        return response()->json([
            'message' => 'No se pudo eliminar el registro',
            'code' => '400',
        ]);
    }
}
