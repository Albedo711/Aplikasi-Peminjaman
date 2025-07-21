<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SISFO - DASHBOARD</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"/>


  <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
</head>
<body>
  <div class="container">
  <aside class="sidebar">
  <a href="dashboard">
    <div class="sidebar-icon active"><iconify-icon icon="mdi:view-dashboard-outline"></iconify-icon></div>
  </a>
  <a href="barang">
    <div class="sidebar-icon"><iconify-icon icon="ph:package"></iconify-icon></div>
  </a>
  <a href="category">
    <div class="sidebar-icon"><iconify-icon icon="mdi:tag-outline"></iconify-icon></div>
  </a>
  <a href="peminjaman">
    <div class="sidebar-icon"><iconify-icon icon="mdi:arrow-up-bold-circle"></iconify-icon></div>
  </a>
  <a href="pengembalian">
    <div class="sidebar-icon"><iconify-icon icon="mdi:arrow-down-bold-circle"></iconify-icon></div>
  </a>
  <a href="user">
    <div class="sidebar-icon"><iconify-icon icon="mdi:person"></iconify-icon></div>
  </a>
</aside>


    <main class="main">
      <header class="header">
        <h1>DASHBOARD</h1>
        <h1>Selamat datang, {{ $user->name }}</h1>


        
    
        <a href="{{ route('profile') }}">
        <div class="profile-icon">
          <iconify-icon icon="mdi:account-circle-outline"></iconify-icon>
        </div>
        </a>
      </header>

        <section class="suki">
        <section class="stats">
          <div class="card">
            <h3>Total Peminjam</h3>
            <p class="stat-number">{{ $jumlahpinjam }} <iconify-icon icon="mdi:arrow-up-bold-circle"></iconify-icon></p>
          </div>
          <div class="card">
            <h3>Total Pengembalian</h3>
            <p class="stat-number">{{ $jumlahkembali }} <iconify-icon icon="mdi:arrow-down-bold-circle"></iconify-icon></p>
          </div>
        </section>
        <section class="stats">
          <div class="card">
            <h3>Total Category</h3>
            <p class="stat-number">{{ $jumlahcategory }} <iconify-icon icon="mdi:tag-outline"></iconify-icon></p>
          </div>
          <div class="card">
            <h3>Total Barang</h3>
            <p class="stat-number">{{ $jumlahBarang }} <iconify-icon icon="ph:package"></iconify-icon></p>
        </div>
      </section>

      
      </section>
      
    </main>
  </div>
</body>
</html>
