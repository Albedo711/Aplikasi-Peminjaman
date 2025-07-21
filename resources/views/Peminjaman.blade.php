<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>SISFO - PEMINJAMAN</title>

  <link rel="stylesheet" href="//cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css" />
  <style>
     .top .dt-buttons,
.top .dataTables_length,
.top .dataTables_filter {
  margin-bottom: 30px;
}

.bottom .dataTables_info,
.bottom .dataTables_paginate {
  margin-top: 100px;
}
  </style>

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.0/css/buttons.dataTables.min.css">
  
  <link rel="stylesheet" href="{{ asset('css/category.css') }}" />

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="//cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>

  
  <script src="https://cdn.datatables.net/buttons/2.3.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.print.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/pdfmake.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

  <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <a href="dashboard"><div class="sidebar-icon"><iconify-icon icon="mdi:view-dashboard-outline"></iconify-icon></div></a>
      <a href="barang"><div class="sidebar-icon"><iconify-icon icon="ph:package"></iconify-icon></div></a>
      <a href="category"><div class="sidebar-icon"><iconify-icon icon="mdi:tag-outline"></iconify-icon></div></a>
      <a href="peminjaman"><div class="sidebar-icon active"><iconify-icon icon="mdi:arrow-up-bold-circle"></iconify-icon></div></a>
      <a href="pengembalian"><div class="sidebar-icon"><iconify-icon icon="mdi:arrow-down-bold-circle"></iconify-icon></div></a>
      <a href="user">
    <div class="sidebar-icon"><iconify-icon icon="mdi:person"></iconify-icon></div>
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
          <h3>List - Peminjaman</h3>
          <div class="table-responsive">
            <table id="peminjamanTable" class="display">
              <thead>
                <tr>
                   <th>ID</th>
                   <th>Nama</th>
                   <th>Nama Barang</th>
                   <th>Jumlah</th>
                   <th>Keterangan</th>
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
                     <td>@foreach ($pinjam->detailPeminjaman as $detail)
                         {{ $detail->user->name }}<br>
                       @endforeach</td>
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
                     <td>{{ $pinjam->keterangan }}</td>
                     <td>{{ $pinjam->tanggal_pinjam }}</td>
                     <td>{{ $pinjam->waktu_tenggat }}</td>
                     <td 
                       @if ($pinjam->status == 'Diterima') style="color: green;" 
                       @elseif ($pinjam->status == 'Ditolak') style="color: red;" 
                       @else style="color: blue;" @endif>{{ $pinjam->status }}</td>
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
          </div>
        </section>
      </section>
    </main>
  </div>

  <script>
  $(document).ready(function() {
    var table = $('#peminjamanTable').DataTable({ 
      responsive: true,
      dom: "<'top'Blf>rt<'bottom'ip>",
      buttons:['copy','excel', 'print'],
      language: {
        search: "Cari",
        lengthMenu: "Tampilkan _MENU_ entri",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
        infoFiltered: "(disaring dari _MAX_ entri keseluruhan)", 
        paginate: { first: "Pertama", previous: "Sebelumnya", next: "Selanjutnya", last: "Terakhir" }
      }
    });

    setTimeout(function(){
      $('.alert').fadeOut(500, function(){
        $(this).remove();
      });
    }, 3000);
  });

  
</script>
</body>
</html>
