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

class PegawaiController extends Controller
{
    public function pegawai_profil() 
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 

        return view('pegawai/profil', compact('user'));
    }

    // Update data profil
    public function pegawai_profilupdate(Request $request)
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
        return redirect()->route('pegawai.profil')->with('success', 'Data profil berhasil diperbarui.');
    }

    public function pegawai_biodata()
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 
        $pegawai = Pegawai::where('user_id', $userId)->first();


        return view('pegawai/biodata', compact('pegawai', 'user'));
    }

    // Method to update the employee data
    public function pegawai_biodataupdate(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:15',
            'divisi' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
        ]);

        // Retrieve the employee data
        $pegawai = Pegawai::find($request->id);

        if (!$pegawai) {
            return redirect()->route('pegawai.biodata')->with('error', 'Pegawai tidak ditemukan.');
        }

        // Update the employee data
        $pegawai->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
            'divisi' => $request->divisi,
            'alamat' => $request->alamat,
        ]);

        // Redirect back with a success message
        return redirect()->route('pegawai.biodata')->with('success', 'Biodata pegawai berhasil diperbarui.');
    }

    public function pegawai_pengajuan()
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 
        $pegawai = Pegawai::where('user_id', $userId)->first();


        return view('pegawai/pengajuan', compact('pegawai', 'user'));
    }

    public function pegawai_pengajuanstore(Request $request)
    {
        // Validasi input
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'tanggal_mulai_cuti' => 'required|date',
            'tanggal_selesai_cuti' => 'required|date|after_or_equal:tanggal_mulai_cuti',
            'tipe_cuti' => 'required|string',
            'alasan_cuti' => 'required|string',
            'lainnya' => 'nullable|string', // Hanya diperlukan jika tipe_cuti adalah "Lainnya"
        ]);

        // Simpan data cuti
        $cuti = new Cuti();
        $cuti->pegawai_id = $request->pegawai_id;
        $cuti->tanggal_mulai_cuti = $request->tanggal_mulai_cuti;
        $cuti->tanggal_selesai_cuti = $request->tanggal_selesai_cuti;
        $cuti->durasi_cuti = $request->durasi_cuti;
        $cuti->tipe_cuti = $request->tipe_cuti;
        $cuti->alasan_cuti = $request->alasan_cuti;

        // Jika tipe_cuti adalah Lainnya, simpan alasan lainnya
        if ($request->tipe_cuti == 'Lainnya') {
            $cuti->tipe_cuti = $request->lainnya;
        }

        $cuti->save();

        return redirect()->route('pegawai.pengajuan')->with('success', 'Pengajuan cuti berhasil diajukan!');
    }

    public function pegawai_riwayat()
{
    $userId = Auth::id();

    // Periksa apakah pengguna sudah login
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Ambil data pengguna
    $user = Auth::user();

    // Ambil ID pegawai berdasarkan user_id
    $pegawaiId = Pegawai::where('user_id', $userId)->pluck('id')->first();

    // Periksa apakah pegawai ditemukan
    if (!$pegawaiId) {
        return redirect()->back()->with('error', 'Data pegawai tidak ditemukan.');
    }

    // Ambil semua riwayat cuti berdasarkan pegawai_id, urutkan berdasarkan created_at secara descending
    $ariwayat = Cuti::where('pegawai_id', $pegawaiId)
        ->orderBy('created_at', 'desc')
        ->get();

    // Kembalikan view dengan data user, pegawai_id, dan riwayat cuti
    return view('pegawai.riwayat', compact('user', 'pegawaiId', 'ariwayat'));
}


}
