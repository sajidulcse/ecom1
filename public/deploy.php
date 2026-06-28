<?php
/**
 * Secure Deployment Webhook for Laravel (Shared Hosting)
 * Receives the built deploy.zip from GitHub Actions and extracts it.
 */

// Disable timeout limits for large uploads
set_time_limit(300);
ini_set('memory_limit', '512M');

header('Content-Type: application/json');

function getEnvValue($key) {
    $path = __DIR__ . '/../.env';
    if (!file_exists($path)) return null;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') === false) continue;
        list($name, $value) = explode('=', $line, 2);
        if (trim($name) === $key) {
            return trim(trim($value), '"\'');
        }
    }
    return null;
}

$secureToken = getEnvValue('DEPLOY_SECURE_TOKEN');
if (!$secureToken) {
    echo json_encode(['status' => 'error', 'message' => 'DEPLOY_SECURE_TOKEN is not configured in .env file on the server.']);
    exit;
}

// Validate Token
$receivedToken = $_POST['token'] ?? $_GET['token'] ?? '';
if (empty($receivedToken) || $receivedToken !== $secureToken) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized token.']);
    exit;
}

// Validate Uploaded File
$zipFile = null;
$isTempFile = false;

if (isset($_FILES['package']) && $_FILES['package']['error'] === UPLOAD_ERR_OK) {
    $zipFile = $_FILES['package']['tmp_name'];
} else {
    // Fallback: Check if file was sent as raw binary POST payload
    $rawData = file_get_contents('php://input');
    if (!empty($rawData)) {
        $tempFile = tempnam(sys_get_temp_dir(), 'dep');
        if ($tempFile) {
            file_put_contents($tempFile, $rawData);
            $zipFile = $tempFile;
            $isTempFile = true;
        }
    }
}

if (!$zipFile) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'No deployment package uploaded or upload error occurred.']);
    exit;
}

$targetDir = realpath(__DIR__ . '/../');

if (!class_exists('ZipArchive')) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'ZipArchive PHP extension is not enabled on this server.']);
    exit;
}

$zip = new ZipArchive();
$success = false;
if ($zip->open($zipFile) === TRUE) {
    // Extract everything directly to Laravel root (parent of public/)
    $zip->extractTo($targetDir);
    $zip->close();
    
    // Attempt to clear Laravel cache if possible
    @unlink($targetDir . '/bootstrap/cache/config.php');
    @unlink($targetDir . '/bootstrap/cache/routes-v7.php');
    @unlink($targetDir . '/bootstrap/cache/packages.php');
    @unlink($targetDir . '/bootstrap/cache/services.php');

    $success = true;
}

// Clean up temporary file if we created one
if ($isTempFile && file_exists($zipFile)) {
    @unlink($zipFile);
}

if ($success) {
    echo json_encode(['status' => 'success', 'message' => 'Deployment package extracted successfully.']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to open deployment zip package.']);
}
