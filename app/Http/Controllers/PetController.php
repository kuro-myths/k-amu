<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
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
                'message' => 'Kai-Myu senang diajak bermain! 💜',
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
                'message' => 'Kai-Myu sedang istirahat... 😴',
                'health' => $pet->health,
                'energy' => $pet->energy,
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Chat dengan AI Pet
     */
    public function chat(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $message = $request->input('message');
        $pet = $user->pet ?? Pet::where('user_id', $user->id)->first();

        if (!$pet) {
            return response()->json(['success' => false], 404);
        }

        // Simple AI responses berdasarkan keyword
        $responses = $this->getAIResponses();

        $messageLower = strtolower($message);
        $response = 'Hmm, pertanyaan menarik! Saya masih belajar tentang itu. Bisa coba pertanyaan lain? 😊';

        foreach ($responses as $keyword => $reply) {
            if (strpos($messageLower, $keyword) !== false) {
                $response = $reply;
                break;
            }
        }

        // Add experience setiap chat
        $pet->addExperience(3);
        $pet->update(['last_interaction' => now()]);

        return response()->json([
            'success' => true,
            'response' => $response,
            'pet' => [
                'level' => $pet->level,
                'experience' => $pet->experience,
                'happiness' => $pet->happiness,
            ],
        ]);
    }

    /**
     * Get AI responses
     */
    private function getAIResponses()
    {
        return [
            'siapa' => 'Saya Kai-Myu, mascot virtual K-AMU! 🎀 Saya di sini untuk memberikan motivasi dan dukungan dalam perjalanan akademik Anda. Senang bertemu dengan Anda! 💜',
            'keahlian' => 'Keahlian saya mencakup: ✨ Memberikan motivasi, 📚 Panduan akademik, 🎯 Manajemen proyek, 💬 Menjawab pertanyaan, dan 💪 Memberikan dukungan emosional!',
            'motivasi' => 'Ingat, setiap langkah kecil adalah progres! 🌟 Anda lebih kuat daripada yang Anda pikir. Terus semangat, percaya pada diri sendiri, dan raih impian Anda! 💪 Saya ada di sini mendukung Anda!',
            'tips' => 'Berikut tips belajar efektif: 1️⃣ Buat jadwal rutin, 2️⃣ Belajar dengan fokus tanpa gangguan, 3️⃣ Gunakan metode yang sesuai untuk Anda, 4️⃣ Istirahat cukup, 5️⃣ Praktik berkala. Anda bisa! 📚💪',
            'halo' => 'Halo! 👋 Apa kabar? Senang bertemu dengan Anda! Ada yang bisa saya bantu? 😊',
            'terima kasih' => 'Sama-sama! 😄 Senang bisa membantu. Jangan ragu untuk bertanya lagi kapan saja! 💜',
            'kapan' => 'Itu tergantung dari apa yang ingin Anda capai. Saya siap membantu kapan saja Anda membutuhkan! 🌟',
            'bagaimana' => 'Baik pertanyaan! Coba ceritakan lebih detail dan saya akan berusaha membantu sebaik mungkin! 💡',
        ];
    }
}
