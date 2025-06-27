<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FormyFi Notification</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }
        .container {
            background: #e9ecf2;
            text-align: center;
            padding: 20px;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .logo {
            max-width: 160px;
            height: 40px;
            margin-bottom: 32px;
        }
        .main-title {
            margin-top: 40px;
            margin-bottom: 8px;
            font-size: 22px;
            font-weight: 500;
            color: #23263b;
        }
        .main-title a {
            margin-top: 40px;
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }
        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        .avatar-fallback {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #afb8c9;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            vertical-align: middle;
        }
        .user-icon {
            width: 32px;
            height: 32px;
            fill: white;
        }
        .subtitle {
            color: #23263b;
            font-size: 18px;
            margin-bottom: 32px;
        }
        .talent-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.06);
            padding: 24px 0 16px 0;
            margin: 0 auto 0 auto;
            width: 220px;
        }
        .talent-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
        }
        .talent-name {
            font-size: 18px;
            font-weight: 500;
            color: #23263b;
            margin-bottom: 12px;
        }
        .talent-levels {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 0;
        }
        .level-badge {
            background: #f1f2f6;
            color: #4f46e5;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
        }
        .socials img {
            width: 28px;
            height: 28px;
            margin: 0 8px;
            vertical-align: middle;
        }
        .footer {
            text-align: center;
            color: #8a8fa7;
            font-size: 12px;
            line-height: 1.7;
            padding: 20px;
        }
        .footer a {
            color: #4f46e5;
            text-decoration: underline;
        }
        .main-title,
        .subtitle,
        .talent-card,
        .profile-btn,
        .socials {
            margin-bottom: 40px;
        }
        .mail-section {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.06);
            padding: 32px 24px 32px 24px;
            margin: 0 auto 40px auto;
            max-width: 556px;
            display: block;
            text-align: center;
        }
        .mail-section-icon {
            margin-bottom: 24px;
        }
        .mail-section-title {
            font-size: 20px;
            font-weight: 500;
            color: #23263b;
            margin-bottom: 12px;
        }
        .mail-section-desc {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 24px;
        }
        .mail-section-btn {
            display: inline-block;
            background: #4f46e5;
            color: #fff;
            text-decoration: none;
            padding: 12px 32px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
            transition: background 0.2s;
        }
        .mail-section-btn:hover {
            background: #3730a3;
        }
        .quiz-card {
            background: #fff;
            border: 1.5px solid #cbd5e1;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.06);
            padding: 24px 24px 16px 24px;
            margin: 0 auto 40px auto;
            max-width: 556px;
            text-align: left;
            font-family: Arial, sans-serif;
        }
        .quiz-card-header {
            display: block;
            margin-bottom: 12px;
        }
        .quiz-card-step {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
            float: left;
        }
        .quiz-card-required {
            font-size: 9px;
            color: #eb6854;
            font-weight: 500;
            float: right;
        }
        .quiz-card-title {
            font-size: 18px;
            font-weight: 500;
            color: #23263b;
            margin-bottom: 16px;
            clear: both;
        }
        .quiz-card-image {
            margin-bottom: 16px;
            text-align: center;
        }
        .quiz-card-options {
            display: block;
        }
        .quiz-card-option {
            background: #f1f5f9;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 15px;
            color: #23263b;
            display: block;
            margin-bottom: 8px;
            position: relative;
        }
        .quiz-card-option.correct {
            background: #dcfce7;
            color: #15803d;
            border: 1.5px solid #22c55e;
        }
        .quiz-card-option.wrong {
            background: #fee2e2;
            color: #b91c1c;
            border: 1.5px solid #ef4444;
        }
        .quiz-checkbox {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e1;
            border-radius: 4px;
            margin-right: 12px;
            background: #fff;
        }
        .quiz-card-feedback {
            font-size: 13px;
            font-weight: 500;
            margin-left: 12px;
        }
        .quiz-card.correct {
            border: 1.5px solid #22c55e;
            background: #f0fdf4;
        }
        .cover-block {
            background: #fff;
            border: 1.5px solid #cbd5e1;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.06);
            padding: 24px 24px 16px 24px;
            margin: 0 auto 40px auto;
            max-width: 556px;
            margin-top: 40px;
            text-align: left;
        }
        .cover-img {
            width: 100%;
            max-width: 556px;
            height: 160px;
            object-fit: cover;
            border-radius: 12px;
            display: block;
            margin: 0 auto 16px auto;
        }
        .cover-info {
            display: block;
            margin-bottom: 12px;
        }
        .cover-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
            float: left;
            margin-right: 12px;
        }
        .cover-meta {
            display: block;
            font-size: 13px;
            color: #64748b;
            line-height: 32px;
        }
        .cover-users {
            display: inline-block;
            margin-left: 8px;
        }
        .cover-users img {
            height: 16px;
            width: 16px;
        }
        .cover-users-count {
            font-size: 13px;
            color: #64748b;
            margin-left: 4px;
        }
        .cover-title {
            font-size: 28px;
            font-weight: 500;
            color: #23263b;
            margin: 16px 0 8px 0;
            clear: both;
        }
        .cover-steps {
            display: block;
            font-size: 15px;
            color: #64748b;
        }
        .cover-steps-label {
            font-size: 15px;
            color: #64748b;
        }
        .cover-steps-bar {
            display: inline-block;
        }
        .quiz-img-centered {
            border-radius: 8px;
            display: block;
            margin: 0 auto;
            height: 120px;
            width: 120px;
            object-fit: cover;
        }
        .quiz-card-description {
            font-size: 14px;
            font-weight: 400;
            color: #23263b;
            margin-bottom: 16px;
        }
        .quiz-img-attached {
            border-radius: 8px;
            display: block;
            object-fit: cover;
            margin-top: 16px;
            height: 120px;
            width: 120px;
        }
        .social-icon {
            text-decoration: none;
        }

        /* Email client compatibility fixes */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="{{ $message->embed('https://formyfi-files.s3.eu-central-1.amazonaws.com/ic/static/formyfi.png') }}" alt="">
    </div>

    <div class="cover-block">
        <img
            class="cover-img"
            src="{{ $message->embed(config('filesystems.disks.s3.url').'/'.$quest['image']) }}"
            alt="Quest Cover Image"
        />

        <div class="cover-info clearfix">
            @if (!empty($author['avatar']))
                <img
                    src="{{ $message->embed(config('filesystems.disks.s3.url').'/'.$author['avatar'][0]) }}"
                    alt="Author Avatar"
                    class="cover-avatar"
                />
            @else
                <div class="avatar-fallback cover-avatar">
                    <img class="user-icon" src="{{ $message->embed('https://formyfi-files.s3.eu-central-1.amazonaws.com/ic/static/user.png') }}" alt="">
                </div>
            @endif
            <div class="cover-meta">
                <span class="cover-date">{{ date('M d, Y', $quest['start']) }}</span>
                <span class="cover-date">–</span>
                <span class="cover-date">{{ date('M d, Y', $quest['end']) }}</span>
            </div>
        </div>

        <div class="cover-title">{{ $quest['title'] }}</div>
        <div class="cover-steps">
            <span class="cover-steps-label">{{ count($quest['questions']) }} steps</span>
        </div>
    </div>

    @foreach ($quest['questions'] as $index => $question)
        <div class="quiz-card">
            <div class="quiz-card-header clearfix">
                <span class="quiz-card-step">{{ $index + 1 }}/{{ count($quest['questions']) }}</span>
                @if ($question['required'])
                    <span class="quiz-card-required">Required</span>
                @endif
            </div>

            @if (in_array($question['questionType'], ['quiz', 'multiple']))
                <div class="quiz-card-title">{{ $question['question'] }}</div>
                <div class="quiz-card-options">
                    @if ($question['questionType'] === 'multiple')
                        @foreach ($question['answers'] as $option)
                            <div class="quiz-card-option @if($option['isCorrect'] && isset($answers[$index]['answer']) && in_array($option['answer'], json_decode($answers[$index]['answer']))) correct @elseif(!$option['isCorrect'] && isset($answers[$index]['answer']) && in_array($option['answer'], json_decode($answers[$index]['answer']))) wrong @endif">
                                {{ $option['answer'] }}
                            </div>
                        @endforeach
                    @else
                        @foreach ($question['answers'] as $option)
                            <div class="quiz-card-option @if($option['isCorrect'] && isset($answers[$index]['answer']) && $option['answer'] === $answers[$index]['answer']) correct @elseif(!$option['isCorrect'] && isset($answers[$index]['answer']) && $option['answer'] === $answers[$index]['answer']) wrong @endif">
                                {{ $option['answer'] }}
                            </div>
                        @endforeach
                    @endif
                </div>
            @else
                <div class="quiz-card-title">
                    {{ $question['question'] }}
                </div>
                <div class="quiz-card-options">
                    <div class="quiz-card-option @if(!empty($question['answers'][0]) && !empty($question['answers'][0]['answer']) && isset($answers[$index]['answer']) && $question['answers'][0]['answer'] !== $answers[$index]['answer']) wrong @elseif(!empty($question['answers'][0]) && !empty($question['answers'][0]['answer']) && isset($answers[$index]['answer']) && $question['answers'][0]['answer'] === $answers[$index]['answer']) correct @endif">
                        @if ($question['questionType'] === 'address' && isset($answers[$index]['answer']))
                            <span>
                                {{ implode(', ', array_values(json_decode($answers[$index]['answer'], true) ?? [])) }}
                            </span>
                        @elseif ($question['questionType'] === 'date' && isset($answers[$index]['answer']))
                            <span>
                                {{ date('D M j Y', $answers[$index]['answer']) }}
                            </span>
                        @else
                            <span>
                                {{ ($answers[$index]['answer'] ?? '') ?: 'No Answer' }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endforeach

    <div class="footer">
        © FormyFi Platform {{ date('Y') }}. All rights reserved.<br />
        Please don't reply to this email.
    </div>
</div>
</body>
</html>
