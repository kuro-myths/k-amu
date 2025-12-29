<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ChatController extends Controller
{
    public function index(): View
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $messages = Message::where(function ($q) {
            $q->where('sender_id', auth()->id())
                ->orWhere('recipient_id', auth()->id());
        })->with(['user'])->latest()->limit(50)->get();

        return view('superadmin.obrolan.index', ['users' => $users, 'messages' => $messages]);
    }

    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'content' => $validated['content'],
            'type' => 'text',
        ]);

        return back()->with('success', 'Pesan terkirim');
    }

    public function global(): View
    {
        $messages = Message::where('room_id', 'global')
            ->with(['sender'])
            ->latest()
            ->paginate(20);
        return view('superadmin.obrolan.global', ['messages' => $messages]);
    }

    public function sendGlobalMessage(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'room_id' => 'global',
            'content' => $validated['content'],
            'type' => 'text',
        ]);

        return back()->with('success', 'Pesan terkirim');
    }

    public function pribadi(): View
    {
        $userID = auth()->id();
        $conversations = Message::where('sender_id', $userID)
            ->orWhere('recipient_id', $userID)
            ->with(['sender', 'recipient'])
            ->latest()
            ->paginate(10);

        return view('superadmin.obrolan.pribadi', ['conversations' => $conversations]);
    }

    public function conversation($userId): View
    {
        $user = User::findOrFail($userId);
        $userID = auth()->id();

        $messages = Message::where(function ($query) use ($userID, $userId) {
            $query->where('sender_id', $userID)->where('recipient_id', $userId)
                ->orWhere('sender_id', $userId)->where('recipient_id', $userID);
        })->with(['sender', 'recipient'])->latest()->paginate(20);

        return view('superadmin.obrolan.detail', ['user' => $user, 'messages' => $messages]);
    }

    public function sendPrivateMessage(Request $request, $userId): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $userId,
            'content' => $validated['content'],
            'type' => 'text',
        ]);

        return back()->with('success', 'Pesan terkirim');
    }
}
