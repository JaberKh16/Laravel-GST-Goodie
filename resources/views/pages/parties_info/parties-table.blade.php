@extends('layouts.app')

@section('user-content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
        });
    </script>
@elseif (session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
        });
    </script>
@endif
<div class="section-body">
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="create-btn mb-3">
            <a href="{{ route('parties.form.view') }}" class="btn btn-primary">Create Party <i class="fas fa-plus"></i></a>
        </div>
        <div class="card-header">
            <h4>Parties Record</h4>
            <div class="card-header-form">
                <form action="{{ route('parties.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="query" value="{{ request('query') }}">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Party Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Approval</th>
                        <th colspan="2">Action</th>
                    </tr>
                    {{-- @if ($parties_record != null)
                        @php
                            $start_serial = ($parties_record->currentPage() - 1) * $parties_record->perPage() + 1;
                            $end_serial = $start_serial + $parties_record->count() - 1;
                        @endphp
                        @foreach ($parties_record as $record)
                            <tr>
                                <td>{{ $start_serial++ }}</td>
                                <td>{{ $record->parties_type }}</td>
                                <td>{{ $record->email }}</td>
                                <td>{{ $record->status }}</td>
                                <td>{{ $record->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if ($record->status === 'verified')
                                        <a href="{{ route('parties.type.update.status', ['parties', $record->id, 'non-verified']) }}" type="button" class="btn btn-warning text-white">Non Verified</a>
                                    @else
                                        <a href="{{ route('parties.type.update.status', ['parties', $record->id, 'verified']) }}" type="button" class="btn btn-primary text-white">Verified</a>
                                    @endif
                                </td>
                            <td>
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ route('parties.type.form.edit', $record->id) }}" class="dropdown-item btn btn-warning text-white p-2"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="{{ route('parties.type.form.delete', $record->id) }}" class="dropdown-item btn btn-danger text-white p-2" onclick="return confirmDeletion(event)"><i class="fa fa-trash"></i> Delete</a>
                                        </div>-
                                    </div>
                                </td>

                            </tr>
                            
                        @endforeach
                    @else
                        <td colspan="5">No record found</td>
                    @endif --}}
                </tbody>
            </table>
        </div>


        {{-- Paginator Setup --}}
        {{-- <div class="card-footer text-right">
            <nav class="d-inline-block">
                <ul class="pagination mb-0">
                    @if ($parties_record->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $parties_record->previousPageUrl() }}" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                    @endif

                    @foreach ($parties_record->links()->elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $parties_record->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($parties_record->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $parties_record->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div> --}}



    </div>
    </div>
</div>
</div>

<script>
    function confirmDeletion(event) {
        if (!confirm('Are you sure you want to delete this record?')) {
            event.preventDefault();
        }
    }
</script>
@endsection

