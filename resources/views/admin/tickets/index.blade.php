@extends('layouts.app')

@section('title', 'Tickets')


@section('content')
    <style>
        .checkBoxDiv {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            /* background: orange; */
            gap: 6px;
        }

        .checkBoxDiv label {
            margin-bottom: 0;
            cursor: poitner;
        }
    </style>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4><i data-feather="message-square" class="  h-i"></i> Manage Tickets</h4>
                <a class="btn btn-primary" href="{{ route('tickets.create') }}">New Tickets</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tickets.index') }}" method="GET">

                    <div class="row filter-container">

                        <div class="form-group col-md-2">
                            <label>Search</label>
                            <select name="user_id" class="form-control">
                                <option selected disabled>User ID</option>

                                @foreach ($users as $userData)
                                    <option value="{{ $userData->id }}"
                                        {{ request('user_id') == $userData->id ? 'selected' : '' }}>
                                        {{ $userData->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group col-md-4">
                            <label>Subject</label>
                            <input type="text" name="subject" placeholder="Subject" class="form-control"
                                value="{{ request('subject') }}"">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Department</label>
                            <select name="department" class="form-control">
                                <option selected disabled>Please Select Department</option>

                                @foreach ($Departments as $Department)
                                    <option value="{{ $Department->id }}"
                                        {{ request('department') == $Department->id ? 'selected' : '' }}>
                                        {{ $Department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-md-2">
                            <label>Ticket Status</label>
                            <select name="status" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In
                                    Progress</option>
                                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Ticket ID</label>
                            <input type="text" name="ticket_id" placeholder="Ticket ID" class="form-control"
                                value="{{ request('ticket_id') }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Added By</label>

                            <select name="user_id" class="form-control">
                                <option selected disabled>Select </option>
                                @foreach ($users as $userData)
                                    <option value="{{ $userData->id }}"
                                        {{ request('user_id') == $userData->id ? 'selected' : '' }}>
                                        {{ $userData->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-3">
                            <div class="flex-button-2">
                                <div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>

                    </div><!--row end -->
                </form>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S#</th>
                                            <th class="text-center">Department</th>
                                            <th class="text-center">Subject</th>
                                            <th class="text-center">Priority</th>
                                            <th class="text-center">Added By</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Updated At</th>
                                            <th class="text-center">Created At</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                            <tr
                                                style="{{ $unreadTicketIds->contains($ticket->id) ? 'background-color: #f8d7da;' : '' }}">


                                                <td class="text-center">{{ $ticket->id }}</td>
                                                <td class="text-center">
                                                    @if ($ticket->departments->isNotEmpty())
                                                        {{ $ticket->departments->pluck('name')->implode(', ') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>

                                                <td class="text-center">{{ $ticket->subject }}</td>


                                                <td class="text-center">

                                                    <span
                                                        class="badge badge-shadow 
                                                    @if ($ticket->priority == 'High') badge-danger 
                                                    @elseif($ticket->priority == 'Medium')
                                                        badge-primary
                                                    @else
                                                        badge-success @endif
                                                    ">

                                                        {{ $ticket->priority }}
                                                    </span>


                                                </td>

                                                <td class="text-center">{{ $ticket->user->name }}</td>

                                                <td class="text-center">

                                                    <span
                                                        class="badge badge-shadow 
                                                       @if ($ticket->status == 'open' || $ticket->status == 'Open') badge-success  
                                                        @elseif($ticket->status == 'in-progress')
                                                        badge-primary  
                                                        @else
                                                        badge-danger @endif
                                                    ">
                                                        {{ $ticket->status }}
                                                    </span>
                                                </td>

                                                <td class="text-center">{{ $ticket->updated_at->format('d M Y h:i A') }}
                                                </td>

                                                <td class="text-center">{{ $ticket->created_at->format('d M Y h:i A') }}
                                                </td>
                                                <td class="just-flex">
                                                    <form class="my-0-mx-auto"
                                                        action="{{ route('tickets.destroy', $ticket->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('tickets.edit', $ticket->id) }}"
                                                                        class="btn btn-primary btn-md">
                                                                        <i class="fa-regular fa-eye h-i-2"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Destroy any existing DataTable instance
            $('#table-1').DataTable().destroy();

            // Custom sorting for Priority column
            $.fn.dataTable.ext.order['priority-sort'] = function(settings, col) {
                return this.api()
                    .column(col, {
                        order: 'index'
                    })
                    .data()
                    .map(function(priority) {
                        switch (priority) {
                            case 'High':
                                return 1; // Highest priority
                            case 'Medium':
                                return 2; // Medium priority
                            case 'Low':
                                return 3; // Lowest priority
                            default:
                                return 4; // For cases where priority is missing or unknown
                        }
                    });
            };

            // Initialize the DataTable with custom sorting for the Priority column (4th column, index 3)
            var table = $('#table-1').DataTable({
                "order": [
                    [3, "asc"] // Sort by the priority column
                ],
                "columnDefs": [{
                        "orderDataType": "priority-sort",
                        "targets": 3
                    } // Apply custom sorting to the 4th column
                ]
            });

            // Redraw the table after sorting
            table.draw();
        });
    </script>



@endsection
