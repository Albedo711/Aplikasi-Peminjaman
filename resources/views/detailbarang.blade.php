<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SISFO - BARANG</title>
  <link rel="stylesheet" href="{{ asset('css/itemdetail.css') }}"/>

 
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
        <h1>BARANG</h1>
        
        
        <a href="profile">
        <div class="profile-icon">
          <iconify-icon icon="mdi:account-circle-outline"></iconify-icon>
        </div>
        </a>

      </header>

     
     <div class="suki">
  <div class="image">
    <img src="{{ asset('storage/'.$item->foto_barang) }}" alt="{{ $item->nama }}">
  </div>
  <div class="keterangan">
    <h2>{{ $item->nama }}</h2>
    <p>Status : {{ $item->status }}</p>
    <p>Brand : {{ $item->brand }}</p>
    <p>Deskripsi : {{ $item->deskripsi }}</p>
    <a href="{{ route('index') }}">Kembali</a>
  </div>
</div>


    </main>
  </div>

  
</body>
</html>
