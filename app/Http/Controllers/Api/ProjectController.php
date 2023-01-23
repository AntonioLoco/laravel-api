<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has("type_id")) {
            $projects = Project::with("type", "technologies")->where("type_id", $request["type_id"])->paginate(5);
        } else {
            $projects = Project::with("type", "technologies")->paginate(5);
        }

        return response()->json([
            "success" => count($projects->items()) > 0 ? true : false,
            "response" => count($projects->items()) > 0 ? $projects : "Nessun progetto trovato"
        ]);
    }

    public function show($slug)
    {
        $project = Project::with("type", "technologies")->where("slug", $slug)->first();

        if ($project) {
            return response()->json([
                "success" => true,
                "response" => $project
            ]);
        } else {
            return response()->json([
                "success" => false,
                "response" => "Nessun progetto trovato"
            ]);
        }
    }
}
