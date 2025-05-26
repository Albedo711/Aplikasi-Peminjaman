<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SISFO - BARANG</title>
  <link rel="stylesheet" href="{{ asset('css/item.css') }}"/>

 
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
        <h1>BARANG</h1>
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

      <nav class="suki_nav">
        
<select id="category" name="category" class="custom-select">

        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
 
</select>

<a href="create"><button class="button">Tambah Barang</button></a>

<div class="search">
        <input id="searchInput" placeholder="Search..." type="text">
        <button id="searchButton" type="submit">Go</button>
    </div>


      </nav>
      <div class="suki">
      <section class="latest">
      @foreach ($barang as $item)
<div class="card" data-nama="{{ $item->nama_barang }}">
    <div class="image">
        <img src="{{ Storage::url($item->foto_barang) }}" alt="{{ $item->nama_barang }}">
    </div>
    <div class="keterangan"><span class="title">{{ $item->nama_barang }}</span>
    <span class="price">{{ $item->status }}</span></div>
    

    
    <div class="card-button">
<a href="{{ route('barang.edit', $item->id_barang) }}"><button class="btn-edit">Edit</button></a>
      <form action="{{ route('destroy', $item->id_barang) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete" type="submit" onclick="return confirm('Yakin ingin menghapus Barang ini?')">
                      Hapus
                    </button>
                  </form>
    </div>
</div>
@endforeach
      </section>
      </div>

    </main>
  </div>

  <script>
     setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); 
        });
    }, 3000);


 document.getElementById('searchButton').addEventListener('click', function(e){
  e.preventDefault();  
  const keyword = document.getElementById('searchInput').value.toLowerCase();

  const cards = document.querySelectorAll('.latest .card');
  cards.forEach(card => {
    const nama = card.getAttribute('data-nama').toLowerCase();
    if(nama.includes(keyword)){
      card.style.display = 'flex';  
    } else {
      card.style.display = 'none';  
    }
  });
});


    // Optional: Search ketika Enter ditekan
    document.getElementById('searchInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            document.getElementById('searchButton').click();
        }
    });


  </script>
</body>
</html>
