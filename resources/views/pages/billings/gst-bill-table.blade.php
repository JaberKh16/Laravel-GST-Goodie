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
            <a href="{{ route('gst.billings.form.view') }}" class="btn btn-primary">Create Billings <i class="fas fa-plus"></i></a>
        </div>
        <div class="card-header">
            <h4>GST Billings Record</h4>
            <div class="card-header-form">
                <form action="{{ route('gst.billings.search') }}" method="GET">
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
                        <th>Party Type</th>
                        <th>Invoice Date</th>
                        <th>Invoice No</th>
                        <th>Item Description</th>
                        <th>Total Amount</th>
                        <th>CGST Rate</th>
                        <th>SGST Rate</th>
                        <th>IGST Rate</th>
                        <th>CGST Amount</th>
                        <th>SGST Amount</th>
                        <th>IGST Amount</th>
                        <th>Tax Amount</th>
                        <th>Net Amount</th>
                        <th>Declaration</th>
                        <th>Created At</th>
                        <th colspan="2">Action</th>
                    </tr>
                    @if ($gst_billings_record != null)
                        @php
                            $start_serial = ($gst_billings_record->currentPage() - 1) * $gst_billings_record->perPage() + 1;
                            $end_serial = $start_serial + $gst_billings_record->count() - 1;
                        @endphp
                        @foreach ($gst_billings_record as $record)
                            <tr>
                                <td>{{ $start_serial++ }}</td>
                                <td>{{ $parties_type[$record->id] ?? 'N/A' }}</td>
                                <td>{{ $record->invoice_date }}</td>
                                <td>{{ $record->invoice_no }}</td>
                                <td>{{ $record->item_description }}</td>
                                <td>{{ $record->total_amount }}</td>
                                <td>{{ $record->cgst_rate }}</td>
                                <td>{{ $record->sgst_rate }}</td>
                                <td>{{ $record->igst_rate }}</td>
                                <td>{{ $record->cgst_amount }}</td>
                                <td>{{ $record->sgst_amount }}</td>
                                <td>{{ $record->igst_amount }}</td>
                                <td>{{ $record->tax_amount }}</td>
                                <td>{{ $record->net_amount }}</td>
                                <td>{{ $record->declaration }}</td>
                                <td>{{ $record->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ route('gst.billings.form.edit', $record->id) }}" class="dropdown-item btn btn-warning text-white p-2"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="{{ route('gst.billings.form.delete', $record->id) }}" class="dropdown-item btn btn-danger text-white p-2" onclick="return confirmDeletion(event)"><i class="fa fa-trash"></i> Delete</a>
                                        </div>-
                                    </div>
                                </td>

                            </tr>
                            
                        @endforeach
                    @else
                        <!-- Check if there is a message for no records found -->
                        @if(isset($message) && $message)
                            <tr>
                                <td colspan="5">{{ $message }}</td>
                            </tr>
                        @else
                           <tr>
                                <td colspan="5">No record available</td>
                            </tr>
                        @endif
                    @endif
                </tbody>
            </table>
        </div>


        {{-- Paginator Setup --}}
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                <ul class="pagination mb-0">
                    @if (isset($gst_billings_record)) 
                        @if ($gst_billings_record->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $gst_billings_record->previousPageUrl() }}" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                        @endif

                        @foreach ($gst_billings_record->links()->elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $gst_billings_record->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($gst_billings_record->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $gst_billings_record->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        @endif
                    @endif
                </ul>
            </nav>
        </div>



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

