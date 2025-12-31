<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    /**
     * Display all notifications for authenticated user
     */
    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $notifications = $user->notifications()
            ->when(request('filter') === 'unread', function ($query) {
                $query->unread();
            })
            ->when(request('filter') === 'read', function ($query) {
                $query->read();
            })
            ->latest()
            ->paginate(20);

        $unreadCount = $user->notifications()->unread()->count();

        return view('superadmin.notifikasi.index', [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }

    /**
     * Get unread notifications count (for AJAX)
     */
    public function getUnreadCount()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return response()->json([
            'count' => $user->notifications()->unread()->count(),
            'notifications' => $user->notifications()
                ->unread()
                ->latest()
                ->limit(5)
                ->get()
                ->map(function ($notif) {
                    return [
                        'id' => $notif->id,
                        'title' => $notif->title,
                        'content' => $notif->content,
                        'type' => $notif->type,
                        'icon' => $notif->icon,
                        'created_at' => $notif->created_at->diffForHumans(),
                    ];
                })
        ]);
    }

    /**
     * Send notification to specific user or multiple users
     */
    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'recipient_type' => 'required|in:all,role,user',
            'user_id' => 'nullable|exists:users,id',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
            'role' => 'nullable|string',
            'type' => 'required|in:info,success,warning,danger,notification,system',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
            'icon' => 'nullable|string|max:50',
            'action_url' => 'nullable|string|max:255',
        ]);

        $userIds = [];

        if ($validated['recipient_type'] === 'all') {
            // Send to all users except self
            $userIds = User::where('id', '!=', auth()->id())->pluck('id')->toArray();
        } elseif ($validated['recipient_type'] === 'role' && !empty($validated['role'])) {
            // Send to users with specific role
            $userIds = User::where('role', $validated['role'])
                ->where('id', '!=', auth()->id())
                ->pluck('id')->toArray();
        } elseif ($validated['recipient_type'] === 'user') {
            // Send to specific users
            if (!empty($validated['user_ids'])) {
                $userIds = $validated['user_ids'];
            } elseif (!empty($validated['user_id'])) {
                $userIds[] = $validated['user_id'];
            }
        }

        // Create notifications for each user
        foreach ($userIds as $userId) {
            Notification::create([
                'user_id' => $userId,
                'type' => $validated['type'],
                'title' => $validated['title'],
                'content' => $validated['content'],
                'icon' => $validated['icon'] ?? 'bi-info-circle',
                'action_url' => $validated['action_url'] ?? null,
            ]);
        }

        $recipientLabel = match ($validated['recipient_type']) {
            'all' => 'semua pengguna',
            'role' => "pengguna dengan role {$validated['role']}",
            'user' => count($userIds) . ' pengguna pilihan',
            default => 'pengguna'
        };

        return back()->with('success', 'Notifikasi berhasil dikirim ke ' . count($userIds) . ' ' . $recipientLabel);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Notification $notification): RedirectResponse
    {
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai sebagai terbaca');
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->notifications()
            ->unread()
            ->each(function ($notification) {
                $notification->markAsRead();
            });

        return back()->with('success', 'Semua notifikasi ditandai sebagai terbaca');
    }

    /**
     * Delete notification
     */
    public function destroy(Notification $notification): RedirectResponse
    {
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus');
    }

    /**
     * Delete all notifications
     */
    public function destroyAll(): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->notifications()->delete();

        return back()->with('success', 'Semua notifikasi berhasil dihapus');
    }
}
