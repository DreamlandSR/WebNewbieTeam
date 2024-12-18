//dropdown pada sidebbar
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

//dropdown pada tugas
function dropdown() {
  const dropdownMenu = document.getElementById('dropdownOptions');
  dropdownMenu.classList.toggle('show');
}

// Menutup dropdown saat klik di luar elemen
document.addEventListener('click', function (event) {
  const isClickInside = document.getElementById('uploadMateriButton').contains(event.target);
  const dropdownMenu = document.getElementById('dropdownOptions');

  if (!isClickInside && dropdownMenu.classList.contains('show')) {
    dropdownMenu.classList.remove('show');
  }
});


//pada saat content sidebar menghilang atau tidak
document.addEventListener('DOMContentLoaded', () => {
  const menuIcon = document.querySelector('.header .menu-icon');
  const sidebar = document.querySelector('.sidebar');
  const aside = document.querySelector('.aside');
  const content = document.querySelector('.content');
  const container = document.querySelector('.container');
  const footer = document.querySelector('.footer');
  const registerBox = document.querySelector('.register-box');  // Perbaikan selector
  console.log(menuIcon, sidebar, aside, content, container, footer, registerBox);
  
  menuIcon.addEventListener('click', () => {
    // Toggle kelas untuk sidebar dan konten
    sidebar.classList.toggle('active');
    sidebar.classList.toggle('sidebar-expanded');
    content.classList.toggle('sidebar-expanded-content'); 
    container.classList.toggle('sidebar-expanded-container');
    aside.classList.toggle('aside-expanded');
    content.classList.toggle('aside-expanded-content'); 
    container.classList.toggle('aside-expanded-container');
    footer.classList.toggle('footer-active'); 
    registerBox.classList.toggle('register-box');  // Perbaikan selector
  });
});

//option value daftar
// Fungsi untuk memperbarui nilai role_user di input hidden berdasarkan pilihan dropdown
function updateRoleUser() {
  const roleSelect = document.getElementById("role");
  const selectedRole = roleSelect.value;
  const roleUserInput = document.getElementById("roleUser");

  // Update value input hidden dengan nilai role yang dipilih
  roleUserInput.value = selectedRole;
}

// Fungsi untuk menangani redirect berdasarkan role yang dipilih
function redirectToRolePage(event) {
  event.preventDefault(); // Mencegah pengiriman formulir langsung

  const selectedRole = document.getElementById("role").value;
  const roleUserInput = document.getElementById("roleUser");

  // Pastikan role dipilih, jika tidak beri peringatan
  if (!selectedRole) {
      alert("Silakan pilih role terlebih dahulu!");
      return;
  }

  // Update nilai roleUserInput untuk memastikan data terkirim
  roleUserInput.value = selectedRole;

  // Redirect berdasarkan role yang dipilih
  if (selectedRole === "admin") {
      window.location.href = "daftaradmin.php?role=" + selectedRole;
  } else if (selectedRole === "guru") {
      window.location.href = "daftarguru.php?role=" + selectedRole; // Halaman daftar untuk guru
  } else if (selectedRole === "siswa") {
      window.location.href = "daftarsiswa.php?role=" + selectedRole; // Halaman daftar untuk siswa
  }
}


document.addEventListener("DOMContentLoaded", function() {
  const fadeInElements = document.querySelectorAll(".fade-in");

  function checkVisibility() {
      const windowHeight = window.innerHeight;

      fadeInElements.forEach((el) => {
          const elementTop = el.getBoundingClientRect().top;

          if (elementTop < windowHeight - 50) {
              el.classList.add("visible");
          }
      });
  }

  let isScrolling = false;
  window.addEventListener("scroll", function() {
      if (!isScrolling) {
          isScrolling = true;
          window.requestAnimationFrame(function() {
              checkVisibility();
              isScrolling = false;
          });
      }
  });

  checkVisibility(); // Memanggil saat pertama kali untuk memuat elemen yang sudah terlihat
});


//kalender
function updateCalendar() {
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    window.location.href = "?month=" + month + "&year=" + year;
}


//show password and hide
function togglePassword() {
  var passwordField = document.getElementById("password");
  var showPasswordText = document.querySelector(".show-password");

  if (passwordField.type === "password") {
      passwordField.type = "text";
      showPasswordText.textContent = "Hide"; // Ubah teks tombol menjadi "Hide"
  } else {
      passwordField.type = "password";
      showPasswordText.textContent = "Show"; // Ubah teks tombol kembali menjadi "Show"
  }
}