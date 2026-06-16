<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f8fafc; margin: 0; padding: 0; }
        .wrapper { max-width: 560px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
        .header { padding: 32px 40px; text-align: center;
            background: {{ $application->status === 'accepted' ? 'linear-gradient(135deg,#10b981,#059669)' : 'linear-gradient(135deg,#3b82f6,#4f46e5)' }};
        }
        .header h1 { color: #fff; margin: 0; font-size: 22px; font-weight: 700; }
        .body { padding: 32px 40px; }
        .body p { color: #374151; font-size: 15px; line-height: 1.6; margin: 0 0 16px; }
        .status-badge { display: inline-block; padding: 6px 18px; border-radius: 20px; font-weight: 700; font-size: 14px; margin: 8px 0 20px;
            background: {{ $application->status === 'accepted' ? '#dcfce7' : ($application->status === 'rejected' ? '#fee2e2' : '#dbeafe') }};
            color: {{ $application->status === 'accepted' ? '#15803d' : ($application->status === 'rejected' ? '#b91c1c' : '#1d4ed8') }};
        }
        .listing-box { background: #f1f5f9; border-radius: 8px; padding: 16px 20px; margin: 20px 0; }
        .listing-box p { margin: 0; color: #1e293b; font-weight: 600; font-size: 15px; }
        .listing-box span { font-size: 13px; color: #64748b; font-weight: 400; }
        .btn { display: inline-block; margin-top: 24px; padding: 12px 28px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; }
        .footer { padding: 20px 40px; text-align: center; border-top: 1px solid #e2e8f0; }
        .footer p { color: #94a3b8; font-size: 12px; margin: 0; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>
            @if($application->status === 'accepted') 🎉 You've been accepted!
            @elseif($application->status === 'rejected') Application Update
            @else Application Status Update
            @endif
        </h1>
    </div>
    <div class="body">
        <p>Hi {{ $application->user->first_name }},</p>

        @if($application->status === 'accepted')
            <p>Great news! The employer has reviewed your application and decided to move forward with you.</p>
        @elseif($application->status === 'rejected')
            <p>Thank you for your interest. After careful review, the employer has decided not to proceed with your application at this time.</p>
            <p>Don't be discouraged — there are many other opportunities waiting for you!</p>
        @else
            <p>Your application status has been updated.</p>
        @endif

        <p>Status: <span class="status-badge">{{ ucfirst($application->status) }}</span></p>

        <div class="listing-box">
            <p>{{ $listingTitle }} <br><span>{{ ucfirst($application->listing_type) }}</span></p>
        </div>

        @if($application->status === 'accepted')
            <p>The employer may contact you directly via your email. Make sure your profile is up to date.</p>
        @endif

        <a href="{{ url('/applications') }}" class="btn">View My Applications</a>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} LVCareer &mdash; Latvia's Job & Internship Platform</p>
    </div>
</div>
</body>
</html>
