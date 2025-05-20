<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Mading;
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

        $statuses = Mading::getStatusList();

        return view('admin.mading.index', compact('customers', 'statuses'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['pic'] = auth()->user()->name;
        $data['image_ids'] = json_encode([]);
        $mading = $this->madingService->createMading($data);

        History::create([
            'mading_id' => $mading->id,
            'action' => 'Mading created with status = ' . $data['status'],
            'document' => '',
            'image_ids' => json_encode([]),
            'user_id' => auth()->user()->id
        ]);

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
        $data['pic'] = auth()->user()->name;
// dd($status !== $existingMading->status);
        if ($status && $status != $existingMading->status) {
            // If the status has changed, set the status_color to 'warning'
            $data['status_color'] = 'warning';
        }
// dd($data);
        // Perform the update with the updated data array
        $mading = $this->madingService->updateMading($data, $id);

        if($existingMading->status != $data['status']) {
            History::create([
                'mading_id' => $mading->id,
                'action' => 'Mading updated status from ' . $existingMading->status . ' to ' . $data['status'],
                'document' => '',
                'image_ids' => json_encode([]),
                'user_id' => auth()->user()->id
            ]);
        }

        return response()->json($mading);
    }


    public function destroy($id)
    {
        $this->madingService->deleteMading($id);
        return response()->json('Mading deleted successfully');
    }
}
