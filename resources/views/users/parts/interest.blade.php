  <div class = "card">
      <form action ="{{ route('users.updateInterest', $user->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class = "card-header">
              Interest
          </div>
          <div class = "card-body">
              @foreach (['Games', 'Sports', 'Movies', 'Gym'] as $interest)
                  <div class="form-check">
                      <input class="form-check-input"
                            type="checkbox"
                            value="{{ $interest }}"
                            id="checkDefault"
                            name= "interests[][name]"
                            @checked(in_array($interest, $user->userInterests->pluck('name')->toArray()))>
                      <label class="form-check-label" for="checkDefault">
                          {{ $interest }}
                      </label>
                  </div>
                  @if($loop->last)
                      @error('interests')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  @endif
              @endforeach
          </div>
          <div class = "card-footer">
              <button type="submit" class="btn btn-primary">Edit</button>
          </div>
      </form>
  </div>
