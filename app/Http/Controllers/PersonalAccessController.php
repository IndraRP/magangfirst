
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|max:255', // Validasi email
            'password' => 'required|string|max:255', // Validasi password
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Verifikasi password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Your Email or Password is invalid'); // Kirim error jika autentikasi gagal
        }

        // Buat token baru menggunakan Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // Login user
        Auth::login($user);

        // Redirect ke halaman yang diinginkan dengan pesan sukses dan token
        return redirect()->route('home')->with('success', 'Login successful! Token: ' . $token);
    }

    // Logout method
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Menghapus sesi
        $request->session()->regenerateToken(); // Regenerasi token CSRF untuk keamanan

        return redirect()->route('login')->with('success', 'Logout successful');
    }
}
