  <div class = "card">
      <form action ="{{ route('posts.updateCategory', $post->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class = "card-body">
              <div class="mb-3">
                  <label for="category" class="form-label">Category</label>
                  <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror"
                         list="categoryOptions" value="{{ old('category') ?? $post->postCategory?->name }}">
                  <datalist id="categoryOptions">
                      @foreach($categories as $category)
                          <option value="{{ $category->name }}">
                      @endforeach
                  </datalist>
                  @error('category')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class = "card-footer">
              <button type="submit" class="btn btn-primary">Edit</button>
          </div>
      </form>
  </div>
