<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\MadingService;

class MadingController extends Controller
{
    protected $madingService;

    public function __construct(MadingService $madingService)
    {
        $this->madingService = $madingService;
        // $this->middleware('auth')->except('fetchData');
    }
    public function fetchData()
    {
        $madings = $this->madingService->getMadingOrder('updated_at', 'DESC');
        return response()->json(['data' => $madings]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $madings = $this->madingService->getMadingOrder('updated_at', 'DESC');
            return response()->json(['data' => $madings]);
        }

        $customers = User::where('role', 'customer')->get();

        return view('admin.mading.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $mading = $this->madingService->createMading($request->all());
        return response()->json($mading);
    }

    public function show($id)
    {
        $mading = $this->madingService->getMadingById($id);
        return response()->json($mading);
    }

    public function update(Request $request, $id)
    {
        // Retrieve the existing record to compare the current status
        $existingMading = $this->madingService->getMadingById($id); // Assuming there's a method to find the mading by id
        // Get the status from the request and compare it with the existing one
        $status = $request->input('status');
        $data = $request->all();
// dd($status !== $existingMading->status);
        if ($status && $status != $existingMading->status) {
            // If the status has changed, set the status_color to 'warning'
            $data['status_color'] = 'warning';
        }
// dd($data);
        // Perform the update with the updated data array
        $mading = $this->madingService->updateMading($data, $id);

        return response()->json($mading);
    }


    public function destroy($id)
    {
        $this->madingService->deleteMading($id);
        return response()->json('Mading deleted successfully');
    }
}
