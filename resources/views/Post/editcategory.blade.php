<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="{{ asset('css/add.css') }}"/>
</head>
<body>
    <header>
        <a href="{{ route('category') }}"><button>Kembali</button></a>
    </header>

    <div class="card">
        <div class="card__content">
            <div class="coolinput">
                <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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

                    <label class="text">Masukkan Nama Category</label>
                    <input class="input" type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Nama Category" required>
                    
                    <button type="submit">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
