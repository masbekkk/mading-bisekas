<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MadingService;

class MadingController extends Controller
{
    protected $madingService;

    public function __construct(MadingService $madingService)
    {
        $this->madingService = $madingService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $madings = $this->madingService->getAllMadings();
            return response()->json(['data' => $madings]);
        }
        return view('admin.mading.index');
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
        $mading = $this->madingService->updateMading($request->all(), $id);
        return response()->json($mading);
    }

    public function destroy($id)
    {
        $this->madingService->deleteMading($id);
        return response()->json('Mading deleted successfully');
    }
}
