<?php
// LOKASI FILE: application/views/templates/header.php
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Judul Halaman Dinamis -->
    <title><?= $judul; ?></title>
    
    <!-- Memuat Bootstrap CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Memuat Font Awesome untuk Ikon (akan berguna nanti) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    
    <!-- CSS Kustom (jika diperlukan) -->
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
<div class="container mt-4">