<?php

namespace App\Http\Controllers\admin;

use ZipArchive;
use App\Models\User;
use App\Models\client;
use App\Models\Ticket;
use App\Models\Project;
use App\Models\Attachment;
use App\Models\Department;
use App\Models\CommentFile;
use Illuminate\Http\Request;
use App\Models\SubDepartment;
use App\Mail\TicketUpdatedMail;
use App\Mail\TicketAssignedMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index(Request $request)
    {
        $user = Auth::user();
        $tickets = Ticket::query();

        // Apply role-based conditions
        if ($user->hasRole('Sales')) {
            $tickets->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->whereIn('status', ['Open', 'in-progress'])
                    ->orWhereIn('id', function ($subQuery) use ($user) {
                        $subQuery->select('ticket_id')
                            ->from('department_ticket')
                            ->where('department_id', $user->department_id);
                    });
            });
        } elseif ($user->hasRole('manager')) {
            $tickets->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhereIn('id', function ($subQuery) use ($user) {
                        $subQuery->select('ticket_id')
                            ->from('department_ticket')
                            ->where('department_id', $user->department_id);
                    });
            });
        } elseif ($user->hasRole('super-admin')) {
            $tickets = Ticket::query(); // Super-admin sees all tickets
        } elseif ($user->hasRole('Employee')) {
            $tickets->where(function ($query) use ($user) {
                $query->whereIn('id', function ($subQuery) use ($user) {
                    $subQuery->select('ticket_id')
                        ->from('sub_department_ticket')
                        ->where('sub_department_id', $user->sub_department_id);
                })->orWhereIn('id', function ($subQuery) use ($user) {
                    $subQuery->select('ticket_id')
                        ->from('department_ticket')
                        ->where('department_id', $user->department_id)
                        ->whereNotExists(function ($q) {
                            $q->select(DB::raw(1))
                                ->from('sub_department_ticket')
                                ->whereColumn('department_ticket.ticket_id', 'sub_department_ticket.ticket_id');
                        });
                })->orWhereIn('id', function ($subQuery) use ($user) {
                    $subQuery->select('ticket_id')
                        ->from('employee_ticket')
                        ->where('employee_id', $user->id);
                });
            });
        }

        // Apply default filter for 'Open' and 'In Progress' if no status is provided
        if (!$request->has('status')) {
            $tickets->whereIn('status', ['Open', 'in-progress']);
        }

        // Apply additional filters if provided
        if ($request->has('user_id') && $request->user_id != null) {
            $tickets->where('user_id', $request->user_id);
        }

        if ($request->has('subject') && $request->subject != null) {
            $tickets->where('subject', 'LIKE', '%' . $request->subject . '%');
        }

        if ($request->has('department') && $request->department != null) {
            $tickets->whereHas('departments', function ($query) use ($request) {
                $query->where('department_id', $request->department);
            });
        }

        if ($request->has('status') && $request->status != null) {
            // If status is provided in the request, it will now apply this filter
            $tickets->where('status', $request->status);
        }

        if ($request->has('ticket_id') && $request->ticket_id != null) {
            $tickets->where('id', $request->ticket_id);
        }

        if ($request->has('added_by') && $request->added_by != null) {
            $tickets->where('user_id', $request->added_by);
        }

        // Debugging: Log the final SQL query
        Log::info('Tickets Query: ' . $tickets->toSql(), $tickets->getBindings());

        $unreadTicketIds = Ticket::whereDoesntHave('views', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->pluck('id');

        // return $unreadTicketIds;


        // Get tickets in descending order of creation date
        $tickets = $tickets->latest()->get();
        $users = User::all();
        $Departments = Department::all();

        return view('admin.tickets.index', compact('tickets', 'users', 'Departments', 'unreadTicketIds'));
    }



    public function create()
    {
        $user = auth()->user();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $clients = Client::all();
        // return $clients;
        $projects = Project::all();
        // $employees = User::role('Employee')->get();
        $employees = User::get();

        // Common fields for all users
        $fields = [
            'subject',
            'description',
            'priority',
            'project_id',
            'department_id',
            'sub_department_id',
            'employee_id'
        ];

        $showProjectFields = false; // Initialize as false
        $projectFields = [];

        // Additional fields for Sales department users
        if ($user->department && $user->department->name === 'Sales') {
            $fields = array_diff($fields, ['project_id']); // Remove project_id field for Sales
            $showProjectFields = true;
            $projectFields = [
                'project_name',
                'project_deadline',
            ];
        }

        return view('admin.tickets.create', compact('departments', 'subDepartments', 'clients', 'projects', 'fields', 'showProjectFields', 'projectFields', 'employees', 'user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'project_name' => 'nullable|string|max:255',
            'project_deadline' => 'nullable|date',
            'project_id' => 'nullable|exists:projects,id',
            'department_ids' => 'nullable|array',
            'department_ids.*' => 'exists:departments,id',
            'sub_department_ids' => 'nullable|array',
            'sub_department_ids.*' => 'nullable|exists:sub_departments,id',
            'employee_ids' => 'nullable|array',
            'employee_ids.*' => 'exists:users,id',
            'price' => 'nullable|numeric',
            'attachments.*' => 'nullable',
            'c_company_name' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        $client_id = $request->client_id;
        if (!$request->has('client_id') || $request->client_id == NULL) {
            if ($user->hasRole(['Sales', 'manager'])) {
                $request->client;
                $client = new client();
                $client->name = $request->c_name;
                $client->address = $request->c_address;
                $client->email = $request->c_email;
                $client->company_name = $request->c_company_name;
                $client->country = $request->c_country;
                $client->mobile_number = $request->c_mobile_number;
                $client->save();
                $client_id = $client->id;
            }
        }
        // Create the ticket
        $ticket = Ticket::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'project_name' => $request->input('project_name'),
            'project_deadline' => $request->input('project_deadline'),
            'project_id' => $request->input('project_id'),
            'client_id' => $client_id,
            'price' => $request->input('price'),
            'project_deadline' => $request->input('project_deadline'),
            'c_company_name' => $request->input('c_company_name'),
        ]);

        // Handle many-to-many relationships
        $ticket->departments()->sync($request->input('department_ids', []));
        // $ticket->subDepartments()->sync($request->input('sub_department_ids', []));
        $ticket->employees()->sync($request->input('employee_ids', []));
        // Retrieve selected department and sub-department IDs from the request
        $departmentIds = $request->input('department_ids', []);

        if ($request->input('sub_department_ids') == null) {
            return "null";
            $subDepartmentIds =  [];
        } else {
            $subDepartmentIds = $request->input('sub_department_ids');
        }

        // If sub-departments are not selected, retrieve sub-departments for the selected departments
        if (empty($subDepartmentIds) && !empty($departmentIds)) {
            $subDepartmentIds = \App\Models\SubDepartment::whereIn('department_id', $departmentIds)->pluck('id')->toArray();
        }

        // Get employees from the selected or derived sub-departments
        $subDepartmentEmployees = \App\Models\User::whereIn('sub_department_id', $subDepartmentIds)->get();

        // Retrieve directly assigned employees to the ticket
        $assignedUsers = $ticket->employees;

        // Merge both sets of employees
        $allAssignedUsers = $assignedUsers->merge($subDepartmentEmployees);

        // Define CC recipients
        $ccEmails = ['jamshedlinkedin@gmail.com'];

        // Send email to all assigned and related sub-department employees
        foreach ($allAssignedUsers as $user) {
            info($user);
            Mail::to($user->email)
                ->cc($ccEmails) // Add CC recipients here
                ->send(new TicketAssignedMail($ticket));
        }

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    // Define the destination path
                    $destinationPath = public_path('attachments');

                    // Generate a unique file name
                    $fileName = time() . '_' . $file->getClientOriginalName();

                    // Move the file to the destination path
                    $file->move($destinationPath, $fileName);

                    // Save file details in the database
                    $ticket->attachments()->create([
                        'ticket_id' => $ticket->id,
                        'file_path' => 'attachments/' . $fileName, // Relative path for database storage
                        'file_name' => $fileName,
                        'file_type' => $file->getClientOriginalExtension(),
                    ]);
                } else {
                    Log::error('Uploaded file is not valid.');
                }
            }
        }



        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'department_ids' => 'nullable|array',
            'sub_department_ids' => 'nullable|array',
            'employee_ids' => 'nullable|array',
            'status' => 'required',
            'attachments.*' => 'nullable',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        DB::table('ticket_user_views')
        ->where('ticket_id', $ticket->id)
        ->delete();

        $previousTicketData = $ticket->getOriginal();

        // Update departments
        if ($request->has('department_ids')) {
            $ticket->departments()->sync($validated['department_ids']);
        }

        // Update sub-departments
        if ($request->has('sub_department_ids')) {
            $ticket->subDepartments()->sync($validated['sub_department_ids']);
        }

        // Update employees
        if ($request->has('employee_ids')) {
            $ticket->employees()->sync($validated['employee_ids']);
        }

        // Update status and priority
        $ticket->status = $validated['status'];
        $ticket->priority = $validated['priority'];

        // Save any attachments
        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    // Define the destination path
                    $destinationPath = public_path('attachments');

                    // Generate a unique file name
                    $fileName = time() . '_' . $file->getClientOriginalName();

                    // Move the file to the destination path
                    $file->move($destinationPath, $fileName);

                    // Save file details in the database
                    $ticket->attachments()->create([
                        'ticket_id' => $ticket->id,
                        'file_path' => 'attachments/' . $fileName, // Relative path for database storage
                        'file_name' => $fileName,
                        'file_type' => $file->getClientOriginalExtension(),
                    ]);
                } else {
                    Log::error('Uploaded file is not valid.');
                }
            }
        }

        $ticket->updated_at = now();
        $ticket->save();

        $assignedUsers = $this->getAssignedUsersByTicketId($ticket->id);
        $ccEmails = ['jamshedlinkedin@gmail.com'];

        $changedFields = [];
        $newComment = null; // To store the newly added comment

        if ($previousTicketData['status'] !== $ticket->status) {
            $changedFields[] = 'status';
        }

        if ($previousTicketData['priority'] !== $ticket->priority) {
            $changedFields[] = 'priority';
        }

        // Check for new comment
        if ($request->filled('comment')) {
            $comment = $ticket->comments()->create([
                'user_id' => auth()->id(),
                'comment' => $request->comment,
                'ticket_id' => $ticket->id,
            ]);

            // Handle comment attachments if any
            if ($request->hasFile('comment_attachments')) {
                foreach ($request->file('comment_attachments') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $destinationPath = 'attachments';
                    $file->move(public_path($destinationPath), $fileName);

                    CommentFile::create([
                        'comment_id' => $comment->id,
                        'file_path' => $destinationPath . '/' . $fileName,
                        'file_name' => $fileName,
                    ]);
                }
            }

            $changedFields[] = 'comment'; // Track comment change
            $newComment = $comment; // Store the newly created comment for the email
        } else if ($request->hasFile('comment_attachments')) {
            // If there is no comment but there are attachments
            $comment = $ticket->comments()->create([
                'user_id' => auth()->id(),
                'comment' => 'Attachment uploaded without a comment',
                'ticket_id' => $ticket->id,
            ]);

            foreach ($request->file('comment_attachments') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = 'attachments';
                $file->move(public_path($destinationPath), $fileName);

                CommentFile::create([
                    'comment_id' => $comment->id,
                    'file_path' => $destinationPath . '/' . $fileName,
                    'file_name' => $fileName,
                ]);
            }
            $changedFields[] = 'comment'; // Track comment change
            $newComment = $comment; // Store the dummy comment for the email
        }

        // Send email if there are changed fields or new comment

        // return $newComment->comment;
        if (!empty($changedFields)) {
            foreach ($assignedUsers as $user) {
                Mail::to($user->email)->cc($ccEmails)
                    ->send(new TicketUpdatedMail($ticket, $changedFields, $newComment)); // Pass the changed fields and the new comment if exists
            }
        }

        // Redirect to the tickets index page with a success message
        return redirect()->back()->with('success', 'Ticket updated successfully.');
    }



    protected function getAssignedUsersByTicketId($ticketId)
    {
        // Ticket ko employees ke sath load karo
        $ticket = Ticket::with(['employees', 'departments.subDepartments'])->find($ticketId);

        // Agar ticket nahi mili, to empty array return karo
        if (!$ticket) {
            return collect(); // Return an empty collection
        }

        // Retrieve selected department IDs
        $departmentIds = $ticket->departments->pluck('id')->toArray();

        // Get sub-department IDs based on selected departments
        $subDepartmentIds = \App\Models\SubDepartment::whereIn('department_id', $departmentIds)->pluck('id')->toArray();

        // Get employees from the selected or derived sub-departments
        $subDepartmentEmployees = \App\Models\User::whereIn('sub_department_id', $subDepartmentIds)->get();

        // Retrieve directly assigned employees to the ticket
        $assignedUsers = $ticket->employees;

        // Merge both sets of employees
        $allAssignedUsers = $assignedUsers->merge($subDepartmentEmployees);

        info($allAssignedUsers);

        return $allAssignedUsers; // Return the merged collection of assigned users
    }




    public function edit($id)
    {

        $user = auth()->user();
        // return $user->roles->pluck('name'); 
        $ticket = Ticket::with([
            'comments' => function ($query) {
                $query->orderBy('created_at', 'desc');
            },
            'comments.user'
        ])->findOrFail($id);


        // return $user->id;

        $existingView = DB::table('ticket_user_views')
            ->where('user_id', $user->id)
            ->where('ticket_id', $ticket->id)
            ->first();

        if (!$existingView) {
            // User hasn't viewed the ticket yet, so we create a new record
            DB::table('ticket_user_views')->insert([
                'user_id' => $user->id,   // User ID of the viewer
                'ticket_id' => $ticket->id, // Ticket ID being viewed
                'viewed_at' => now(),      // Timestamp for when the ticket was viewed
            ]);
        }


        $fields = [
            'subject',
            'description',
            'priority',
            'project_id',
            'department_id',
            'sub_department_id',
            'employee_id'
        ];

        $showClientDetails = false;
        $showPrice = false;

        if ($user->hasRole('Sales') && $ticket->user_id == $user->id) {
            $showClientDetails = true;
            $showPrice = true;
        } elseif ($user->hasRole('manager') || $user->hasRole('super-admin')) {
            $showClientDetails = true;
            $showPrice = true;
        }

        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $clients = Client::all();
        $projects = Project::all();
        $employees = User::all(); // Fetch 

        $assignedEmployeeIds = $ticket->employees->pluck('id')->toArray();

        return view('admin.tickets.edit', compact('ticket', 'departments', 'subDepartments', 'clients', 'projects', 'employees', 'showClientDetails', 'showPrice', 'user', 'assignedEmployeeIds', 'fields'));
    }

    public function downloadAll($ticketId)
    {
        // Get all attachments for the given ticket
        $attachments = Attachment::where('ticket_id', $ticketId)->get();

        // Create a new ZIP file
        $zip = new ZipArchive();
        $zipFileName = 'attachments_' . $ticketId . '.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
            abort(500, 'Could not create ZIP file');
        }

        foreach ($attachments as $attachment) {
            $filePath = public_path('attachments/' . $attachment->file_name);
            if (file_exists($filePath)) {
                $zip->addFile($filePath, $attachment->original_name);
            }
        }

        $zip->close();

        // Return the ZIP file as a response
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }


    public function download($id)
    {
        // Find the attachment by ID
        $attachment = Attachment::findOrFail($id);



        // Path to the file
        $filePath = public_path('attachments/' . $attachment->file_name);


        // Check if file exists
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        // Return file as response
        return response()->download($filePath, $attachment->original_name);
    }
    public function comment_download($id)
    {
        // Find the attachment by ID
        $attachment = CommentFile::findOrFail($id);



        // Path to the file
        $filePath = public_path('attachments/' . $attachment->file_name);


        // Check if file exists
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }
        // Return file as response
        return response()->download($filePath, $attachment->original_name);
    }


    public function search(Request $req)
    {
        $tempProducts = [];
        $products = null;
        if ($req->term != "") {
            $products = client::where('first_name', 'like', '%' . $req->term . '%')->get();
        }

        if ($products != null) {
            foreach ($products as $product) {
                $tempProducts[] = array('id' => $product->id, 'text' => $product->first_name);
            }
            return response()->json([
                'tags' => $tempProducts,
                'status' => true
            ]);
        }
    }
    public function fetchClient(Request $request)
    {
        $clientId = $request->clientId;

        // Fetch the client record from the database
        $client = Client::findOrFail($clientId);

        // Return the client record as JSON response
        return response()->json($client);
    }
}
