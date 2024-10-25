<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name')  }} - Form Submission</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
<div class="container my-5" style="max-width: 800px">
    <div class="header">
        <div class="mb-3">
            <h1>{{ $quest['title'] }}</h1>
        </div>
        <div>{!! strip_tags($quest['description'], '<p><br>') !!}</div>
    </div>

    <div class="mt-4">
        @foreach ($quest['questions'] as $index => $question)
            <div class="card my-3 p-3">
                <div class="d-flex justify-content-between">
                    <div>{{ $index + 1 }}/{{ count($quest['questions']) }}</div>
                    @if ($question['required'])
                        <div class="text-danger">Required</div>
                    @endif
                </div>

                @if (isset($question['file']))
                    <div class="text-center my-3">
                        <img src="{{ $message->embed(config('filesystems.disks.s3.url').'/'.$question['file']) }}"
                             class="img-thumbnail" style="object-fit: cover; width: 250px; height: 100%; border-radius: 10px" alt="">
                    </div>
                @endif

                <p class="h5 fw-bold">{{ $question['question'] }}</p>

                @if (isset($answers['answers'][$index]))
                    <div>
                        @if ($question['questionType'] === 'quiz')
                            <div class="d-flex flex-column gap-3">
                                @foreach ($question['answers'] as $answer)
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($answers['answers'][$index]['answer'] === $answer['answer'] && $answers['answers'][$index]['isCorrect'])
                                            <div class="item isCorrect">{{ $answer['answer'] }}</div>
                                        @else
                                            <div class="item isIncorrect">{{ $answer['answer'] }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @elseif ($question['questionType'] === 'multiple')
                            <div class="d-flex flex-column gap-3">
                                @foreach($question['answers'] as $answer)
                                    <div class="d-flex align-items-center gap-2">
                                        @if(isset($answers['answers'][$index]['answer']) && in_array($answer['answer'], json_decode($answers['answers'][$index]['answer'])))
                                            <div class="item isCorrect">{{ $answer['answer'] }}</div>
                                        @else
                                            <div class="item isIncorrect">{{ $answer['answer'] }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @elseif ($question['questionType'] === 'address')
                            <div class="w-100">
                                @if (isset($answers['answers'][$index]['answer']) && $answers['answers'][$index]['isCorrect'])
                                    <div class="item isCorrect">
                                        {{ implode(', ', array_values(json_decode($answers['answers'][$index]['answer'], true))) }}
                                    </div>
                                @else
                                    <div class="item isIncorrect">
                                        {{ implode(', ', array_values(json_decode($answers['answers'][$index]['answer'], true))) }}
                                    </div>
                                @endif
                            </div>
                        @elseif ($question['questionType'] === 'date')
                            <div class="w-100">
                                @if (isset($answers['answers'][$index]['answer']) && $answers['answers'][$index]['isCorrect'])
                                    <div class="item isCorrect">
                                        {{ date('D M j Y', $answers['answers'][$index]['answer']) }}
                                    </div>
                                @else
                                    <div class="item isIncorrect">
                                        {{ date('D M j Y', $answers['answers'][$index]['answer']) }}
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="w-100">
                                @if (isset($answers['answers'][$index]['answer']) && $answers['answers'][$index]['isCorrect'])
                                    <div class="item isCorrect">
                                        {{ $answers['answers'][$index]['answer'] ?: 'No Answer' }}
                                    </div>
                                @else
                                    <div class="item isIncorrect">
                                        {{ $answers['answers'][$index]['answer'] ?: 'No Answer' }}
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                @if (isset($answers['answers'][$index]['file']))
                    <div class="text-center my-3">
                        <img
                            src="{{ $message->embed(config('filesystems.disks.s3.url').'/'.$answers['answers'][$index]['file']) }}"
                            class="img-thumbnail" style="object-fit: cover; width: 250px; height: 100%; border-radius: 10px" alt="">
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
