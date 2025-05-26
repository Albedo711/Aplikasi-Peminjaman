<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SISFO - CATEGORY</title>
  
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="//cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css"/>
  <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
  <script src="//cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/category.css') }}"/>
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
        <h1>CATEGORY</h1>
        
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
        <div class="button-wrapper">
          <a href="addcategory"><button class="Button-suki">ADD</button></a>
        </div>
        <section class="latest">
        <h3>List - Category</h3>
        <div class="table-responsive">
          <table id="myTable" class="display">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                  @if(auth()->check() && auth()->user()->role === 'admin')
                  <a href="{{ route('category.edit', $category->id) }}">
                    <button class="btn-edit">Edit</button>
                  </a>
                  

                  <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus kategori ini?')" class="btn-delete">
                      Hapus
                    </button>
                  </form>
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
      $('#myTable').DataTable({
        responsive: true,
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ entri",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
          infoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
          paginate: {
            first: "Pertama",
            previous: "Sebelumnya",
            next: "Selanjutnya",
            last: "Terakhir"
          }
        }
      });
    });

    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); 
        });
    }, 3000);
  </script>
</body>
</html>