<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "POST request berhasil diterima!";
} else {
    echo "Request bukan POST.";
}
?>
