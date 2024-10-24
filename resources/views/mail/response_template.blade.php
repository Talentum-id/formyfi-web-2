<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name')  }} - Form Submission</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .item {
            width: 100%;
            display: flex;
            padding: 7px 12px;
            align-items: center;
            gap: 4px;
            border-radius: 8px;
            background: #f5f7fa;
            font-variant-numeric: lining-nums tabular-nums slashed-zero;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: 24px;
        }

        .isCorrect {
            background: #ddfadc;
        }

        .isIncorrect {
            background: #fae5dc;
        }
    </style>
</head>
<body>
<div class="result-wrapper">
    <div class="header">
        <div class="head-title">
            <span>{{ $quest['title'] }}</span>
        </div>
        <div class="title">{{ strip_tags($quest['description'], '<p><br>') }}</div>
    </div>
    <div class="flex flex-col w-full gap-[16px] mt-[32px]">
        @foreach($quest['questions'] as $index => $question)
            <div>
                <div class="card">
                    <div class="head flex justify-between w-full">
                        <div class="step">{{ $index + 1 }}/{{ count($quest['questions']) }}</div>
                        @if($question['required'])
                            <div class="required">Required</div>
                        @endif
                    </div>
                    @if (isset($question['file']))
                        <div class="w-full flex justify-center">
                            <img src="{{ $question['file'] }}" class="w-[160px] h-[160px]" alt="">
                        </div>
                    @endif
                    <span class="title">{{ $question['question'] }}</span>
                    @if (isset($answers[$index]))
                        <div>
                            @if ($question['questionType'] === 'quiz')
                                <div class="flex flex-col gap-[16px] w-full">
                                    @foreach($question['answers'] as $answer)
                                        <div class="flex items-center gap-x-[8px]">
                                            @if($answers[$index]['answer'] === $answer['answer'] && $answers[$index]['isCorrect'])
                                                <img src="{{asset('assets/icons/completed.svg')}}" alt="incorrect"/>
                                                <div class="item isCorrect">{{ $answer['answer'] }}</div>
                                            @else
                                                <img src="{{ asset('assets/icons/incorrect.svg') }}" alt="incorrect"/>
                                                <div class="item isIncorrect">{{ $answer['answer'] }}</div>
                                            @endif
                                        </div>
                                        @if ($question['openAnswerAllowed'] && !in_array($anwers[$index]['answer'], array_column($question['answers'], 'answer')))
                                            <img src="{{asset('assets/icons/completed.svg')}}" alt="incorrect"/>
                                            <div class="item isCorrect">{{ $answer['answer'] }}</div>
                                        @endif
                                    @endforeach
                                </div>
                            @elseif ($question['questionType'] === 'multiple')
                                <div class="flex flex-col gap-[16px] w-full">
                                    @foreach($question['answers'] as $answer)
                                        <div class="flex items-center gap-x-[8px]">
                                            @if(isset($answers[$index]['answer']) && in_array($answer['answer'], json_decode($answer[$index]['answer'])))
                                                <img src="{{asset('assets/icons/completed.svg')}}" alt="incorrect"/>
                                                <div class="item isCorrect">{{ $answer['answer'] }}</div>
                                            @else
                                                <img src="{{ asset('assets/icons/incorrect.svg') }}" alt="incorrect"/>
                                                <div class="item isIncorrect">{{ $answer['answer'] }}</div>
                                            @endif
                                        </div>
                                        @if ($question['openAnswerAllowed'] && !in_array($anwers[$index]['answer'], array_column($question['answers'], 'answer')))
                                            <img src="{{asset('assets/icons/completed.svg')}}" alt="incorrect"/>
                                            <div class="item isCorrect">{{ $answer['answer'] }}</div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="w-full">
                                    @if ($question['questionType'] === 'address')
                                        @if(isset($answers[$index]['answer']) || $answers[$index]['isCorrect'])
                                            <img src="{{asset('assets/icons/completed.svg')}}" alt="incorrect"/>
                                            <div class="item isCorrect">{{ implode(', ', array_values(json_decode($answer['answer'])) }}</div>
                                        @else
                                            <img src="{{ asset('assets/icons/incorrect.svg') }}" alt="incorrect"/>
                                            <div class="item isIncorrect">{{ implode(', ', array_values(json_decode($answer['answer'])) }}</div>
                                        @endif
                                    @elseif ($question['questionType'] === 'date')
                                        @if(isset($answers[$index]['answer']) || $answers[$index]['isCorrect'])
                                            <img src="{{asset('assets/icons/completed.svg')}}" alt="incorrect"/>
                                            <div class="item isCorrect">{{ date('D M j Y', $answers[$index]['answer']) }}</div>
                                        @else
                                            <img src="{{ asset('assets/icons/incorrect.svg') }}" alt="incorrect"/>
                                            <div class="item isIncorrect">{{ date('D M j Y', $answers[$index]['answer']) }}</div>
                                        @endif
                                    @else
                                        @if(isset($answers[$index]['answer']) || $answers[$index]['isCorrect'])
                                            <img src="{{asset('assets/icons/completed.svg')}}" alt="incorrect"/>
                                            <div class="item isCorrect">{{ $answers[$index]['answer'] ?: 'No Answer' }}</div>
                                        @else
                                            <img src="{{ asset('assets/icons/incorrect.svg') }}" alt="incorrect"/>
                                            <div class="item isIncorrect">{{ $answers[$index]['answer'] ?: 'No Answer' }}</div>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif
                    @if (isset($answers[$index]['file']))
                        <div>
                            <img src="{{ $answers[$index]['file'] }}" class="w-[160px] h-[160px]" alt="">
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
