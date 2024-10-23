
function toggleDropdown() {
    var dropdown = document.getElementById("dropdown");
    var dropdownBtn = document.getElementById("dropdown-btn");
    dropdown.classList.toggle("active");
    dropdownBtn.classList.toggle("active");
  }

  function validateForm() {
    var role = document.getElementById("role").value;
    if (role === "pilih peran") {
        alert("Silakan pilih peran sebelum mendaftar.");
        return false; // Mencegah form dikirim
    }
    return true; // Lanjutkan pengiriman form jika valid
}