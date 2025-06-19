<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Partnership;
use App\Models\Pegawai;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function admin_profil() 
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 

        return view('admin/profil', compact('user'));
    }

    // Update data profil
    public function admin_profilupdate(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',  // Use 'nama' instead of 'name' to match the form input name
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil data user berdasarkan ID
        $user = User::findOrFail($request->id);

        // Buat folder jika belum ada
        $profileFolderPath = public_path('img/profile');
        if (!File::exists($profileFolderPath)) {
            File::makeDirectory($profileFolderPath, 0755, true);
        }

        // Simpan file foto profil jika ada
        $profilePictureName = $user->profile_picture;  // Default to current picture if no new one is uploaded
        if ($request->hasFile('profile_picture')) {
            // Generate a new file name based on the email and name
            $file = $request->file('profile_picture');
            $profilePictureName = strtolower(str_replace(' ', '_', $request->email . '--' . $request->nama)) . '.' . $file->getClientOriginalExtension();
            $file->move($profileFolderPath, $profilePictureName);
        }

        // Update data user
        $user->nama = $request->nama;  // Corrected 'name' to 'nama'
        $user->email = $request->email;
        $user->profile_picture = $profilePictureName;
        $user->save();

        // Kembali ke halaman profil dengan pesan sukses
        return redirect()->route('admin.profil')->with('success', 'Data profil berhasil diperbarui.');
    }

    public function admin_akun() 
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 
        $ausers = User::orderBy('created_at', 'desc')->get();

        return view('admin/akun', compact('user', 'ausers'));
    }



    public function admin_akundestroy($id)
    {
        // Temukan user berdasarkan ID yang diberikan
        $user = User::findOrFail($id);

        // Hapus user
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.akun')->with('success', 'Data user dan semua yang terkait berhasil dihapus.');
    }

    public function admin_akunupdate(Request $request, $id)
    {
        // Validasi input data
        $request->validate([
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|in:Admin,Pegawai',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        // Redirect ke halaman yang sesuai atau memberikan respons sukses
        return redirect()->route('admin.akun')->with('success', 'Akun berhasil diperbarui');
    }

    public function admin_akunstore(Request $request)
    {
        // Validasi input data
        $request->validate([
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|string|in:Admin,Pegawai',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        // Menyimpan data pengguna baru ke dalam database
        User::create([
            'nama' => $request->nama,
            'password' => $request->password,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.akun')->with('success', 'Akun baru berhasil ditambahkan');
    }

    public function admin_pegawai() 
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 
        $ausers = User::orderBy('nama', 'asc')->where('role','Pegawai')->where('status','Active')->get();
        $apegawai = Pegawai::orderBy('created_at', 'desc')->get();

        return view('admin/pegawai', compact('user', 'ausers', 'apegawai'));
    }



    public function admin_pegawaidestroy($id)
    {
        // Temukan user berdasarkan ID yang diberikan
        $pegawai = Pegawai::findOrFail($id);

        // Hapus pegawai
        $pegawai->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.pegawai')->with('success', 'Data pegawai dan semua yang terkait berhasil dihapus.');
    }

    public function admin_pegawaistore(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|string|max:35|unique:pegawai,nip',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:15',
            'divisi' => 'required|string|max:100',
            'alamat' => 'required|string',
            'lama_bekerja' => 'required|integer|min:0',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Simpan data ke database
        Pegawai::create([
            'user_id' => $validated['user_id'],
            'nip' => $validated['nip'],
            'nama' => $validated['nama'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'telepon' => $validated['telepon'],
            'divisi' => $validated['divisi'],
            'alamat' => $validated['alamat'],
            'lama_bekerja' => $validated['lama_bekerja'],
            'status' => $validated['status'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.pegawai')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function admin_pegawaiupdate(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|string|max:35|unique:pegawai,nip',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:15',
            'divisi' => 'required|string|max:100',
            'alamat' => 'required|string',
            'lama_bekerja' => 'required|string|min:0',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Cari data Pegawai berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);

        // Update data Pegawai
        $pegawai->update([
            'user_id' => $request->user_id,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
            'divisi' => $request->divisi,
            'alamat' => $request->alamat,
            'lama_bekerja' => $request->lama_bekerja,
            'status' => $request->status,
        ]);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('admin.pegawai')->with('success', 'Data Pegawai berhasil diperbarui.');
    }

    public function admin_pengajuan() 
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 
        $apegawai = Pegawai::orderBy('nama', 'asc')->get();
        $apengajuan = Cuti::orderBy('created_at', 'desc')->get();

        return view('admin/pengajuan', compact('user', 'apengajuan', 'apegawai'));
    }


    public function admin_pengajuanproses($id)
    {
        // Temukan pengajuan berdasarkan ID yang diberikan
        $pengajuan = Cuti::findOrFail($id);

        // Update status pengajuan menjadi 'Diproses'
        $pengajuan->status_pengajuan = 'Diproses';
        $pengajuan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.pengajuan')->with('success', 'Data pengajuan cuti telah diproses.');
    }

    public function admin_pengajuanterima($id)
    {
        // Temukan pengajuan berdasarkan ID yang diberikan
        $pengajuan = Cuti::findOrFail($id);

        // Update status pengajuan menjadi 'Diproses'
        $pengajuan->status_pengajuan = 'Diterima';
        $pengajuan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.pengajuan')->with('success', 'Data pengajuan cuti telah diterima.');
    }

    public function admin_pengajuantolak($id)
    {
        // Temukan pengajuan berdasarkan ID yang diberikan
        $pengajuan = Cuti::findOrFail($id);

        // Update status pengajuan menjadi 'Diproses'
        $pengajuan->status_pengajuan = 'Ditolak';
        $pengajuan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.pengajuan')->with('success', 'Data pengajuan cuti telah ditolak.');
    }


    public function admin_pengajuandestroy($id)
    {
        // Temukan user berdasarkan ID yang diberikan
        $pengajuan = Cuti::findOrFail($id);

        // Hapus pengajuan
        $pengajuan->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.pengajuan')->with('success', 'Data pengajuan cuti dan semua yang terkait berhasil dihapus.');
    }
}
