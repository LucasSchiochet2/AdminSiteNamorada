  <div class = "card">
      <form action ="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
                      value="{{ old('title') ?? $post->title }}" />
                  @error('title')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="Body" class="form-label">Content</label>
                  <input type="body" name="body" class="form-control @error('body') is-invalid @enderror"
                      value="{{ old('body') ?? $post->body }}" />
                  @error('body')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="Photo" class="form-label">Photo</label>
                  <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                      value="{{ old('photo') }}">
                  @if($post->photo)
                      <div class="form-text">Current file: {{ basename($post->photo) }}</div>
                  @endif
                  @error('photo')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class = "card-footer">
                  <button type="submit" class="btn btn-primary">Edit</button>
              </div>
              </div>
            </form>

  </div>
