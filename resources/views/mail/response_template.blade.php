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
        }
        .header {
            text-align: center;
        }
        .header svg {
            max-height: 200px;
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
            margin-top: 32px;
            line-height: 1.7;
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
            display: flex;
            flex-direction: column;
            align-items: center;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        .quiz-card-step {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }
        .quiz-card-required {
            font-size: 9px;
            color: #eb6854;
            font-weight: 500;
        }
        .quiz-card-title {
            font-size: 18px;
            font-weight: 500;
            color: #23263b;
            margin-bottom: 16px;
        }
        .quiz-card-image {
            margin-bottom: 16px;
            text-align: center;
        }
        .quiz-card-options {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .quiz-card-option {
            background: #f1f5f9;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 15px;
            color: #23263b;
            display: flex;
            align-items: center;
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
            max-width: 756px;
            height: 160px;
            object-fit: cover;
            border-radius: 12px;
            display: block;
            margin: 0 auto 16px auto;
        }
        .cover-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        .cover-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }
        .cover-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #64748b;
        }
        .cover-users {
            display: inline-flex;
            align-items: center;
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
        }
        .cover-steps {
            display: flex;
            align-items: center;
            gap: 12px;
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
    </style>
</head>
<body>
<div class="container">
    <!-- Блок-обложка и инфо -->

    <div class="header">
        <svg
            width="1016"
            height="200"
            viewBox="0 0 1016 200"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <g clip-path="url(#clip0_10289_51512)">
                <rect width="1016" height="200" fill="#38405B" />
                <mask
                    id="mask0_10289_51512"
                    style="mask-type: alpha"
                    maskUnits="userSpaceOnUse"
                    x="-1"
                    y="0"
                    width="1017"
                    height="200"
                >
                    <rect
                        x="1016"
                        y="200"
                        width="1016"
                        height="200"
                        transform="rotate(180 1016 200)"
                        fill="#38405B"
                    />
                </mask>
                <g mask="url(#mask0_10289_51512)">
                    <rect
                        opacity="0.45"
                        width="798.068"
                        height="916.369"
                        transform="matrix(-0.966436 0.256907 -0.864519 -0.502601 774.131 232.688)"
                        fill="url(#paint0_linear_10289_51512)"
                    />
                    <rect
                        opacity="0.3"
                        width="790.477"
                        height="931.415"
                        transform="matrix(-0.963949 -0.266089 0.872551 -0.488522 406.023 424.848)"
                        fill="url(#paint1_linear_10289_51512)"
                    />
                    <path
                        d="M542.745 107.396L550.916 86.1387H557.435L544.055 118.447C542.246 122.977 540.998 125 536.726 125H529.615V119.807H537.069L539.377 114.25C539.34 114.161 532.002 96.741 527.474 86.1387H534.449L542.745 107.396ZM443.764 85.8066C452.403 85.8066 458.328 91.604 458.328 100.119C458.328 108.695 452.402 114.432 443.764 114.432C435.063 114.401 429.199 108.664 429.199 100.119C429.199 91.6041 435.062 85.8067 443.764 85.8066ZM516.866 85.8066C522.698 85.8066 526.316 89.6108 526.316 96.1328V114.1H520.391V96.6768C520.391 93.3553 518.863 91.0909 515.65 91.0908C512.376 91.0908 510.474 93.5368 510.474 96.8281V114.1H504.548V96.6768C504.548 93.6271 503.3 91.0909 499.683 91.0908C496.408 91.0908 494.599 93.5363 494.599 96.9785V114.069H488.673V86.1387H494.1V88.9766C495.69 86.9536 498.154 85.8068 501.272 85.8066C504.609 85.8066 507.323 87.3768 508.727 89.9434C510.473 87.3768 513.249 85.8067 516.866 85.8066ZM596.907 86.1387C599.652 86.1389 601.896 88.3127 601.896 90.9697V108.937H610.13V114.1H587.395V108.906H595.753V91.3018H587.395V86.1387H596.907ZM472.519 90.8789C473.922 88.4332 476.417 86.1387 481.5 86.1387H484.713V91.6641H480.533V91.6338C474.608 91.6339 472.644 95.7711 472.644 100.149V108.876H480.877V114.069H460.387V108.876H466.53V91.3018H460.387V86.1387H472.519V90.8789ZM426.455 98.3076H410.362V113.888H404V100.119C404 94.9859 406.682 92.4492 411.922 92.4492H426.455V98.3076ZM584.429 98.3076H568.336V113.888H561.974V100.119C561.974 94.9859 564.656 92.4492 569.896 92.4492H584.429V98.3076ZM443.764 90.8486C438.743 90.8486 435.405 94.7142 435.405 100.119C435.405 105.524 438.743 109.389 443.764 109.389C448.722 109.389 452.06 105.524 452.06 100.119C452.06 94.7142 448.722 90.8486 443.764 90.8486ZM429.012 80.4619H410.362V90.3926H404V82.0928C404 77.2917 406.682 74.6035 411.734 74.6035H429.012V80.4619ZM586.986 74.6035V80.4619H568.336V90.3926H561.974V82.0928C561.974 77.2917 564.656 74.6036 569.708 74.6035H586.986ZM598.778 74C601.086 74.0001 602.895 75.6309 602.895 77.8652C602.894 80.1599 601.086 81.7899 598.778 81.79C596.533 81.8202 594.724 80.16 594.724 77.8652C594.724 75.6308 596.533 74 598.778 74Z"
                        fill="white"
                    />
                </g>
            </g>
            <defs>
                <linearGradient
                    id="paint0_linear_10289_51512"
                    x1="9.32816e-07"
                    y1="306.305"
                    x2="798.068"
                    y2="306.305"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop stop-color="#DAD9F7" />
                    <stop offset="0.416663" stop-color="#38405B" stop-opacity="0" />
                </linearGradient>
                <linearGradient
                    id="paint1_linear_10289_51512"
                    x1="9.23942e-07"
                    y1="311.334"
                    x2="790.477"
                    y2="311.334"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop stop-color="#DAD9F7" />
                    <stop offset="0.416663" stop-color="#38405B" stop-opacity="0" />
                </linearGradient>
                <clipPath id="clip0_10289_51512">
                    <rect width="1016" height="200" fill="white" />
                </clipPath>
            </defs>
        </svg>
    </div>
    <div class="cover-block">
        <img
            class="cover-img"
            src="{{ $message->embed(config('filesystems.disks.s3.url').'/'.$quest['image']) }}"
            alt=""
        />

        <div class="cover-info">
            <img
                src=""
                alt="avatar"
                class="cover-avatar"
            />
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
            <div class="quiz-card-header">
                <span class="quiz-card-step">{{ $index + 1 }}/{{ count($quest['questions']) }}</span>
                @if ($question['required'])
                    <span class="quiz-card-required">Required</span>
                @endif
            </div>
            @if (in_array($question['questionType'], ['quiz']))
                <div class="quiz-card-title">{{ $question['question'] }}</div>
                <div class="quiz-card-options">
                    @if ($question['questionType'] === 'miltiple')
                        @foreach ($question['answers'] as $option)
                            <div class="quiz-card-option @if($option['isCorrect']) correct @elseif(!$option['isCorrect'] && in_array($option['answer'], $answers[$index]['answer'])) wrong @endif">
                                {{ $option['answer'] }}
                            </div>
                        @endforeach
                    @else
                        @foreach ($question['answers'] as $option)
                            <div class="quiz-card-option @if($option['isCorrect']) correct @elseif(!$option['isCorrect'] && $option['answer'] === $answers[$index]['answer']) wrong @endif">
                                {{ $option['answer'] }}
                            </div>
                        @endforeach
                    @endif
            @else
                <div class="quiz-card-title">
                    {{ $question['question'] }}
                </div>
                <div class="quiz-card-options">
                    <div class="quiz-card-option @if(!empty($question['answers']) && $question['answers'][0] !== $answers[$index]['answer']) wrong @else correct @endif }}">
                        @if ($question['questionType'] === 'address')
                            <span>
                                {{ implode(', ', array_values(json_decode($answers[$index]['answer'], true))) }}
                            </span>
                        @elseif ($question['questionType'] === 'date')
                            <span>
                                {{ date('D M j Y', $answers[$index]['answer']) }}
                            </span>
                        @else
                            <span>
                                {{ $answers[$index]['answer'] ?: 'No Answer' }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif
            <div class="footer">
                © FormyFi Platform {{ date('Y') }}. All rights reserved.<br />
                Please don't reply to this email.
            </div>
        </div>
    @endforeach
</body>
</html>
