<!-- components/logout-modal.blade.php -->
<div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div id="logoutModalContent"
       class="bg-white p-6 rounded-lg shadow-lg w-80 text-center transform scale-90 opacity-0 transition-all duration-300">
    <h2 class="text-xl font-semibold mb-4">Konfirmasi Logout</h2>
    <p class="text-gray-600 mb-6">Apakah kamu yakin ingin logout?</p>
    <div class="flex justify-center gap-4">
      <button onclick="closeLogoutModal()" class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400 transition">
        Batal
      </button>
      <button onclick="confirmLogout()" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700 transition">
        Logout
      </button>
    </div>
  </div>
</div>

<script>
  const modal = document.getElementById('logoutModal');
  const modalContent = document.getElementById('logoutModalContent');
  const logoutForm = document.getElementById('logout-form');

  function openLogoutModal() {
      modal.classList.remove('hidden');
      setTimeout(() => {
          modalContent.classList.remove('scale-90', 'opacity-0');
          modalContent.classList.add('scale-100', 'opacity-100');
      }, 10);
  }

  function closeLogoutModal() {
      modalContent.classList.remove('scale-100', 'opacity-100');
      modalContent.classList.add('scale-90', 'opacity-0');
      setTimeout(() => modal.classList.add('hidden'), 300);
  }

  function confirmLogout() {
      logoutForm.submit();
  }
</script>
