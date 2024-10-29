@extends('layouts.app')

@section('title', 'Edit Ticket')
@section('content')
    <style>
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #ddd;
            pointer-events: none !important;
        }
    </style>

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h4><i data-feather="message-square" class="  h-i"></i> Ticket | Details</h4>
                            <a href="{{ route('tickets.index') }}" class="btn btn-primary">Back</a>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="detail-container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="d-p">Subject</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="d-p">{{ $ticket->subject }}</p>
                                        </div>
                                        <div class="line"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="d-p">Added By</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="d-p">{{ $ticket->user->name }}</p>
                                        </div>
                                        <div class="line"></div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="d-p">Concerned Department</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="d-p">
                                                @foreach ($departments as $department)
                                                    @if (in_array($department->id, $ticket->departments->pluck('id')->toArray()))
                                                        {{ $department->name }}
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>
                                        <div class="line"></div>
                                    </div>

                                    @if (!empty($ticket->project_deadline))
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="d-p">Project Deadline</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="d-p">{{ $ticket->project_deadline }}</p>
                                            </div>
                                            <div class="line"></div>
                                        </div>
                                    @endif
                                    @if (!empty($ticket->c_company_name))
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="d-p">Company Name</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="d-p">{{ $ticket->c_company_name }}</p>
                                            </div>
                                            <div class="line"></div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="d-p">Ticket Status</p>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <p class="d-p">

                                                @if (strcasecmp($ticket->status, 'Open') == 0)
                                                    <button class="btn btn-success">Open</button>
                                                @elseif($ticket->status == 'in-progress')
                                                    <button class="btn btn-primary">In Progress</button>
                                                @else
                                                    <button class="btn btn-danger">Close</button>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="line"></div>
                                    </div>


                                
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="d-p">Ticket Priority</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="d-p">
                                                <select {{ $ticket->user_id != Auth::user()->id ? 'readonly' : '' }}
                                                    name="priority" class="form-control">
                                                    <option value="Low"
                                                        {{ $ticket->priority == 'Low' ? 'selected' : '' }}>Low
                                                    </option>
                                                    <option value="Medium"
                                                        {{ $ticket->priority == 'Medium' ? 'selected' : '' }}>
                                                        Medium
                                                    </option>
                                                    <option value="High"
                                                        {{ $ticket->priority == 'High' ? 'selected' : '' }}>
                                                        High
                                                    </option>
                                                </select>
                                            </p>
                                        </div>
                                        <div class="line"></div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="d-p">Ticket Status</p>
                                        </div>
                                        <div class="col-sm-4 ">
                                            <p class="d-p">
                                                <select name="status" class="form-control">
                                                    <option value="open"
                                                        {{ $ticket->status == 'open' ? 'selected' : '' }}>Open
                                                    </option>
                                                    <option value="in-progress"
                                                        {{ $ticket->status == 'in-progress' ? 'selected' : '' }}>In
                                                        Progress
                                                    </option>
                                                    <option value="closed"
                                                        {{ $ticket->status == 'closed' ? 'selected' : '' }}>
                                                        Closed
                                                    </option>
                                                </select>
                                            </p>
                                        </div>
                                        <div class="line"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="d-p">Add User</p>
                                        </div>
                                        <div class="col-sm-6">

                                            @if (in_array('employee_id', $fields))
                                                <div class="form-group emp_select_2">

                                                    <select id="employee_id" name="employee_ids[]"
                                                        class="form-control select2" multiple>
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}"
                                                                data-email="{{ $employee->email }}"
                                                                {{ in_array($employee->id, $ticket->employees->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                                {{ $employee->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            @endif
                                        </div>
                                        <div class="line"></div>
                                    </div>
                                </div>


                                <div class="row">

                                    @if (
                                        ($user->hasRole(['Manager', 'super-admin']) ||
                                            ($user->department && $user->department->name === 'Sales' && $ticket->created_by == $user->id)) &&
                                            !is_null($ticket->price))
                                        <div class="form-group col-md-6">
                                            <label>Price</label>
                                            <input type="text" name="price" class="form-control"
                                                value="{{ $ticket->price }}" disabled>
                                        </div>

                                        <!-- <div class="form-group col-md-6">-->
                                        <!--    <label>Client Name</label>-->
                                        <!--    <input type="text" required id="c_name" name="c_name" class="form-control"-->
                                        <!--        value="{{ $ticket }}">-->
                                        <!--</div>-->
                                    @endif
                                    @if (
                                        ($user->department && $user->hasRole('Sales')) ||
                                            ($user->hasRole('manager') && $ticket->user_id == Auth::user()->id))
                                        <!-- Client Details -->
                                        <div class="form-group  col-md-6">
                                            <label>Client Name</label>
                                            <input type="text" id="c_name" name="c_name" class="form-control"
                                                value="{{ $ticket->client->name }}" disabled>
                                        </div>
                                    @endif


                                    <!-- Check if Project Name is not null or empty -->
                                    @if (!empty($ticket->project_name))
                                        <div class="form-group  col-md-6">
                                            <label>Project Name</label>
                                            <input type="text" name="project_name" class="form-control" disabled
                                                value="{{ old('project_name', $ticket->project_name) }}" required>
                                        </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="chat-box">

                                            @foreach ($ticket->comments as $comment)
                                                @if ($comment->comment != 'Attachment uploaded without a comment')
                                                    <div class="flex-client">
                                                        <div class="client-messgae" style="background-color: {{ $comment->user->color_code }}">
                                                            <div class="flex-name-client">
                                                                <p class="p_name">
                                                                    {{ $comment->user->name }}
                                                                </p>
                                                            </div>

                                                            <div  class="message-p">{!! $comment->comment !!}</div>

                                                            <!--// User Message Attachment-->
                                                            @if ($comment->attachments->count())
                                                                @foreach ($comment->attachments as $attachment)
                                                                    <div class="attachment-item">
                                                                        @php
                                                                            // File extension check ke liye `pathinfo` function ka use kiya gaya hai
                                                                            $fileExtension = pathinfo(
                                                                                $attachment->file_name,
                                                                                PATHINFO_EXTENSION,
                                                                            );
                                                                            $isZip =
                                                                                strtolower($fileExtension) === 'zip';

                                                                        @endphp


                                                                        @if ($isZip)
                                                                            {{-- Agar file zip hai to wo download hogi --}}
                                                                            <a href="{{ route('attachments.comment.download', $attachment->id) }}"
                                                                                class="attachment_self" download>
                                                                                <i data-feather="download"
                                                                                    class="h-i"></i>
                                                                                {{ Str::limit($attachment->file_name, 20) }}
                                                                            </a>
                                                                        @else
                                                                            {{-- Agar file zip nahi hai to new tab mein open hogi --}}
                                                                            <a href="{{ asset($attachment->file_path) }}"
                                                                                target="_blank" class="attachment_self">
                                                                                <i data-feather="file" class="h-i"></i>
                                                                                {{ Str::limit($attachment->file_name, 20) }}
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            @endif


                                                            <div class="flex-date">
                                                                <p class="p_date">
                                                                    {{ $comment->created_at->format('d M Y, h:i A') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="flex-client">
                                                <div class="client-messgae"  style="background-color: {{ $ticket->creator->color_code }}">
                                                    <div class="flex-name-client">
                                                        <p class="p_name">
                                                            {{ $ticket->user->name }}
                                                        </p>
                                                    </div>

                                                    <div  class="message-p">{!! $ticket->description !!}</div>
                                                    <!--// User Message Attachment-->
                                                    @if ($ticket->attachments->count())

                                                        <a href="{{ route('attachments.downloadAll', $ticket->id) }}"
                                                            class="attachment_self my-1">
                                                            <i data-feather="download" class="h-i"></i>
                                                            Download All Attachments
                                                        </a>

                                                        @foreach ($ticket->attachments as $attachment)
                                                            <div style="display: none" class="attachment-item">
                                                                <a href="{{ route('attachments.comment.download', $attachment->id) }}"
                                                                    class="attachment_self" target="_blank">
                                                                    <i data-feather="download" class="h-i"></i>
                                                                    {{ Str::limit($attachment->file_name, 20) }}

                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    <div class="flex-date">
                                                        <p class="p_date">
                                                            {{ $ticket->created_at->format('d M Y, h:i A') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>



                                        </div><!--chat-box end-->
                                    </div>


                                    <!-- Comments -->
                                    <div class="form-group col-md-12">
                                        <label>Add Message</label>
                                        <textarea id="comment" name="comment" class="form-control">{{ old('comment') }}</textarea>
                                    </div>


                                    <!-- Attachments -->
                                    <div class="form-group col-sm-4 ">
                                        <label>Attachments </label>
                                        <!--<div class="attachment-list">-->
                                        <!--    @if ($ticket->attachments->count())
    -->
                                        <!--        <a href="{{ route('attachments.downloadAll', $ticket->id) }}"-->
                                        <!--            class="attachment_self my-1">-->
                                        <!--            <i data-feather="download" class="h-i"></i>-->
                                        <!--            Download All Attachments-->
                                        <!--        </a>-->
                                        <!--
    @endif-->
                                        <!--    @foreach ($ticket->attachments as $attachment)
    -->
                                        <!--        <div class="attachment-item mb-2">-->

                                        <!--            <a href=""-->
                                        <!--                class="attachment_self my-1" target="_blank">-->
                                        <!--                <i data-feather="download" class="h-i"></i>-->
                                        <!--                {{ $attachment->file_name }}-->
                                        <!--            </a>-->
                                        <!--        </div>-->
                                        <!--
    @endforeach-->
                                        <!--</div>-->

                                        <input type="file" name="comment_attachments[]" class="form-control" multiple >
                                    </div>


                                    <!-- Status -->



                                    <div class="col-md-12  ">

                                        <div>
                                            <button type="submit" class="btn btn-primary">Update Ticket</button>
                                        </div>

                                    </div>
                                </div><!--row end-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            $('#clients').select2({
                placeholder: "Select clients", // Placeholder text
                allowClear: true // Option to clear the selection
            });


    $('.select2').select2({
        placeholder: "Select employees",
        matcher: function(params, data) {
            // Agar search term empty ho, toh default match return karo
            if ($.trim(params.term) === '') {
                return data;
            }

            // Employee ka naam aur email dono match karne ke liye condition
            var term = params.term.toLowerCase();
            var nameMatches = data.text.toLowerCase().includes(term);
            var emailMatches = $(data.element).data('email') && $(data.element).data('email').toLowerCase().includes(term);

            // Agar kisi bhi field mein match hota hai toh result return karo
            if (nameMatches || emailMatches) {
                return data;
            }

            // Agar koi match nahi milta toh null return karo
            return null;
        }
    });


        });
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize TinyMCE for displaying existing comments in read-only mode
            tinymce.init({
                selector: '#description',
                menubar: false, // Hide menubar
                toolbar: false, // Hide toolbar
                readonly: true, // Make it read-only
                setup: function(editor) {
                    editor.on('init', function() {
                        editor.getBody().setAttribute('contenteditable',
                            false); // Ensure it's not editable
                    });
                }
            });


            tinymce.init({
                selector: '#comment',
            });
        });
    </script>
@endsection
