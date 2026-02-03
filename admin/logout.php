<?php
session_start();

// Jika tombol logout diklik
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_logout'])) {
    // Hapus semua session
    $_SESSION = [];
    session_unset();
    session_destroy();

    // Redirect ke halaman login
    header("Location: login.php"); // sesuaikan path login
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Logout Confirmation</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white flex items-center justify-center min-h-screen">

  <form action="" method="POST"
        class="w-72 p-6 border border-gray-300 shadow-md bg-white rounded-md">

    <h2 class="font-bold text-black text-lg mb-3">
      Logout
    </h2>

    <p class="text-black mb-6">
      Apakah Anda yakin ingin keluar dari sistem?
    </p>

    <div class="flex space-x-3">

      <button
        type="submit"
        name="confirm_logout"
        value="1"
        class="bg-[#465E35] hover:bg-[#344726] text-white text-sm font-semibold px-4 py-2 rounded"
      >
        Keluar
      </button>

      <button
        type="button"
        onclick="history.back()"
        class="border border-gray-400 text-black text-sm font-normal px-4 py-2 rounded"
      >
        Batal
      </button>

    </div>

  </form>

</body>
</html>
