<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    
 <!-- JavaScript untuk menampilkan alert -->
 <script>
    window.onload = function() {
        // Cek jika ada token yang disertakan di flash session
        @if(session('token'))
            // Simpan token ke localStorage
            localStorage.setItem('auth_token', "{{ session('token') }}");
            console.log("Token saved to localStorage: ", localStorage.getItem('auth_token'));
        @endif
    }
</script>

</head>
<body>
  <!-- Menampilkan Alert jika ada error -->
  @if (session('error'))
  <div class="bg-red-500 text-white p-4 rounded-md mx-5 mt-4 w-full sm:w-1/2 lg:w-1/3">
      <div class="flex items-center justify-between">
          <span>{{ session('error') }}</span>
          <button class="text-white" onclick="this.parentElement.parentElement.style.display='none'">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
          </button>
      </div>
  </div>
@endif


    <div class="box">
        <div class="border-line"></div>
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf <!-- Tambahkan token CSRF -->
            <h2>Login</h2>

            <a href="/register" class="text-xs text-center mb-2 text-blue-400 mt-2"><span class="text-white">Don't have an account yet?, please </span>Sign up</a>

            <div class="input-box">
                <input type="text" name="email" value="{{ old('email') }}" required="required">
                <span>Email</span>
                <i></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" required="required">
                <span>Password</span>
                <i></i>
            </div>

                <input type="submit" value="Login" class="btn">
        </form>
    </div>
</body>
</html>
