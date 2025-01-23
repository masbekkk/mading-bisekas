<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index($conversation, Request $request)
    {
        try {
            $limit = $request->get('limit', 10);
            $offset = $request->get('offset', 0);

            $conversation = Conversation::with([
                'messages' => function ($query) use ($limit, $offset) {
                    $query->with('sender:id,name,role')
                        ->orderBy('created_at', 'asc')
                        ->skip($offset)
                        ->take($limit);
                }
            ])->find($conversation);

            if (!$conversation) {
                return formatResponse('error', 'Data tidak ditemukan', null, 'Data tidak ditemukan', 404);
            }

            $conversation->messages()
                ->where('is_read', 0)
                ->where('sender_id', '!=', auth()->id())
                ->update(['is_read' => 1]);

            return formatResponse('success', 'Data Berhasil Diambil!', $conversation);
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
            ]);

            if ($validator->fails()) {
                return formatResponse('error', 'Validasi gagal', null, $validator->errors(), 400);
            }

            $conversation = Conversation::firstOrCreate(
                $isAdmin
                    ? ['customer_id' => $request->customer_id, 'admin_id' => 1]
                    : ['customer_id' => $authUser->id, 'admin_id' => 1]
            );

            $message = $conversation->messages()->create([
                'sender_id' => auth()->id(),
                'message' => $request->message
            ]);

            return formatResponse('success', 'Data berhasil ditambahkan!', $message, null, 201);
        } catch (Exception $e) {
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
