<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Exam</title>
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}?v={{ time() }}"> --}}
    <style>
        /* QUESTIONS */

        .mcq-body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 2rem;
        }

        .mcq-container {
            max-width: 960px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .mcq-chapter-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-align: center;
            color: #1e3a8a;
        }

        .mcq-form {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .mcq-question-block {
            margin-bottom: 2rem;
            margin-top: 2rem;
        }

        .mcq-question-text {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .mcq-option-block {
            margin-bottom: 0.5rem;
        }

        .mcq-option-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
        }

        .mcq-option-input[type="radio"],
        .mcq-option-input[type="checkbox"] {
            accent-color: #2563eb;
            width: 1rem;
            height: 1rem;
        }

        .mcq-submit-btn {
            background-color: #2563eb;
            color: white;
            padding: 0.6rem 1.4rem;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .mcq-submit-btn:hover {
            background-color: #1e3a8a;
        }

        .mcq-quiz-btn {
            width: auto;
            padding: 6px 16px;
            font-size: 0.9rem;
            display: inline-block;
        }
    </style>
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
</body>

</html>
