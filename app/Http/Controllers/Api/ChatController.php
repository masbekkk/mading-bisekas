<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index($conversation, Request $request)
    {
        try {
            $page = $request->get('page', 1);
            $perPage = $request->get('per_page', 10);

            $offset = ($page - 1) * $perPage;

            $conversation = Conversation::with([
                'messages' => function ($query) use ($perPage, $offset) {
                    $query->with('sender:id,name,role')
                        ->orderBy('created_at', 'desc')
                        ->skip($offset)
                        ->take($perPage);
                }
            ])->find($conversation);

            if (!$conversation) {
                return formatResponse('error', 'Data tidak ditemukan', null, 'Data tidak ditemukan', 404);
            }

            $conversation->messages()
                ->where('is_read', 0)
                ->where('sender_id', '!=', auth()->id())
                ->update(['is_read' => 1]);

            $totalMessages = $conversation->messages()->count();
            $lastPage = ceil($totalMessages / $perPage);
            $currentPage = $page;

            $baseUrl = url()->current();
            $queryParams = $request->except('page');

            $links = [
                'first' => $baseUrl . '?' . http_build_query(array_merge($queryParams, ['page' => 1])),
                'last' => $baseUrl . '?' . http_build_query(array_merge($queryParams, ['page' => $lastPage])),
                'prev' => $currentPage > 1 ? $baseUrl . '?' . http_build_query(array_merge($queryParams, ['page' => $currentPage - 1])) : null,
                'next' => $currentPage < $lastPage ? $baseUrl . '?' . http_build_query(array_merge($queryParams, ['page' => $currentPage + 1])) : null,
            ];

            $response = [
                'conversation' => $conversation,
                'meta' => [
                    'total' => $totalMessages,
                    'per_page' => $perPage,
                    'current_page' => $currentPage,
                    'last_page' => $lastPage
                ],
                'links' => $links
            ];

            return formatResponse('success', 'Data Berhasil Diambil!', $response);
        } catch (Exception $e) {
            Log::error('Error fetching conversation messages: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $authUser = auth()->user();
            $isAdmin = $authUser->role === 'admin';

            $validator = Validator::make($request->all(), [
                'message' => 'required|string',
                'customer_id' => $isAdmin ? 'required|exists:users,id' : 'nullable',
                'images.*' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($validator->fails()) {
                return formatResponse('error', 'Validasi gagal', null, $validator->errors(), 400);
            }

            $conversation = Conversation::firstOrCreate(
                $isAdmin
                    ? ['customer_id' => $request->customer_id, 'admin_id' => 1]
                    : ['customer_id' => $authUser->id, 'admin_id' => 1]
            );

            $imageIds = [];
            $imageNames = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $originalExtension = $file->getClientOriginalExtension();
                    
                    $filename = $originalName . '-' . time() . '.' . $originalExtension;
                    $filePath = 'storage/images/'.$filename;

                    $file->storeAs('images', $filename, 'public');

                    $image = Image::create([
                        'name' => $filename,
                        'path' => $filePath
                    ]);

                    $imageIds[] = $image->id;
                    $imageNames[] = $filename;
                }
            }

            $message = $conversation->messages()->create([
                'sender_id' => auth()->id(),
                'message' => $request->message,
                'image_ids' => json_encode($imageIds),
            ]);

            return formatResponse('success', 'Data berhasil ditambahkan!', $message, null, 201);
        } catch (Exception $e) {
            foreach($imageNames as $name) {
                if(file_exists(storage_path('app/public/images/' . $name))) {
                    Storage::disk('public')->delete('images/' . $name);
                }
            }

            Log::error('Error API store comment: ' . $e->getMessage());
            return formatResponse('error', 'Gagal menambahkan data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function getConversations()
    {
        try {
            $role = auth()->user()->role;

            if($role == 'customer') {
                $conversations = Conversation::where('customer_id', auth()->id())
                ->with([
                    'customer:id,name,role',
                    'admin:id,name,role'
                ])
                ->with(['messages' => function ($query) {
                    $query->orderBy('created_at', 'desc')->with(['sender:id,name,role'])->limit(1);
                }])
                ->get();
            } else {
                $conversations = Conversation::where('admin_id', 1)
                ->with([
                    'customer:id,name,role',
                    'admin:id,name,role'
                ])
                ->with(['messages' => function ($query) {
                    $query->orderBy('created_at', 'desc')->with(['sender:id,name,role'])->limit(1);
                }])
                ->get();
            }

            return formatResponse('success', 'Data Berhasil Diambil!', $conversations);

        } catch (\Throwable $th) {
            Log::error('Error fetching conversations: ' . $th->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $th->getMessage(), $th->getCode() ?: 500);
        }
    }
}
