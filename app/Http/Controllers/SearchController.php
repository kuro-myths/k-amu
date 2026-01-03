<?php

namespace App\Http\Controllers;

use App\Models\SearchHistory;
use App\Models\Note;
use App\Models\Project;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Search across user's data (notes, projects, messages)
     */
    public function search(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'query' => 'required|string|min:1|max:255',
            'type' => 'in:all,notes,projects,messages', // Filter by type
            'tags' => 'array',
            'tags.*' => 'string',
        ]);

        $query = $validated['query'];
        $type = $validated['type'] ?? 'all';
        $tags = $validated['tags'] ?? [];

        $results = [];

        // Search Notes
        if ($type === 'all' || $type === 'notes') {
            $noteResults = Note::where('user_id', $user->id)
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%");
                })
                ->select(['id', 'title', 'content', 'created_at', 'user_id'])
                ->limit(10)
                ->get()
                ->map(fn($note) => [
                    'type' => 'note',
                    'id' => $note->id,
                    'title' => $note->title,
                    'content' => substr($note->content, 0, 100) . '...',
                    'created_at' => $note->created_at,
                    'url' => route('notes.show', $note->id),
                ]);
            $results['notes'] = $noteResults;
        }

        // Search Projects
        if ($type === 'all' || $type === 'projects') {
            $projectResults = Project::where('leader_id', $user->id)
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->select(['id', 'name', 'description', 'created_at', 'leader_id'])
                ->limit(10)
                ->get()
                ->map(fn($project) => [
                    'type' => 'project',
                    'id' => $project->id,
                    'title' => $project->name,
                    'content' => substr($project->description ?? '', 0, 100) . '...',
                    'created_at' => $project->created_at,
                    'url' => route('projects.show', $project->id),
                ]);
            $results['projects'] = $projectResults;
        }

        // Search Messages
        if ($type === 'all' || $type === 'messages') {
            $messageResults = Message::where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                    ->orWhere('recipient_id', $user->id);
            })
                ->where('content', 'like', "%{$query}%")
                ->select(['id', 'content', 'sender_id', 'recipient_id', 'created_at'])
                ->limit(10)
                ->get()
                ->map(fn($message) => [
                    'type' => 'message',
                    'id' => $message->id,
                    'title' => 'Pesan dari ' . $message->sender->name,
                    'content' => substr($message->content, 0, 100) . '...',
                    'created_at' => $message->created_at,
                ]);
            $results['messages'] = $messageResults;
        }

        $totalCount = array_reduce($results, fn($carry, $items) => $carry + count($items), 0);

        // Save search history
        SearchHistory::create([
            'user_id' => $user->id,
            'query' => $query,
            'result_count' => $totalCount,
            'tags' => !empty($tags) ? json_encode($tags) : null,
            'last_searched_at' => now(),
        ]);

        return response()->json([
            'query' => $query,
            'total_results' => $totalCount,
            'results' => $results,
        ]);
    }

    /**
     * Get search history for current user
     */
    public function history(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'limit' => 'integer|min:1|max:100',
            'offset' => 'integer|min:0',
        ]);

        $limit = $validated['limit'] ?? 20;
        $offset = $validated['offset'] ?? 0;

        $history = SearchHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'query' => $item->query,
                'result_count' => $item->result_count,
                'tags' => $item->getTagsArray(),
                'is_bookmarked' => $item->is_bookmarked,
                'last_searched_at' => $item->last_searched_at,
                'created_at' => $item->created_at,
            ]);

        return response()->json([
            'total' => SearchHistory::where('user_id', $user->id)->count(),
            'data' => $history,
        ]);
    }

    /**
     * Add tag to a search history
     */
    public function addTag(Request $request, SearchHistory $searchHistory): JsonResponse
    {
        $this->authorize('update', $searchHistory);

        $validated = $request->validate([
            'tag' => 'required|string|max:50',
        ]);

        $tags = $searchHistory->getTagsArray();
        $tag = $validated['tag'];

        if (!in_array($tag, $tags)) {
            $tags[] = $tag;
            $searchHistory->setTagsArray($tags);
            $searchHistory->save();
        }

        return response()->json([
            'message' => 'Tag ditambahkan',
            'tags' => $searchHistory->getTagsArray(),
        ]);
    }

    /**
     * Remove tag from a search history
     */
    public function removeTag(Request $request, SearchHistory $searchHistory): JsonResponse
    {
        $this->authorize('update', $searchHistory);

        $validated = $request->validate([
            'tag' => 'required|string',
        ]);

        $tags = $searchHistory->getTagsArray();
        $tag = $validated['tag'];

        $tags = array_filter($tags, fn($t) => $t !== $tag);
        $searchHistory->setTagsArray(array_values($tags));
        $searchHistory->save();

        return response()->json([
            'message' => 'Tag dihapus',
            'tags' => $searchHistory->getTagsArray(),
        ]);
    }

    /**
     * Toggle bookmark for a search history
     */
    public function toggleBookmark(SearchHistory $searchHistory): JsonResponse
    {
        $this->authorize('update', $searchHistory);

        $searchHistory->is_bookmarked = !$searchHistory->is_bookmarked;
        $searchHistory->save();

        return response()->json([
            'message' => $searchHistory->is_bookmarked ? 'Ditandai' : 'Penanda dihapus',
            'is_bookmarked' => $searchHistory->is_bookmarked,
        ]);
    }

    /**
     * Get bookmarked searches
     */
    public function bookmarks(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'limit' => 'integer|min:1|max:100',
            'offset' => 'integer|min:0',
        ]);

        $limit = $validated['limit'] ?? 20;
        $offset = $validated['offset'] ?? 0;

        $bookmarks = SearchHistory::where('user_id', $user->id)
            ->where('is_bookmarked', true)
            ->orderBy('created_at', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'query' => $item->query,
                'result_count' => $item->result_count,
                'tags' => $item->getTagsArray(),
                'created_at' => $item->created_at,
            ]);

        return response()->json([
            'total' => SearchHistory::where('user_id', $user->id)
                ->where('is_bookmarked', true)
                ->count(),
            'data' => $bookmarks,
        ]);
    }

    /**
     * Search by tag
     */
    public function searchByTag(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'tag' => 'required|string',
        ]);

        $tag = $validated['tag'];

        $results = SearchHistory::where('user_id', $user->id)
            ->where('tags', 'like', "%{$tag}%")
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'query' => $item->query,
                'result_count' => $item->result_count,
                'tags' => $item->getTagsArray(),
                'is_bookmarked' => $item->is_bookmarked,
                'created_at' => $item->created_at,
            ]);

        return response()->json([
            'tag' => $tag,
            'total' => count($results),
            'data' => $results,
        ]);
    }

    /**
     * Clear search history
     */
    public function clearHistory(): JsonResponse
    {
        $user = Auth::user();

        SearchHistory::where('user_id', $user->id)->delete();

        return response()->json([
            'message' => 'Riwayat pencarian dihapus',
        ]);
    }
}
