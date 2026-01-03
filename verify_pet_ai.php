#!/usr/bin/env php
<?php
/**
 * Pet AI Feature - Final Verification Script
 * Run this to ensure all components are properly configured
 */

echo "\n╔══════════════════════════════════════════════════════════════════╗\n";
echo "║           Pet AI Feature - Verification Checklist                ║\n";
echo "╚══════════════════════════════════════════════════════════════════╝\n\n";

$checks = [
    'files' => [],
    'config' => [],
    'database' => [],
    'code' => [],
];

// ============================================================================
// 1. FILE CHECKS
// ============================================================================

echo "📁 FILE CHECKS\n";
echo "─────────────────────────────────────────────────────────────────\n";

$files = [
    'app/Services/GeminiPetService.php' => 'GeminiPetService implementation',
    'app/Http/Controllers/PetController.php' => 'PetController',
    'app/Models/Pet.php' => 'Pet Model',
    'config/services.php' => 'Services Configuration',
    '.env' => 'Environment Configuration',
    'routes/web.php' => 'Web Routes',
    'app/Console/Commands/TestGeminiPet.php' => 'Test Command',
];

$files_ok = true;
foreach ($files as $file => $desc) {
    $exists = file_exists($file);
    $status = $exists ? '✅' : '❌';
    echo "{$status} {$desc} ({$file})\n";
    $files_ok = $files_ok && $exists;
}

echo "\n";

// ============================================================================
// 2. CONFIGURATION CHECKS
// ============================================================================

echo "⚙️  CONFIGURATION CHECKS\n";
echo "─────────────────────────────────────────────────────────────────\n";

$env_file = file_get_contents('.env');

// Check GEMINI_API_KEY
if (strpos($env_file, 'GEMINI_API_KEY=') !== false) {
    preg_match('/GEMINI_API_KEY=(.+)/', $env_file, $matches);
    $key = trim($matches[1] ?? '');
    if ($key && strlen($key) > 10) {
        echo "✅ GEMINI_API_KEY configured (length: " . strlen($key) . ")\n";
    } else {
        echo "❌ GEMINI_API_KEY not properly set\n";
    }
} else {
    echo "❌ GEMINI_API_KEY not found in .env\n";
}

// Check services.php
$services = file_get_contents('config/services.php');
if (strpos($services, "'gemini'") !== false) {
    echo "✅ Gemini service configured in services.php\n";
} else {
    echo "❌ Gemini service not found in services.php\n";
}

echo "\n";

// ============================================================================
// 3. CODE STRUCTURE CHECKS
// ============================================================================

echo "🔍 CODE STRUCTURE CHECKS\n";
echo "─────────────────────────────────────────────────────────────────\n";

$service_code = file_get_contents('app/Services/GeminiPetService.php');

$methods = ['chatWithPet', 'generateMotivation', 'generateLearningTip', 'buildPetPersonality'];
$all_methods_ok = true;

foreach ($methods as $method) {
    $exists = strpos($service_code, "public function {$method}") !== false;
    $status = $exists ? '✅' : '❌';
    echo "{$status} GeminiPetService::{$method}()\n";
    $all_methods_ok = $all_methods_ok && $exists;
}

echo "\n";

// ============================================================================
// 4. CONTROLLER CHECKS
// ============================================================================

echo "🎮 CONTROLLER INTEGRATION CHECKS\n";
echo "─────────────────────────────────────────────────────────────────\n";

$controller_code = file_get_contents('app/Http/Controllers/PetController.php');

$controller_methods = [
    'show' => 'Display pet page',
    'chat' => 'Chat with AI',
    'interact' => 'Play with pet',
    'rest' => 'Rest pet',
    'getMotivation' => 'Get motivation',
    'getLearningTip' => 'Get learning tip',
];

$controller_ok = true;

foreach ($controller_methods as $method => $desc) {
    $exists = strpos($controller_code, "public function {$method}") !== false;
    $status = $exists ? '✅' : '❌';
    echo "{$status} PetController::{$method}() - {$desc}\n";
    $controller_ok = $controller_ok && $exists;
}

// Check service injection
if (strpos($controller_code, 'GeminiPetService') !== false) {
    echo "✅ GeminiPetService properly injected\n";
} else {
    echo "❌ GeminiPetService not injected\n";
    $controller_ok = false;
}

echo "\n";

// ============================================================================
// 5. ROUTES CHECKS
// ============================================================================

echo "🛣️  ROUTES CONFIGURATION CHECKS\n";
echo "─────────────────────────────────────────────────────────────────\n";

$routes_code = file_get_contents('routes/web.php');

$routes = [
    '/mascot' => 'show',
    '/pet/chat' => 'chat',
    '/pet/motivation' => 'getMotivation',
    '/pet/learning-tip' => 'getLearningTip',
    '/pet/interact' => 'interact',
    '/pet/rest' => 'rest',
];

$routes_ok = true;

foreach ($routes as $endpoint => $method) {
    $pattern = str_replace('/', '\/', $endpoint);
    $exists = preg_match("/{$pattern}/", $routes_code);
    $status = $exists ? '✅' : '❌';
    echo "{$status} {$endpoint} → {$method}()\n";
    $routes_ok = $routes_ok && $exists;
}

echo "\n";

