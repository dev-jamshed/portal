<!DOCTYPE html>
<html>
<head>
    <title>New Ticket Assigned</title>
</head>
<body>
    <h1>New Ticket Assigned</h1>
    <p>A new ticket has been assigned to you:</p>
    <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
    <p><strong>Description:</strong> {!! $ticket->description !!}</p>
    <p><strong>Priority:</strong> {{ $ticket->priority }}</p>
    <p>Thank you!</p>
</body>
</html>
