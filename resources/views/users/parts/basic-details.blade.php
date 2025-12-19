  <div class = "card">
      <form action ="{{ route('users.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class = "card-header">
            Basic Details
          </div>
          <div class = "card-body">
              <div class="mb-3">
                  <label for="Name" class="form-label">Name</label>
                  <input id="registerFullName" name="name" type="text"
                      class="form-control @error('name') is-invalid @enderror" placeholder=""
                      value="{{ old('name') ?? $user->name }}" />
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="Email" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                      value="{{ old('email') ?? $user->email }}" />
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="Password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" />

                  @error('password')
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
