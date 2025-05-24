<?php
// config Firebase
$firebase_url = "https://blacklotus-db-default-rtdb.firebaseio.com/";

// Tangkap data POST dari form
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$pesan = isset($_POST['pesan']) ? $_POST['pesan'] : '';

// Validasi sederhana
if (!$nama || !$email || !$pesan) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
    exit;
}

// Data yang akan disimpan
$data = [
    'nama' => $nama,
    'email' => $email,
    'pesan' => $pesan,
    'timestamp' => date('c')
];

// Konversi data ke JSON
$data_json = json_encode($data);

// URL untuk POST data ke Firebase Realtime Database
$url = $firebase_url . "pesan_kesan.json";

// Inisialisasi cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

// Eksekusi request
$response = curl_exec($ch);

// Cek error cURL
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    curl_close($ch);
    echo json_encode(['status' => 'error', 'message' => $error_msg]);
    exit;
}
curl_close($ch);

// Parsing response (Firebase biasanya mengembalikan key dari data yang tersimpan)
$result = json_decode($response, true);

if (isset($result['name'])) {
    echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
}
?>
