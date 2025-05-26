<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    background-color: #2b4ec8;
}

        .container {
            width: 80%;
            max-width: 400px;
            height: 100%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        header h1 {
            margin: 0;
        }
        .profile-info {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-bottom: 20px;
        }
        .profile-info img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .profile-info h2 {
            margin: 0;
            font-size: 24px;
        }
        .profile-info p {
            font-size: 16px;
            color: #555;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container a {
            text-decoration: none;
            color: white;
            background-color: #0037ff;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s;
        }
        .button-container a:hover {
            background-color: #0037ff;
        }
        .button-suki{
  width: 80px;
  padding: 10px;
  border: none;
  background-color: #0037ff;
  color: white;
  font-weight: bold;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}
    </style>
</head>
<body>

    <div class="container">
        <a href="dashboard"><button class="button-suki">Kembali</button></a>
        <header>
            
            <h1>Halaman Profil</h1>
        </header>

        <div class="profile-info">
        

<i class="fa fa-user text-gray-500" style="font-size: 64px;"></i>
<br>
           
            <h2>{{ $user->name }}</h2> 
            <p>Role: {{ $user->role }}</p> 
          
        </div>

        <div class="button-container">
            <a href="edit-profile.html">Edit Profil</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

</body>
</html>
