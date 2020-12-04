<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::all();
        $movies = Movie::all();

        if(Auth::user()->role == 'admin')
        {
            return view('loans.index', compact('loans', 'movies'));
        }
        else
            return redirect('/myLoans');        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myloans()
    {
        $id = Auth::id();
        $movies = Movie::all(); 
        $myloans = Loan::where('user_id','=',$id)->get();

        return view('loans.myloans', compact('myloans', 'movies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loan = Loan::create($request->all());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function return($id)
    {
        $loan = Loan::find($id);

        $loan->status = 'inactive';

        $loan->save();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function get(Loan $loan)
    {
        if($loan) {
            return response()->json([
                'message' => 'Consulta exitosa',
                'code' => '200',
                'data' => $loan
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
        $loan = Loan::find($request->id);

        if($loan)
        {
            if($loan->update($reloan->all()))
            {
                return redirect()->back();
            }
        }

        return redirect()->back();
    }
}
