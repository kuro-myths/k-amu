<?php

namespace App\Http\Controllers\Mastercard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(): View
    {
        $messages = Message::where('room_id', 'mastercard')
            ->with(['sender'])
            ->latest()
            ->paginate(20);

        return view('mastercard.obrolan.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'room_id' => 'mastercard',
            'content' => $validated['content'],
            'type' => 'text',
        ]);

        return back()->with('success', 'Pesan terkirim');
    }
}
