<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dictation;
use App\Models\Place;
use App\Models\Course;
use App\Models\Dictation_User;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class DictationController extends Controller

{

    public function index()
    {
        $dictations = Dictation::published()->get();
        return view('admin.dictations.index', compact('dictations'));

    }

    public function create()
    {
        $courses = Course::pluck('name', 'id');
        $places = Place::pluck('city', 'id');

        $dictations = Dictation::all();

        return view ('admin.dictations.create', compact(
                                                            'dictations',
                                                            'places',
                                                            'courses',
                                                        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'stock' => 'required',
            'course_id' => 'required',
            'place_id' => 'required',

        ]);
        //dump($request);
        $dictations = Dictation::create($request->all());

        return redirect()->route('admin.dictations.index', $dictations)
                            ->with('info', 'Dictado creado con Exito !');
    }


    // CREE ESTA FUNCION PARA MANDARSELA COMO PARAMETRO A MI CREATE DICTATION
    public function dictation(Dictation $dictations)
    {
        $courses = Course::pluck('name', 'id');
        $places = Place::pluck('city', 'id');
        $dictations = Dictation::all();

        return view ('courses.dictation', compact(
                                                    'dictations',
                                                    'places',
                                                    'courses'
                                                ));
    }
    // ************************************************************************

    public function edit(Dictation $dictation)
    {
        $courses = Course::pluck('name', 'id');
        $places = Place::pluck('city', 'id');
        //$users = User::pluck('number_license', 'id');
        return view ('admin.dictations.edit', compact(
                                                        'dictation',
                                                        'places',
                                                        'courses',
                                                    ));
    }

    public function update(Request $request, Dictation $dictation)
    {
        $dictation->update($request->all());
        return redirect()->route('admin.dictations.index', $dictation)
                            ->with('info', 'Dictado actualizado con Exito !');
    }


    public function destroy(Dictation $dictation)
    {
            //dd($dictation);
            $dictation->delete();
            //luego de hacer esto va a mi modelo y suma uno al dictation
            return redirect()->route('admin.dictations.index')
                                ->with('info', 'Dictado eliminado con Exito !');
    }


}
