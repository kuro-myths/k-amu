<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Services\PetAIServiceFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    protected $aiService;

    public function __construct()
    {
        // Auto-load service berdasarkan AI_PROVIDER di .env
        $this->aiService = PetAIServiceFactory::create();
    }

    /**
     * Show pet page
     */
    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $pet = $user->pet;

        // Create default pet jika user belum punya
        if (!$pet) {
            $defaultNames = [
                'user' => ['Max', 'Bella', 'Charlie', 'Luna', 'Rocky'],
                'leader' => ['Phoenix', 'Storm', 'Titan', 'Eagle', 'Lion'],
                'mastercard' => ['Sphinx', 'Atlas', 'Oracle', 'Sage', 'Wizard'],
                'tester' => ['Scout', 'Hunter', 'Tracker', 'Ranger', 'Detective'],
                'superadmin' => ['Kai-Myu', 'Emperor', 'Sovereign', 'Master', 'Guardian'],
            ];

            $role = $user->role ?? 'user';
            $names = $defaultNames[$role] ?? $defaultNames['user'];
            $petName = $names[array_rand($names)];

            $pet = Pet::create([
                'user_id' => $user->id,
                'name' => $petName,
                'pet_type' => 'vtuber',
                'role_type' => $role,
                'biography' => "Pet assistant untuk {$role} yang loyal dan berdedikasi.",
                'stats' => [
                    'charm' => rand(80, 100),
                    'popularity' => rand(75, 95),
                    'knowledge' => rand(70, 90),
                    'sparkle' => rand(80, 100),
                ],
                'abilities' => [
                    'Loyal',
                    'Smart',
                    'Friendly',
                    'Helpful',
                    'Reliable',
                ],
            ]);
            User::where('id', $user->id)->update(['pet_id' => $pet->id]);
        }

        return view('mascot', compact('pet', 'user'));
    }

    /**
     * Interact dengan pet
     */
    public function interact(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $pet = $user->pet ?? Pet::where('user_id', $user->id)->first();

        if ($pet) {
            $pet->interact();
            return response()->json([
                'success' => true,
                'message' => $pet->name . ' senang diajak bermain! 💜',
                'happiness' => $pet->happiness,
                'energy' => $pet->energy,
                'experience' => $pet->experience,
                'level' => $pet->level,
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Pet rest
     */
    public function rest(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $pet = $user->pet ?? Pet::where('user_id', $user->id)->first();

        if ($pet) {
            $pet->rest();
            return response()->json([
                'success' => true,
                'message' => $pet->name . ' sedang istirahat... 😴',
                'health' => $pet->health,
                'energy' => $pet->energy,
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Chat dengan Gemini AI Pet
     */
    public function chat(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $message = $request->input('message');
        if (empty(trim($message))) {
            return response()->json(['success' => false, 'message' => 'Message cannot be empty'], 400);
        }

        $pet = $user->pet ?? Pet::where('user_id', $user->id)->first();

        if (!$pet) {
            return response()->json(['success' => false], 404);
        }

        // Use Gemini AI untuk generate response
        $petData = [
            'name' => $pet->name,
            'pet_type' => $pet->pet_type,
            'role_type' => $pet->role_type,
            'biography' => $pet->biography,
            'stats' => $pet->stats,
            'level' => $pet->level,
            'experience' => $pet->experience,
        ];

        $aiResult = $this->aiService->chatWithPet($message, $petData);

        if (!$aiResult['success']) {
            return response()->json([
                'success' => false,
                'response' => $aiResult['response'],
            ], 500);
        }

        // Add experience setiap chat
        $pet->addExperience(3);
        $pet->update(['last_interaction' => now()]);

        return response()->json([
            'success' => true,
            'response' => $aiResult['response'],
            'pet' => [
                'level' => $pet->level,
                'experience' => $pet->experience,
                'happiness' => $pet->happiness,
                'health' => $pet->health,
                'energy' => $pet->energy,
            ],
        ]);
    }

    /**
     * Get AI Motivation
     */
    public function getMotivation(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $pet = $user->pet ?? Pet::where('user_id', $user->id)->first();

        if (!$pet) {
            return response()->json(['success' => false], 404);
        }

        $petData = [
            'name' => $pet->name,
            'pet_type' => $pet->pet_type,
            'role_type' => $pet->role_type,
        ];

        $motivation = $this->aiService->generateMotivation($petData);

        return response()->json([
            'success' => true,
            'response' => $motivation,
        ]);
    }

    /**
     * Get AI Learning Tip
     */
    public function getLearningTip(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $pet = $user->pet ?? Pet::where('user_id', $user->id)->first();

        if (!$pet) {
            return response()->json(['success' => false], 404);
        }

        $petData = [
            'name' => $pet->name,
            'pet_type' => $pet->pet_type,
            'role_type' => $pet->role_type,
        ];

        $tip = $this->aiService->generateLearningTip($petData);

        return response()->json([
            'success' => true,
            'response' => $tip,
        ]);
    }
}