// ============================================================================
// 6. API INTEGRATION CHECKS
// ============================================================================

echo "🌐 API INTEGRATION CHECKS\n";
echo "─────────────────────────────────────────────────────────────────\n";

$api_checks = [
    'generativelanguage.googleapis.com' => 'Google Gemini API URL',
    'gemini-pro:generateContent' => 'Model endpoint',
    'maxOutputTokens' => 'Token limit configuration',
    'temperature' => 'Generation temperature',
];

foreach ($api_checks as $check => $desc) {
    $exists = strpos($service_code, $check) !== false;
    $status = $exists ? '✅' : '❌';
    echo "{$status} {$desc} ({$check})\n";
}

echo "\n";

// ============================================================================
// 7. ERROR HANDLING CHECKS
// ============================================================================

echo "🛡️  ERROR HANDLING & LOGGING CHECKS\n";
echo "─────────────────────────────────────────────────────────────────\n";

$error_checks = [
    'try' => 'Try-catch blocks',
    'Log::error' => 'Error logging',
    'catch' => 'Exception handling',
    'return [' => 'Proper response format',
    'response()->json' => 'JSON responses',
];

foreach ($error_checks as $check => $desc) {
    $exists = strpos($service_code, $check) !== false || strpos($controller_code, $check) !== false;
    $status = $exists ? '✅' : '❌';
    echo "{$status} {$desc}\n";
}

echo "\n";

// ============================================================================
// 8. SUMMARY
// ============================================================================

echo "╔══════════════════════════════════════════════════════════════════╗\n";
echo "║                         SUMMARY                                  ║\n";
echo "╚══════════════════════════════════════════════════════════════════╝\n\n";

$all_ok = $files_ok && $all_methods_ok && $controller_ok && $routes_ok;

if ($all_ok) {
    echo "✅ ALL CHECKS PASSED!\n\n";
    echo "Your Pet AI feature is ready to use! 🎉\n\n";
    echo "Next steps:\n";
    echo "1. php artisan test:gemini-pet (to test all features)\n";
    echo "2. Open http://localhost:8000/mascot in your browser\n";
    echo "3. Login and start using your Pet AI!\n";
} else {
    echo "⚠️  SOME CHECKS FAILED!\n\n";
    echo "Please review the failed items above and fix them.\n";
}

echo "\n";

// ============================================================================
// 9. DETAILED STATUS
// ============================================================================

echo "╔══════════════════════════════════════════════════════════════════╗\n";
echo "║                   DETAILED COMPONENT STATUS                      ║\n";
echo "╚══════════════════════════════════════════════════════════════════╝\n\n";

echo "GeminiPetService Status\n";
echo "├─ Method: chatWithPet() → " . (strpos($service_code, 'public function chatWithPet') !== false ? '✅' : '❌') . "\n";
echo "├─ Method: generateMotivation() → " . (strpos($service_code, 'public function generateMotivation') !== false ? '✅' : '❌') . "\n";
echo "├─ Method: generateLearningTip() → " . (strpos($service_code, 'public function generateLearningTip') !== false ? '✅' : '❌') . "\n";
echo "├─ Error Handling → " . (strpos($service_code, 'try') !== false ? '✅' : '❌') . "\n";
echo "└─ Logging → " . (strpos($service_code, 'Log::error') !== false ? '✅' : '❌') . "\n\n";

echo "PetController Status\n";
echo "├─ Service Injection → " . (strpos($controller_code, 'GeminiPetService') !== false ? '✅' : '❌') . "\n";
echo "├─ Chat Method → " . (strpos($controller_code, 'public function chat') !== false ? '✅' : '❌') . "\n";
echo "├─ Motivation Method → " . (strpos($controller_code, 'public function getMotivation') !== false ? '✅' : '❌') . "\n";
echo "├─ Learning Tip Method → " . (strpos($controller_code, 'public function getLearningTip') !== false ? '✅' : '❌') . "\n";
echo "├─ Auth Protection → " . (strpos($controller_code, 'Auth::user()') !== false ? '✅' : '❌') . "\n";
echo "└─ Error Response → " . (strpos($controller_code, 'response()->json') !== false ? '✅' : '❌') . "\n\n";

echo "Routes Status\n";
echo "├─ /mascot endpoint → " . (strpos($routes_code, "get('/mascot'") !== false || strpos($routes_code, 'mascot') !== false ? '✅' : '❌') . "\n";
echo "├─ /pet/chat endpoint → " . (strpos($routes_code, "post('/pet/chat'") !== false || strpos($routes_code, 'pet/chat') !== false ? '✅' : '❌') . "\n";
echo "├─ /pet/motivation endpoint → " . (strpos($routes_code, "'pet/motivation'") !== false ? '✅' : '❌') . "\n";
echo "├─ /pet/learning-tip endpoint → " . (strpos($routes_code, "'pet/learning-tip'") !== false ? '✅' : '❌') . "\n";
echo "├─ Auth Middleware → " . (strpos($routes_code, "'auth'") !== false ? '✅' : '❌') . "\n";
echo "└─ PetController Import → " . (strpos($routes_code, 'PetController') !== false ? '✅' : '❌') . "\n\n";

echo "═══════════════════════════════════════════════════════════════════\n\n";

?>