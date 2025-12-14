<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil list penyelenggara unik untuk filter
        $penyelenggaraList = Agenda::whereNotNull('penyelenggara')
                                   ->distinct()
                                   ->orderBy('penyelenggara', 'asc')
                                   ->pluck('penyelenggara');

        $query = Agenda::query();

        // Search Judul / Lokasi
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter Penyelenggara
        if ($request->filled('filter_penyelenggara')) {
            $query->where('penyelenggara', $request->input('filter_penyelenggara'));
        }

        $agendas = $query->orderBy('tanggal_mulai', 'desc')
                         ->paginate(30)
                         ->withQueryString();

        return view('pages.agenda.index', compact('agendas', 'penyelenggaraList'));
    }

    public function create()
    {
        return view('pages.agenda.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'             => 'required|string|max:255',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi'            => 'nullable|string|max:255',
            'penyelenggara'     => 'nullable|string|max:255',
            'deskripsi'         => 'nullable|string',
            'poster'            => 'nullable|image|max:2048',
        ]);

        // Simpan Data Teks
        $agenda = Agenda::create(collect($data)->except(['poster'])->toArray());

        // Simpan Poster
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

    // --- METHOD SHOW (BARU) ---
    public function show($id)
    {
        $agenda = Agenda::with('media')->findOrFail($id);
        return view('pages.agenda.show', compact('agenda'));
    }

    public function edit($id)
    {
        $agenda = Agenda::with('media')->findOrFail($id);
        return view('pages.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $data = $request->validate([
            'judul'             => 'required|string|max:255',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi'            => 'nullable|string|max:255',
            'penyelenggara'     => 'nullable|string|max:255',
            'deskripsi'         => 'nullable|string',
            'poster'            => 'nullable|image|max:2048',
        ]);

        $agenda->update(collect($data)->except(['poster'])->toArray());

        if ($request->hasFile('poster')) {
            // Hapus Poster Lama
            $oldMedia = $agenda->media()->where('caption', 'poster')->first();
            if ($oldMedia) {
                if (Storage::disk('public')->exists($oldMedia->file_url)) {
                    Storage::disk('public')->delete($oldMedia->file_url);
                }
                $oldMedia->delete();
            }

            // Upload Baru
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

    public function destroy($id)
    {
        $agenda = Agenda::with('media')->findOrFail($id);
        
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