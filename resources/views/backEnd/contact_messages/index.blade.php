@extends('backEnd.layouts.master')
@section('title', 'Contact Messages')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Contact Messages</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $m)
                            <tr class="{{ $m->is_read ? '' : 'table-warning fw-bold' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->email }}</td>
                                <td>{{ $m->phone }}</td>
                                <td>{{ \Str::limit($m->subject, 40) }}</td>
                                <td>{{ $m->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($m->is_read)
                                        <span class="badge bg-secondary">Read</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Unread</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.contact_messages.show', $m->id) }}"
                                       class="btn btn-sm btn-info rounded-pill">
                                        <i class="fe-eye"></i> View
                                    </a>
                                    <form action="{{ route('admin.contact_messages.destroy', $m->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill delete-confirm">
                                            <i class="fe-trash-2"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No messages yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
