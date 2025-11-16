<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $reminder->title }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0;">
        <h1 style="margin: 0; font-size: 24px;">⚔️ KnightCRM Reminder</h1>
    </div>
    
    <div style="background: #ffffff; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
        <h2 style="color: #1f2937; margin-top: 0;">{{ $reminder->title }}</h2>
        
        <div style="background: #f9fafb; padding: 15px; border-radius: 6px; margin: 20px 0;">
            <p style="margin: 0; white-space: pre-wrap;">{{ $reminder->message }}</p>
        </div>

        @if($reminder->client)
            <p style="color: #6b7280; font-size: 14px;">
                <strong>Client:</strong> {{ $reminder->client->name }}
            </p>
        @endif

        @if($reminder->lead)
            <p style="color: #6b7280; font-size: 14px;">
                <strong>Lead:</strong> {{ $reminder->lead->name }}
            </p>
        @endif

        <p style="color: #6b7280; font-size: 14px; margin-top: 20px;">
            This is an automated reminder from KnightCRM.
        </p>
    </div>
</body>
</html>

