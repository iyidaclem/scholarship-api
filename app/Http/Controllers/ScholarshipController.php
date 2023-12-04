<?php

namespace App\Http\Controllers;

use App\Models\Classes\CustomResponse;
use App\Models\Enums\Status;
use App\Models\Scholarship;
use DateTime;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return json_encode(new CustomResponse(Status::Successful->value, Scholarship::all(), ""));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                "sponsor" => "required",
                "amount" => "required|numeric",
                "number_of_awards" => "required|integer",
                "deadline" => "required|date",
                "url" => "required|unique:scholarships",
                "academic_level" => "required",
                "cover_image" => "required",
            ]
        );

        if ($validate->fails()) {
            return json_encode(new CustomResponse(Status::Failed->value, $validate->errors(), "Validation failed"));
        }

        $scholarship = new Scholarship();
        $scholarship->sponsor = $request->sponsor;
        $scholarship->amount = $request->amount;
        $scholarship->number_of_awards = $request->number_of_awards;
        $scholarship->deadline = new DateTime($request->deadline);
        $scholarship->url = $request->url;
        $scholarship->academic_level = $request->academic_level;
        $scholarship->cover_image = $request->cover_image;

        $scholarship->save();

        return json_encode(new CustomResponse(Status::Successful, $scholarship, "Scholarship added successfully"));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scholarship = Scholarship::find($id);
        if ($scholarship) {
            $scholarship = $scholarship->delete();
            return json_encode(new CustomResponse(Status::Successful->value, null, "Scholarship deleted"));
        }

        return json_encode(new CustomResponse(Status::Failed->value, null, "Scholarship not found"));
    }
}
