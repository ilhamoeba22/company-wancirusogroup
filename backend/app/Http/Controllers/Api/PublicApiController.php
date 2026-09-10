<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UnitUsaha;
use App\Models\Sertifikasi;
use App\Models\Berita;
use App\Models\PusatUnduhan;
use App\Models\PengajuanKemitraan;
use Illuminate\Http\Request;

class PublicApiController extends Controller
{
    public function getUnitUsaha()
    {
        $units = UnitUsaha::where('status_publish', true)
            ->orderBy('urutan_tampil', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $units
        ]);
    }

    public function getUnitUsahaBySlug($slug)
    {
        $unit = UnitUsaha::where('slug', $slug)
            ->where('status_publish', true)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $unit
        ]);
    }

    public function getSertifikasi()
    {
        $certs = Sertifikasi::where('tampil_publik', true)->get();

        return response()->json([
            'success' => true,
            'data' => $certs
        ]);
    }

    public function getBerita()
    {
        $news = Berita::where('status_publish', true)
            ->orderBy('tanggal_publish', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }

    public function getBeritaBySlug($slug)
    {
        $article = Berita::where('slug', $slug)
            ->where('status_publish', true)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }

    public function getPusatUnduhan()
    {
        $docs = PusatUnduhan::where('status_publish', true)->get();

        return response()->json([
            'success' => true,
            'data' => $docs
        ]);
    }

    public function storeKemitraan(Request $request)
    {
        $validated = $request->validate([
            'nama_pengirim' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:50',
            'unit_usaha_dituju' => 'nullable|string|max:255',
            'pesan' => 'required|string',
        ]);

        $submission = PengajuanKemitraan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan kemitraan berhasil dikirim.',
            'data' => $submission
        ], 201);
    }
}
