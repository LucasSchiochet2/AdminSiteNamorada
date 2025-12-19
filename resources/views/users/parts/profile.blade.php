  <div class = "card">
      <form action ="{{ route('users.updateProfile', $user->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class = "card-header">
              Profile
          </div>
          <div class = "card-body">
              <div class="mb-3">
                  <label for="Bio" class="form-label">Bio</label>
                  <input id="registerFullBio" name="bio" type="text"
                      class="form-control @error('bio') is-invalid @enderror" placeholder=""
                      value="{{ old('bio') ?? $user->profile?->bio }}" />
                  @error('bio')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <label for="Document" class="form-label">Document</label>
                  <select name="document" id="document" class = "form-control @error('document') is-invalid @enderror">
                      <option value="ID" {{ (old('document') ?? $user->profile?->document) == 'ID' ? 'selected' : '' }}>ID
                      </option>
                      <option value="Passport"
                          {{ (old('document') ?? $user->profile?->document) == 'Passport' ? 'selected' : '' }}>Passport</option>
                  </select>
                  @error('document')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              {{-- <div class="mb-3">
                  <label for="Avatar" class="form-label">Avatar</label>
                  <input id="avatar" name="avatar" type="file"
                      class="form-control @error('avatar') is-invalid @enderror" placeholder=""
                      value="{{ old('avatar') ?? $user->avatar }}" />
                  @error('avatar')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div> --}}
          </div>
          <div class = "card-footer">
              <button type="submit" class="btn btn-primary">Edit</button>
          </div>
      </form>
  </div>
