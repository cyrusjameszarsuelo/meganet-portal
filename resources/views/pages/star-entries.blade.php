@extends('main')

@section('pageLinks')
    <style>
        .star-banner-wrapper {
            background: linear-gradient(135deg, #fff5f4 0%, #fef9ff 40%, #ffffff 100%);
            border-radius: 12px;
            padding: 16px 20px;
            margin-top: 16px;
        }

        .star-banner-title {
            font-family: 'Magistral-Bold', sans-serif;
            font-size: 22px;
            margin: 0;
        }

        .star-banner-pill {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 999px;
            background-color: #ffe3df;
            color: #ee2f21;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-right: 8px;
        }

        .star-banner-sub {
            font-size: 13px;
            color: #777;
            margin-top: 4px;
        }

        .star-entries-card .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #f1f1f1;
            position: relative;
        }

        .star-entries-card .card-header::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #ee2f21;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .star-entries-card .card-header h5 {
            font-family: 'Montserrat-Bold', sans-serif;
            letter-spacing: 0.02em;
            font-size: 15px;
            color: #333;
        }

        .star-entries-card .table thead th {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-top: none;
            border-bottom: 2px solid #f1f1f1;
        }

        .star-entries-card .table tbody td {
            vertical-align: middle;
            font-size: 13px;
        }

        .star-entries-card .table tbody tr:hover {
            background-color: #fff7f6;
        }

        .star-entries-meta {
            font-size: 12px;
            color: #999;
        }

        .star-entries-thanks {
            max-width: 260px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .star-entry-values {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }

        .star-entry-value {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            background-color: #fff1ef;
            color: #ee2f21;
            border: 1px solid #ffd6cf;
        }

        .star-entries-empty {
            padding: 32px 16px;
            text-align: center;
            border-radius: 12px;
            border: 1px dashed #dee2e6;
            background-color: #fafafa;
        }

        .star-entry-chip-label {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            background-color: #f7f7f7;
            color: #999;
            margin-bottom: 4px;
        }

        .star-entry-block {
            background-color: #fafafa;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 13px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="star-banner-wrapper">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <div class="star-banner-pill"><i class="fa fa-star mr-1"></i> STAR appreciation</div>
                    <h1 class="star-banner-title">STAR stories from KaMegawide</h1>
                    <div class="star-banner-sub">A quick view of who is being celebrated across our teams.</div>
                </div>
                <div class="mt-2 mt-md-0">
                    <span class="breadcrumbCustom"><a href="/home">HOME</a>
                        <i class="fa fa-chevron-right ml-2 mr-2"></i>
                        <span style="color:#ee2f21">STAR appreciation entries</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <section class="container mt-3 mb-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card star-entries-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fa fa-star mr-2"></i>STAR appreciation entries</h5>
                        <a href="/home" class="btn btn-sm btn-outline-secondary">Back to home</a>
                    </div>
                    <div class="card-body">
                        @if (!empty($entries))
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <div class="font-weight-bold">Captured STAR stories</div>
                                    <div class="star-entries-meta">Click "View" to see the full STAR (Situation &amp; Task, Action &amp; Results).</div>
                                </div>
                                <span class="badge badge-pill badge-light border">{{ count($entries) }} total</span>
                            </div>

                            <div class="table-responsive mt-2">
                                <table class="table table-sm table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>To</th>
                                            <th>From</th>
                                            <th>Thanks for</th>
                                            <th>Values</th>
                                            <th>Created at</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($entries as $entry)
                                            @php
                                                $selectedValues = $entry->selected_values ?? [];
                                                if (is_string($selectedValues)) {
                                                    $decodedValues = json_decode($selectedValues, true);
                                                    $selectedValues = is_array($decodedValues) ? $decodedValues : [];
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $entry->to_name ?? '' }}</td>
                                                <td>{{ $entry->from_name ?? '' }}</td>
                                                <td class="star-entries-thanks">{{ Str::limit($entry->thanks_for ?? '', 60) }}</td>
                                                <td>
                                                    <div class="star-entry-values">
                                                        @forelse ($selectedValues as $value)
                                                            <span class="star-entry-value">{{ $value }}</span>
                                                        @empty
                                                            <span class="text-muted">-</span>
                                                        @endforelse
                                                    </div>
                                                </td>
                                                <td>{{ optional($entry->created_at)->format('M d, Y H:i') }}</td>
                                                <td class="star-status-cell">
                                                    @if ($entry->validation_status === 'valid')
                                                        <span class="badge badge-success">Valid</span>
                                                    @elseif ($entry->validation_status === 'not_valid')
                                                        <span class="badge" style="background-color:#aaa;color:#fff;">Not Valid</span>
                                                    @else
                                                        <span class="badge badge-light border text-muted">Pending</span>
                                                    @endif
                                                </td>
                                                <td class="text-right" style="white-space:nowrap;">
                                                    <button type="button"
                                                        class="btn btn-xs btn-outline-secondary star-entry-view"
                                                        style="font-size:11px;padding:2px 8px;"
                                                        data-to="{{ $entry->to_name ?? '' }}"
                                                        data-from="{{ $entry->from_name ?? '' }}"
                                                        data-thanks="{{ $entry->thanks_for ?? '' }}"
                                                        data-st="{{ $entry->situation_task ?? ($entry->situation . ' ' . $entry->task) }}"
                                                        data-ar="{{ $entry->action_results ?? ($entry->action . ' ' . $entry->results) }}"
                                                        data-values='@json($selectedValues)'
                                                        data-created="{{ optional($entry->created_at)->format('M d, Y H:i') }}">
                                                        <i class="fa fa-eye"></i> View
                                                    </button>
                                                    @if ($entry->validation_status === null)
                                                        <button type="button"
                                                            class="btn btn-xs btn-success star-validate-btn ml-1"
                                                            style="font-size:11px;padding:2px 8px;"
                                                            data-id="{{ $entry->id }}"
                                                            data-status="valid">
                                                            <i class="fa fa-check"></i> Valid
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-xs btn-outline-danger star-validate-btn ml-1"
                                                            style="font-size:11px;padding:2px 8px;"
                                                            data-id="{{ $entry->id }}"
                                                            data-status="not_valid">
                                                            <i class="fa fa-times"></i> Not Valid
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="star-entries-empty">
                                <div><i class="fa fa-star-o" style="font-size: 32px; color:#ee2f21;"></i></div>
                                <div class="mt-2 font-weight-bold">No STAR stories yet</div>
                                <p class="text-muted mb-0">When team members start submitting STAR appreciations from the homepage, they will appear here for admins.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- STAR entry detail modal -->
    <div class="modal fade" id="starEntryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <div class="star-banner-pill mb-1"><i class="fa fa-star mr-1"></i> STAR story</div>
                        <h5 class="modal-title mb-0">Appreciation details</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <span class="star-entry-chip-label">To</span>
                            <div class="star-entry-block" id="starEntryTo"></div>
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <span class="star-entry-chip-label">From</span>
                            <div class="star-entry-block" id="starEntryFrom"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <span class="star-entry-chip-label">Thanks for</span>
                        <div class="star-entry-block" id="starEntryThanks"></div>
                    </div>

                    <div class="mb-3">
                        <span class="star-entry-chip-label">Megawide values</span>
                        <div class="star-entry-block">
                            <div id="starEntryValues" class="star-entry-values"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span class="star-entry-chip-label">Situation &amp; Task (ST)</span>
                            <div class="star-entry-block" id="starEntryST"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="star-entry-chip-label">Action &amp; Results (AR)</span>
                            <div class="star-entry-block" id="starEntryAR"></div>
                        </div>
                    </div>

                    <p class="mt-2 mb-0 text-muted"><small>Submitted on <span id="starEntryCreated"></span></small></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.star-entry-view', function() {
                var $btn = $(this);

                $('#starEntryTo').text($btn.data('to') || '');
                $('#starEntryFrom').text($btn.data('from') || '');
                $('#starEntryThanks').text($btn.data('thanks') || '');
                var values = $btn.data('values') || [];
                var valuesHtml = '';
                if (typeof values === 'string') {
                    try {
                        values = JSON.parse(values);
                    } catch (e) {
                        values = [];
                    }
                }
                if (Array.isArray(values) && values.length) {
                    values.forEach(function(value) {
                        valuesHtml += '<span class="star-entry-value mr-1 mb-1">' + value + '</span>';
                    });
                } else {
                    valuesHtml = '<span class="text-muted">No values selected.</span>';
                }
                $('#starEntryValues').html(valuesHtml);
                $('#starEntryST').text($btn.data('st') || '');
                $('#starEntryAR').text($btn.data('ar') || '');
                $('#starEntryCreated').text($btn.data('created') || '');

                $('#starEntryModal').modal('show');
            });

            $(document).on('click', '.star-validate-btn', function () {
                if ($(this).prop('disabled')) return;

                var $btn = $(this);
                var entryId = $btn.data('id');
                var status = $btn.data('status');
                var label = status === 'valid' ? 'Valid' : 'Not Valid';

                Swal.fire({
                    title: 'Confirm ' + label,
                    text: 'Are you sure you want to mark this entry as ' + label + '? This action is irreversible.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ee2f21',
                    confirmButtonText: 'Yes, mark as ' + label,
                    cancelButtonText: 'Cancel',
                }).then(function (result) {
                    if (!result.isConfirmed) return;

                    $btn.prop('disabled', true);

                    $.ajax({
                        url: '/star-appreciations/' + entryId + '/validate',
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            status: status,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            var $row = $btn.closest('tr');
                            // Remove both action buttons — entry is now validated
                            $row.find('.star-validate-btn').remove();
                            // Update status badge
                            var badgeHtml = status === 'valid'
                                ? '<span class="badge badge-success">Valid</span>'
                                : '<span class="badge" style="background-color:#aaa;color:#fff;">Not Valid</span>';
                            $row.find('.star-status-cell').html(badgeHtml);
                        },
                        error: function (xhr) {
                            $btn.prop('disabled', false);
                            Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                        }
                    });
                });
            });
        });
    </script>
@endsection
