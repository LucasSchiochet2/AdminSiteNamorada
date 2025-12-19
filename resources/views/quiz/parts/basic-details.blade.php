  <div class = "card">
      <form action ="{{ route('quiz.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class = "card-header">
              Basic Details
          </div>
          <div class = "card-body">
              <div class="mb-3">
                  <label for="Title" class="form-label">Title</label>
                  <input id="registerFullTitle" name="title" type="text"
                      class="form-control @error('title') is-invalid @enderror" placeholder=""
                      value="{{ old('title') ?? $quiz->title }}" />
                  @error('title')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="Body" class="form-label">Content</label>
                  <input type="body" name="body" class="form-control @error('body') is-invalid @enderror"
                      value="{{ old('body') ?? $quiz->body }}" />
                  @error('body')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3">
                  <label class="form-label">Answers</label>
                  <div id="answers-container">
                      @php
                          $answers = old('answers') ?? $quiz->answers ?? [];
                          if (empty($answers)) {
                              $answers = [''];
                          }
                      @endphp

                      @foreach ($answers as $index => $answer)
                          <div class="input-group mb-2">
                              <span class="input-group-text">{{ $index === 0 ? 'Correct Answer' : 'Answer' }}</span>
                              <input type="text" name="answers[]" class="form-control" value="{{ $answer }}" required>
                              @if ($index > 0)
                                  <button class="btn btn-outline-danger remove-answer" type="button">Remove</button>
                              @endif
                          </div>
                      @endforeach
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
              <div class = "card-footer">
                  <button type="submit" class="btn btn-primary">Edit</button>
              </div>
          </div>
      </form>

  </div>
