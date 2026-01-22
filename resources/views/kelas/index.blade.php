@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
<div class="content-header">
    <h1>Data Kelas</h1>
    
    @if(session('petugas')->level == 'admin')
    <a href="{{ route('kelas.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Tambah Kelas
    </a>
    @endif
</div>

@if(session('success'))
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <i class="fas fa-exclamation-circle"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

<div class="card">
    <div class="card-body">
        <!-- Search Box -->
        <div class="search-box">
            <form action="{{ route('kelas.index') }}" method="GET">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon"></i>
                    <input 
                        type="text" 
                        name="search" 
                        class="search-input" 
                        placeholder="Cari berdasarkan Nama Kelas atau Kompetensi Keahlian..."
                        value="{{ request('search') }}"
                    >
                    <div class="search-buttons">
                        @if(request('search'))
                        <a href="{{ route('kelas.index') }}" class="btn-clear" title="Hapus Pencarian">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                        <button type="submit" class="btn-search">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Kompetensi Keahlian</th>
                        <th>Jumlah Siswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_kelas }}</td>
                        <td>{{ $item->kompetensi_keahlian }}</td>
                        <td>{{ $item->siswa_count }} siswa</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('kelas.show', $item->id_kelas) }}" class="btn-view">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                
                                @if(session('petugas')->level == 'admin')
                                <a href="{{ route('kelas.edit', $item->id_kelas) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('kelas.destroy', $item->id_kelas) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            @if(request('search'))
                                <div style="padding: 20px;">
                                    <i class="fas fa-search" style="font-size: 48px; color: #bdc3c7; margin-bottom: 10px;"></i>
                                    <p style="color: #7f8c8d; font-size: 16px;">Tidak ada hasil untuk pencarian "<strong>{{ request('search') }}</strong>"</p>
                                    <a href="{{ route('kelas.index') }}" class="btn-search" style="display: inline-block; margin-top: 10px;">
                                        <i class="fas fa-arrow-left"></i> Kembali ke Semua Data
                                    </a>
                                </div>
                            @else
                                <div style="padding: 20px;">
                                    <i class="fas fa-inbox" style="font-size: 48px; color: #bdc3c7; margin-bottom: 10px;"></i>
                                    <p style="color: #7f8c8d; font-size: 16px;">Belum ada data kelas</p>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Search Box Styles */
    .search-box {
        margin-bottom: 24px;
        padding: 20px;
        background: #f8fdf9;
        border-radius: 12px;
        border: 1px solid #e8f5e9;
    }

    .search-input-group {
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        max-width: 800px;
    }

    .search-icon {
        position: absolute;
        left: 16px;
        color: #95a5a6;
        font-size: 16px;
        z-index: 1;
    }

    .search-input {
        flex: 1;
        padding: 12px 16px 12px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
    }

    .search-input:focus {
        outline: none;
        border-color: #52be80;
        box-shadow: 0 0 0 3px rgba(82, 190, 128, 0.1);
    }

    .search-input::placeholder {
        color: #bdc3c7;
    }

    .search-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-search {
        padding: 12px 24px;
        background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .btn-search:hover {
        background: linear-gradient(135deg, #27ae60 0%, #1e8449 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(82, 190, 128, 0.3);
    }

    .btn-search:active {
        transform: translateY(0);
    }

    .btn-clear {
        padding: 10px 14px;
        background: #e74c3c;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .btn-clear:hover {
        background: #c0392b;
        transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .search-input-group {
            flex-direction: column;
        }

        .search-input {
            width: 100%;
        }

        .search-buttons {
            width: 100%;
            justify-content: stretch;
        }

        .btn-search,
        .btn-clear {
            flex: 1;
            justify-content: center;
        }
    }
</style>
@endsection