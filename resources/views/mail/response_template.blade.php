<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name')  }} - Form Submission</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5" style="max-width: 800px">
    <div class="header">
        <img src="{{ $message->embed(config('filesystems.disks.s3.url').'/'.$quest['image']) }}"
             class="img-thumbnail" style="object-fit: cover; max-width: 800px; width:100%; border-radius: 10px" alt="">
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

                <p>
                    <span style="font-weight: bold;">{{ $question['question'] }} -- </span>
                    @if (isset($answers[$index]))
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
                    @endif
                </p>
            </div>
            <hr>
        @endforeach
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
