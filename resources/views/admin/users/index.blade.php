@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="container my-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="section-title mb-1">Kelola User</h2>
            <p class="text-muted mb-0" style="font-size:0.875rem;">Manajemen akun administrator dan pelanggan.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark btn-sm px-3 py-2 rounded-3 fw-semibold">Pesanan</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark btn-sm px-3 py-2 rounded-3 fw-semibold">Produk</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-sm px-3 py-2 rounded-3 fw-semibold">User</a>
        </div>
    </div>

    <div class="card-custom p-0 overflow-hidden">
        <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Daftar User</h5>
            <a href="{{ route('admin.users.create') }}" class="btn-bh-red px-3 py-2 fw-semibold">
                <i class="bi bi-person-plus me-1"></i>Tambah User
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="padding:1rem 1.5rem;">Nama</th>
                        <th>Email</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Terdaftar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td style="padding:1rem 1.5rem;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                        style="width:40px; height:40px; background:#dc3545; flex-shrink:0; font-size:0.875rem;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="fw-semibold" style="font-size:0.9rem;">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td class="text-muted" style="font-size:0.875rem;">{{ $user->email }}</td>
                            <td class="text-center">
                                <span class="badge {{ $user->role === 'admin' ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary' }} px-3 py-1" style="border-radius:20px; font-size:0.75rem; font-weight:600;">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="text-center text-muted" style="font-size:0.8rem;">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px;">Edit</a>
                                    @if($user->id !== Auth::id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;">Hapus</button>
                                        </form>
                                    @else
                                        <span class="text-muted" style="font-size:0.75rem; padding:0.25rem 0.5rem;">Akun Anda</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-5 text-muted">Tidak ada data user.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="p-4 border-top">{{ $users->links() }}</div>
        @endif
    </div>
</div>
@endsection
