<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view("admin.technologies.index", compact("technologies"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->validate([
            "name" => ["required", "unique:technologies", "max:150"]
        ]);

        $form_data["slug"] = Helpers::generateSlug($form_data["name"]);
        $new_technology = Technology::create($form_data);

        return redirect()->back()->with("message", "$new_technology->name è stato aggiunto correttamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view("admin.technologies.show", compact("technology"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $form_data = $request->validate([
            "name" => ["required", Rule::unique("technologies")->ignore($technology), "max:150"]
        ]);

        $form_data["slug"] = Helpers::generateSlug($form_data["name"]);

        $technology->update($form_data);
        return redirect()->back()->with("message", "$technology->name è stato cambiato correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        //Elimino tutti i collegamenti con i progetti
        $technology->projects()->detach();
        $technology->delete();
        return redirect()->back()->with("message", "$technology->name è stato cancellato correttamente!");
    }
}
