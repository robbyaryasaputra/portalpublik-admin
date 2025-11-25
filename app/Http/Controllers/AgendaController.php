<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AgendaController;

class AgendaController extends Controller
{
    /**
     * Menampilkan daftar agenda dengan fitur Search & Filter
     */
    public function index(Request $request)
    {
        // 1. Siapkan data untuk Dropdown Filter (Ambil nama penyelenggara yang unik)
        $penyelenggaraList = Agenda::whereNotNull('penyelenggara')
                                   ->where('penyelenggara', '!=', '')
                                   ->distinct()
                                   ->orderBy('penyelenggara', 'asc')
                                   ->pluck('penyelenggara');

        // 2. Mulai Query Builder
        $query = Agenda::query();

        // 3. Logika Search (Judul atau Lokasi)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // 4. Logika Filter Dropdown (Penyelenggara)
        if ($request->filled('filter_penyelenggara')) {
            $query->where('penyelenggara', $request->input('filter_penyelenggara'));
        }

        // 5. Eksekusi Query dengan Pagination
        // withQueryString() penting agar saat pindah halaman (page 2), filter tidak hilang
        $agendas = $query->orderBy('tanggal_mulai', 'desc')
                         ->paginate(10)
                         ->withQueryString();

        return view('pages.agenda.index', compact('agendas', 'penyelenggaraList'));
    }

    public function create()
    {
        return view('pages.agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi'          => 'nullable|string|max:255',
            'penyelenggara'   => 'nullable|string|max:100',
            'poster'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $agenda = Agenda::create($request->except(['poster']));

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('uploads/agendas', 'public');
            
            Media::create([
                'ref_table' => 'agendas',
                'ref_id'    => $agenda->agenda_id,
                'file_url'  => $path,
                'caption'   => 'poster',
                'mime_type' => $request->file('poster')->getClientMimeType(),
            ]);
        }

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        return view('pages.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'poster'          => 'nullable|image|max:2048',
        ]);

        $agenda->update($request->except(['poster']));

        if ($request->hasFile('poster')) {
            // Hapus poster lama
            $oldMedia = Media::where('ref_table', 'agendas')
                             ->where('ref_id', $agenda->agenda_id)
                             ->where('caption', 'poster')
                             ->first();

            if ($oldMedia) {
                if ($oldMedia->file_url && Storage::disk('public')->exists($oldMedia->file_url)) {
                    Storage::disk('public')->delete($oldMedia->file_url);
                }
                $oldMedia->delete();
            }

            // Upload poster baru
            $path = $request->file('poster')->store('uploads/agendas', 'public');
            Media::create([
                'ref_table' => 'agendas',
                'ref_id'    => $agenda->agenda_id,
                'file_url'  => $path,
                'caption'   => 'poster',
                'mime_type' => $request->file('poster')->getClientMimeType(),
            ]);
        }

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        foreach ($agenda->media as $m) {
            if ($m->file_url && Storage::disk('public')->exists($m->file_url)) {
                Storage::disk('public')->delete($m->file_url);
            }
            $m->delete();
        }

        $agenda->delete();
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}