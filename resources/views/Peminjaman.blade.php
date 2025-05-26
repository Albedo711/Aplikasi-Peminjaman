<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SISFO - PEMINJAMAN</title>
  <link rel="stylesheet" href="{{ asset('css/category.css') }}"/>


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
</aside>


    <main class="main">
      <header class="header">
        <h1>PEMINJAMAN</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        

        <a href="profile">
        <div class="profile-icon">
          <iconify-icon icon="mdi:account-circle-outline"></iconify-icon>
        </div>
        </a>
      </header>

      <section class="suki">
 

  <section class="latest">
    <h3>List - Peminjman</h3>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Nama Barang</th>
          <th>Jumlah</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Dikembalikan</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
@foreach ($peminjaman as $pinjam )
  <tr>
    <td>{{ $pinjam->id }}</td>
    
    <td>{{ $pinjam->user->name }}</td>

    <td>
      @foreach ($pinjam->detailPeminjaman as $detail)
        {{ $detail->barang->nama_barang }}<br>
      @endforeach
    </td>

    <td>
      @foreach ($pinjam->detailPeminjaman as $detail)
        {{ $detail->jumlah }}<br>
      @endforeach
    </td>

    <td>{{ $pinjam->tanggal_pinjam }}</td>
    <td>{{ $pinjam->waktu_tenggat }}</td>
    <td 
    @if ($pinjam->status == 'Diterima')
    style="color: green;"

    @elseif ($pinjam->status == 'Ditolak')
    style="color: red;"

    @else
    style="color: blue;"
    
    @endif
    >{{ $pinjam->status }}</td>

    <td class="terima-suki">
      @if ($pinjam->status == 'Ditinjau')
        <form action="{{ route('terima', $pinjam->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-edit">Terima</button> 
      </form>
      
       <form action="{{ route('tolak',$pinjam->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-delete">Tolak</button>
      </form>

      @elseif ($pinjam->status == 'Diterima')
      <span style="color: green">Sudah diterima</span>

      @else 
      <span style="color: red">Sudah ditolak</span>
      
      @endif
      
    </td>
  </tr>
@endforeach
</tbody>

    </table>
  </section>
</section>

      
    </main>
  </div>

  <script>
     setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); 
        });
    }, 3000);
  </script>
</body>
</html>
