@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="mb-4 text-3xl font-bold">Activity Logs</h1>
        <table class="table table-striped border-collapse w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Petugas</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">aksi</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">deskripsi</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($putra_actifitylog as $putra_log)
                    <tr>
                        <td class="py-2 px-4 border-b-2 border-gray-200">{{ $putra_log->user_type }}</td>
                        <td class="py-2 px-4 border-b-2 border-gray-200">{{ $putra_log->action }}</td>
                        <td class="py-2 px-4 border-b-2 border-gray-200">{{ $putra_log->description }}</td>
                        <td class="py-2 px-4 border-b-2 border-gray-200">{{ $putra_log->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-2 px-4 border-b-2 border-gray-200 text-center">No activity logs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

