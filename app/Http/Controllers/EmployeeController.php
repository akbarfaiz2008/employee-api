<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nik' => 'required',
                'name' => 'required',
                'email' => 'required',
                'alamat' => 'required',
                'phone' => 'required'
            ]);
    
            $data = Employee::create([
                'nik' => $request->nik,
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'phone' => $request->phone
            ]);
            
            if ($data->save()) {
                return response([
                    'message' => 'Successfully created data',
                    'data' => $data
                ]);
            } else {
                return response([
                    'message' => 'Failed to create data'
                ], 400);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $data = Employee::where('nik', $request->id)->first();

            if ($data) {
                return response([
                    'data' => $data
                ]);
            } else {
                return response([
                    'message' => 'Data not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'alamat' => 'required',
                'phone' => 'required'
            ]);

            $data = Employee::where('nik', $id)->first();

            if (!$data) {
                return response([
                    'message' => 'Data not found'
                ], 404);
            }

            $data->name = $request->name;
            $data->alamat = $request->alamat;
            $data->phone = $request->phone;

            if ($data->save()) {
                return response([
                    'message' => 'Successfully updated data',
                    'data' => $data
                ]);
            } else {
                return response([
                    'message' => 'Failed to update data'
                ], 400);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Employee::where('nik', $id)->first();
            if ($data) {
                $data->delete();
                return response([
                    'message' => 'Data deleted'
                ], 200);
            } else {
                return response([
                    'message' => 'Data not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
