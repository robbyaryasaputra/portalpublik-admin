<!--
  Partial: layouts.admin.css
-->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets-admin/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('/assets-admin/img/favicon.png') }}">
  <title>
    Material Dashboard 2 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('/assets-admin/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('/assets-admin/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('/assets-admin/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
  <!-- Custom tweaks untuk memperbagus tampilan kecil -->
  <style>
    /* Lebarkan sedikit sidebar dan tambahkan transition */
    .sidenav {
      width: 240px;
      transition: width .2s ease;
    }
    .sidenav .nav-link.active {
      border-radius: 12px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    }
    /* Tombol aksi di tabel jadi sedikit lebih konsisten */
    .btn-action {
      padding: .45rem .7rem;
      border-radius: .65rem;
      font-size: .78rem;
      box-shadow: none;
    }
    /* Perbaikan spasi judul halaman */
    .page-title-custom { font-size: 1.6rem; font-weight:700; }

    /* == CSS DIPINDAHKAN DARI KATEGORI-BERITA/CREATE & EDIT == */
    .form-panel { background: #fff; border-radius: 12px; padding: 1.25rem; }
    .form-panel .form-group label { display:block; margin-bottom:.5rem; font-weight:600; color:#334155; }
    .form-panel .form-control { border-radius:8px; background:#f6f9fb; border:1px solid #e6eef5; padding:.65rem .9rem; color:#0f172a; }
    .form-panel .form-control::placeholder { color:#94a3b8; font-style:italic; }
    .form-panel .form-control:focus { border-color:#c7e3ff; box-shadow:0 6px 18px rgba(14,165,233,0.06); background:#fff; }
    .form-panel .btn-primary { background:#e91e63 !important; border-color:#e91e63 !important; color:#fff !important; border-radius:10px; box-shadow:0 8px 20px rgba(233,30,99,0.14); }
    .form-panel .btn-secondary { background:#374151 !important; border-color:#374151 !important; color:#fff !important; border-radius:10px; }
    .form-panel .btn-action { padding:.6rem 1rem; border-radius:.85rem; }
    /* == AKHIR CSS YANG DIPINDAHKAN == */

    /* == CSS DIPINDAHKAN DARI PROFIL/CREATE & EDIT == */
    /* Styling khusus untuk form Profil */
    .profil-form .form-control {
      background: #fff;
      border: 1px solid #e6e6e6;
      padding: .6rem .75rem;
      border-radius: .5rem;
      box-shadow: 0 1px 2px rgba(16,24,40,0.04);
    }
    .profil-form .form-label {
      color: #6b7280;
      font-weight: 600;
      margin-bottom: .5rem;
    }
    .profil-form .mb-3 { padding: .5rem; }
    .profil-form { background: #f8fafc; padding: 1rem; border-radius: .6rem; }
    /* Style untuk placeholder agar lebih menarik */
    .profil-form .form-control::placeholder {
      color: #a0aec0; /* Warna abu-abu lembut */
      font-style: italic;
      opacity: 1;
    }
    /* == AKHIR CSS YANG DIPINDAHKAN == */

    /* == CSS DIPINDAHKAN DARI USER/CREATE & EDIT == */
    .form-dark-pink {
        /* Tidak ada style khusus di sini, hanya untuk targetting */
    }
    /* Mengubah style label */
    .form-dark-pink .form-group label {
        color: #000000; /* Teks hitam */
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
    }
    /* Style utama untuk input */
    .form-dark-pink .form-control {
        background-color: #374151; /* Latar belakang input abu-abu gelap */
        color: #f9fafb; /* Teks input putih */
        border: 1px solid #4b5563; /* Border abu-abu */
        border-radius: 8px; /* Sudut lebih bulat */
        padding: 0.8rem 1rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    /* Placeholder style */
    .form-dark-pink .form-control::placeholder {
        color: #9ca3af; /* Placeholder abu-abu */
        font-style: italic;
        opacity: 1;
    }
    /* [PENTING] Efek FOKUS (saat mengisi) */
    .form-dark-pink .form-control:focus {
        background-color: #374151; /* Tetap gelap */
        color: #f9fafb; /* Tetap putih */
        border-color: #e91e63; /* [PINK] Border pink */
        outline: none;
        /* [PINK] Efek 'glow' pink */
        box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.3);
    }
    /* Mengubah style tombol primary (Simpan/Update) */
    .form-dark-pink .btn-primary {
        background-color: #e91e63;
        border-color: #e91e63;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(233, 30, 99, 0.2);
        transition: background-color 0.2s, transform 0.2s;
    }
    .form-dark-pink .btn-primary:hover {
        background-color: #c2185b; /* Pink lebih gelap */
        border-color: #c2185b;
        transform: translateY(-2px);
    }
    /* Style tombol secondary (Batal) */
    .form-dark-pink .btn-secondary {
        background-color: #4b5563;
        border-color: #4b5563;
        color: #f9fafb;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
    }
    .form-dark-pink .btn-secondary:hover {
        background-color: #6b7280;
        border-color: #6b7280;
        color: #f9fafb;
    }
    /* == AKHIR CSS YANG DIPINDAHKAN == */

    /* == CSS DIPINDAHKAN DARI WARGA/CREATE & EDIT == */
    /* Styling khusus untuk form Warga (Light Mode) */
    .warga-form .form-control, .warga-form .form-select {
      background: #fff;
      border: 1px solid #e6e6e6;
      padding: .6rem .75rem;
      border-radius: .5rem;
      box-shadow: 0 1px 2px rgba(16,24,40,0.04);
    }
    .warga-form .form-label {
      color: #6b7280;
      font-weight: 600;
      margin-bottom: .5rem;
    }
    .warga-form .mb-3 { padding: .5rem; }
    .warga-form { background: #f8fafc; padding: 1rem; border-radius: .6rem; }

    /* Style untuk placeholder */
    .warga-form .form-control::placeholder {
      color: #a0aec0;
      font-style: italic;
      opacity: 1;
    }
    .warga-form .form-select option[value=""] {
      color: #a0aec0;
      font-style: italic;
    }
    /* == AKHIR CSS YANG DIPINDAHKAN == */
  /* detail berita */
  .img-hover-zoom:hover {
        transform: scale(1.1); /* Gambar membesar 10% */
        filter: brightness(0.8); /* Gambar agak gelap sedikit agar efeknya terasa */
        cursor: pointer;
    }

    /* Memastikan link pembungkus memotong gambar yang membesar */
    .overflow-hidden {
        overflow: hidden !important;
    }
    
    .hover-zoom:hover {
        transform: scale(1.03); /* Zoom halus 3% */
        filter: brightness(0.9); /* Sedikit menggelap agar kontras */
        cursor: pointer;
    }
    
    /* Mencegah gambar keluar dari border radius saat membesar */
    .overflow-hidden {
        overflow: hidden !important;
    }

  </style>
