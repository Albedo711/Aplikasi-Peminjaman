<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SISFO - PENGEMBALIAN</title>
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
     
<div id="imageModal" style="display:none; position:fixed; z-index:999; left:0; top:0; width:100%; height:100%; background-color: rgba(255, 255, 255, 0.5);">
  <div style="margin:5% auto; padding:20px; background:#fff; width:fit-content; position:relative;">
    <span onclick="document.getElementById('imageModal').style.display='none'" 
          style="position:absolute; top:10px; right:20px; cursor:pointer; font-size:50px; color:red">&times;</span>
    <img id="modalImage" src="" alt="Foto Barang" style="max-width:500px; max-height:500px;">
  </div>
</div>

      <header class="header">
        <h1>PENGEMBALIAN</h1>
        

        <a href="profile">
        <div class="profile-icon">
          <iconify-icon icon="mdi:account-circle-outline"></iconify-icon>
        </div>
        </a>
      </header>

      <section class="suki">
 

  <section class="latest">
    <h3>List - Pengembalian</h3>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Nama Barang</th>
          <th>Foto Barang</th>
          <th>Jumlah</th>
          <th>Keterangan</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Dikembalikan</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pengembalian as $kembali )
<tr>
  <td>{{ $kembali->id }}</td>
  <td>{{ $kembali->detailpeminjaman->peminjaman->user->name ?? 'Tidak ada' }}</td>
  <td>{{ $kembali->detailpeminjaman->barang->nama_barang ?? 'Tidak ada' }}</td>
  <td>
    <button onclick="showImageModal('{{ Storage::url($kembali->foto) }}')">
      Periksa Foto Barang
    </button>
  </td>
  <td>{{ $kembali->detailpeminjaman->jumlah }}</td>
  <td>{{ $kembali->keterangan }}</td>
  <td>{{ $kembali->detailpeminjaman->peminjaman->tanggal_pinjam }}</td>
  <td>{{ $kembali->tanggal_dikembalikan }}</td>
  <td
    @if ($kembali->status == 'Disetujui') style="color: green;"
    @elseif ($kembali->status == 'Ditolak') style="color: red;"
    @else style="color: blue;" @endif
  >{{ $kembali->status }}</td>
  <td class="terima-suki">
    @if ($kembali->status == 'Ditinjau')
      <form action="{{ route('terima.pengembalian', $kembali->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-edit">Terima</button>
      </form>
      <form action="{{ route('tolak.pengembalian', $kembali->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-delete">Tolak</button>
      </form>
    @elseif ($kembali->status == 'Disetujui')
      <span style="color: green">Sudah Disetujui</span>
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
function showImageModal(src) {
  document.getElementById("modalImage").src = src;
  document.getElementById("imageModal").style.display = "block";
}
</script>

</body>
</html>
