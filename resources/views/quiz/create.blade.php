@extends('layouts.app')
@section('title', 'Create Quiz')
@section('content')
    <form action ="{{ route('quiz.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input id="registerTitle" name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                placeholder="" value="{{ old('title') }}" />
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="Body" class="form-label">Content</label>
            <textarea name="body" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
            @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Answers</label>
            <div id="answers-container">
                @if(old('answers'))
                    @foreach(old('answers') as $index => $answer)
                        <div class="input-group mb-2">
                            <span class="input-group-text">{{ $index === 0 ? 'Correct Answer' : 'Answer' }}</span>
                            <input type="text" name="answers[]" class="form-control" value="{{ $answer }}" required>
                            @if($index > 0)
                                <button class="btn btn-outline-danger remove-answer" type="button">Remove</button>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="input-group mb-2">
                        <span class="input-group-text">Correct Answer</span>
                        <input type="text" name="answers[]" class="form-control" required>
                    </div>
                @endif
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-answer">Add Answer</button>
            @error('answers')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.getElementById('answers-container');
                const addButton = document.getElementById('add-answer');

                addButton.addEventListener('click', function() {
                    const div = document.createElement('div');
                    div.className = 'input-group mb-2';
                    div.innerHTML = `
                        <span class="input-group-text">Answer</span>
                        <input type="text" name="answers[]" class="form-control" required>
                        <button class="btn btn-outline-danger remove-answer" type="button">Remove</button>
                    `;
                    container.appendChild(div);
                });

                container.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-answer')) {
                        e.target.parentElement.remove();
                    }
                });
            });
        </script>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
