
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
        return false;
    }
    return true; // Lanjutkan pengiriman form jika valid
}

document.addEventListener('DOMContentLoaded', () => {
  const menuIcon = document.querySelector('.header .menu-icon');
  const sidebar = document.querySelector('.sidebar');
  const content = document.querySelector('.content'); // Menangkap elemen konten
  const container = document.querySelector('.container');
  console.log(menuIcon, sidebar, container);

  menuIcon.addEventListener('click', () => {
    // Toggle kelas untuk sidebar dan konten
    sidebar.classList.toggle('sidebar-expanded');
    content.classList.toggle('sidebar-expanded-content');
    container.classList.toggle('sidebar-shifted-right');
  });
});

