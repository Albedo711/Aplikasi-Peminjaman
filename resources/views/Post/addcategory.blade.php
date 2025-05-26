<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Category Form</title>
    <link rel="stylesheet" href="{{ asset('css/add.css') }}"/>
    
</head>
<body>
    <header>
        <a href="dashboard"><button>Kembali</button></a>
    </header>

    <div class="card">
        <div class="card__content">
            <div class="coolinput">
            <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <label class="text">Masukkan Nama Category</label>
                    <input class="input" type="text" name="name" placeholder="Nama Category">
                    <button type="submit">ADD</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
