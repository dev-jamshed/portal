<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Updated Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ticket Updated Notification</h1>
        <p>Dear User</p>

        <p>The following ticket has been updated:</p>

        <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
        <p><strong>Status:</strong> {{ $ticket->status }}</p>
        <p><strong>Priority:</strong> {{ $ticket->priority }}</p>

        @if(!empty($changedFields))
            <p><strong>Changed Fields:</strong></p>
            <ul>
                @foreach($changedFields as $field)
                    <li>{{ ucfirst($field) }}</li>
                @endforeach
            </ul>
        @endif
       
        @if($newComment)
            <p><strong>New Comment:</strong> {!! $newComment->comment !!}</p>
        @endif

        <p>Thank you!</p>

        <div class="footer">
            <p>This is an automated message. Please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>
