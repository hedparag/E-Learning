<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Exam</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <style>
        #mcq-timer {
            font-size: 1.1rem;
            font-weight: 600;
            color: #d9534f;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="mcq-body">

    <div class="mcq-container">
        <h1 class="mcq-chapter-title">{{ $course->title }}</h1>

        <div id="mcq-timer" data-minutes="{{ $durationMinutes }}">
            Time left: <span id="time-text"></span>
        </div>
        <hr>

        {{-- <form action="{{ route('student.submit-mcq') }}" method="POST" class="mcq-form"> --}}
        <form action="{{ route('student.submit-mcq',$course->id) }}" method="POST">
            @csrf

            @foreach ($questions as $index => $question)
                <div class="mcq-question-block">
                    <div class="mcq-question-text">
                        {{ $index + 1 }}. {{ $question->text }}
                    </div>
                    @foreach ($question->options as $option)
                        <div class="mcq-option-block">
                            @if ($question->type === 'single')
                                <label class="mcq-option-label">
                                    <input type="radio" name="answers[{{ $question->id }}]"
                                        value="{{ $option }}" class="mcq-option-input" />
                                    <span>{{ $option }}</span>
                                </label>
                            @else
                                <label class="mcq-option-label">
                                    <input type="checkbox" name="answers[{{ $question->id }}][]"
                                        value="{{ $option }}" class="mcq-option-input" />
                                    <span>{{ $option }}</span>
                                </label>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach

            <button id="mcq-submit" type="submit" class="mcq-submit-btn">Submit</button>
        </form>
    </div>


    <script>
        (() => {
            const timerEl = document.getElementById('mcq-timer');
            const timeText = document.getElementById('time-text');
            const form = document.getElementById('mcq-form');
            const submitBtn = document.getElementById('mcq-submit');

            // total time in seconds
            let remaining = parseInt(timerEl.dataset.minutes, 10) * 60;

            const fmt = s => {
                const m = String(Math.floor(s / 60)).padStart(2, '0');
                const sc = String(s % 60).padStart(2, '0');
                return `${m}:${sc}`;
            };

            // initial text
            timeText.textContent = fmt(remaining);

            const countdown = setInterval(() => {
                remaining -= 1;
                timeText.textContent = fmt(remaining);

                if (remaining <= 0) {
                    clearInterval(countdown);
                    submitBtn.disabled = true;
                    timeText.textContent = '00:00';
                    form.submit();
                }
            }, 1000);
        })();
    </script>
</body>

</html>
