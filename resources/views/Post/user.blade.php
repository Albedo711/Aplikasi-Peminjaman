<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <style>
        body {
            font-family:'Arial', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #2b4ec8;
        }
        form {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px 2px #0003;
            max-width: 400px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            padding: 10px 20px;
            background: #2b4ec8;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
       
        ul {
            color: red;
            margin-bottom: 20px;
        }
        p {
            
            margin-bottom: 20px;
        }
        .back {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .back a {
            padding: 10px 20px;
            background: #2b4ec8;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
        }
       
    </style>
</head>
<body>
    <h1>Tambah User</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any()) 
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <label for="name">Username</label>
        <input id="name" name="name" type="text" required>

        <label for="password"> Password</label>
        <input id="password" name="password" type="password" required>

        <label for="role"> Role</label>
        <select id="role" name="role" required onchange="toggleUserFields(this.value)"> 
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>

        <div id="user-fields" style="display: none">
            <label for="kelas">Kelas</label>
            <select id="kelas" name="kelas">
                <option value="">-- Pilih Kelas --</option>
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
            </select>

            <label for="jurusan">Jurusan</label>
            <select id="jurusan" name="jurusan">
                <option value="">-- Pilih Jurusan --</option>
                <option value="RPL">RPL</option>
                <option value="PSPT">PSPT</option>
                <option value="ANIMASI">ANIMASI</option>
                <option value="TJKT">TJKT</option>
                <option value="TE">TE</option>
            </select>
        </div>

        <br>

        <button type="submit">Simpan</button>
    </form>

    <div class="back">
        <a href="{{ route('dashboard') }}">Back</a>
    </div>

    <script>
        function toggleUserFields(role) {
            document.getElementById('user-fields').style.display = role === 'user' ? 'block' : 'none';
        }
    </script>

</body>
</html>
