
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
  const container = document.querySelector('.container');
  const footer = document.querySelector('.footer');
  const registerBox = document.querySelector('.register-box');  // Perbaikan selector

  console.log(menuIcon, sidebar, container, footer, registerBox);
  
  menuIcon.addEventListener('click', () => {
    // Toggle kelas untuk sidebar dan konten
    sidebar.classList.toggle('sidebar-expanded');
    container.classList.toggle('sidebar-expanded-content');
    footer.classList.toggle('footer-active'); 
    registerBox.classList.toggle('sidebar-expanded-content');  // Perbaikan selector
  });
});


//fungsi memilih value untuk daftar

function redirectToRolePage(event) {
  event.preventDefault();

  const role = document.getElementById("role").value;

  if (role === "guru") {
    window.location.href = "daftarguru.php"; // Sesuaikan URL untuk halaman guru
} else if (role === "siswa") {
    window.location.href = "daftarsiswa.php"; // Sesuaikan URL untuk halaman siswa
} else if (role === "admin") {
    window.location.href = "daftaradmin.php"; // Sesuaikan URL untuk halaman admin
} else {
  alert ("Silahkan pilih role untuk daftar");
}
}