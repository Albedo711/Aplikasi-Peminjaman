<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - SISFO SAPRAS</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <iframe src="https://my.spline.design/3dtextbluecopy-f3MdOKrLAgnLwY69KoO7LxAL/" frameborder="0" width="100%" height="100%"></iframe>
    </div>
    <div class="right-panel">
      <h2>Hello, Welcome!</h2>
      <h3>Register</h3>

      <form action="{{ route('register') }}" method="POST">
        @csrf

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

        <label for="name">Username</label>
        <input name="name" type="text" placeholder="Username" required>

        <label for="password">Password</label>
        <div class="password-field">
          <input type="password" placeholder="Password" name="password" id="password" required>
          <iconify-icon icon="mdi:eye-off" id="togglePassword" class="toggle-password"></iconify-icon>
        </div>

        <label for="role">Pilih Role</label>
        <select id="role" name="role" class="enum-select" onchange="toggleUserFields()">
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>

        <div id="user-fields" style="display: none;">
          <label for="kelas">Pilih Kelas</label>
          <select id="kelas" name="kelas" class="enum-select">
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
          </select>

          <label for="jurusan">Pilih Jurusan</label>
          <select id="jurusan" name="jurusan" class="enum-select">
            <option value="RPL">RPL</option>
            <option value="PSPT">PSPT</option>
            <option value="Animasi">Animasi</option>
            <option value="TJKT">TJKT</option>
            <option value="TE">TE</option>
          </select>
        </div>
        
        <button type="submit">Register</button>
      </form>

      <p class="signup">Already have an account? <a href="login">Sign in</a></p>
    </div>
  </div>

  <script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);

      this.setAttribute('icon', type === 'password' ? 'mdi:eye-off' : 'mdi:eye');
    });

    function toggleUserFields() {
      const role = document.getElementById("role").value;
      const userFields = document.getElementById("user-fields");
      userFields.style.display = (role === "user") ? "block" : "none";
    }

    window.addEventListener('DOMContentLoaded', toggleUserFields);
  </script>
</body>
</html>
