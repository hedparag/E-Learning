<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Exam</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
</head>

<body class="mcq-body">

    <div class="mcq-container">

        <h1 class="mcq-chapter-title">{{ $course->title }}</h1>
        <hr>

        {{-- <form action="{{ route('student.submit-mcq') }}" method="POST" class="mcq-form"> --}}
        <form action="{{ route('student.submit-mcq', ['course_id' => $course->id]) }}" method="POST">
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

            <button type="submit" class="mcq-submit-btn">Submit</button>
        </form>
    </div>

    {{-- ------------------- JS ------------------ --}}
    {{-- @if (session('success'))
        <script>
            window.onload = function() {
                alert("{{ session('success') }}");
                window.location.href = "{{ url()->previous() }}"; // Go back to course page
            };
        </script>
    @endif

    @if (session('error'))
        <script>
            window.onload = function() {
                alert("{{ session('error') }}");
                window.location.href = "{{ url()->previous() }}"; // Go back even on error
            };
        </script>
    @endif --}}
</body>

</html>
