<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #00b4db, #0083b0);
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
    }
    
    .main-container {
      background-color: white;
      border-radius: 0;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      width: 100%;
    }
    
    .header {
      text-align: center;
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #eaeaea;
    }
    
    .app-title {
      font-size: 1.5rem;
      color: #0083b0;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }
    
    h2 {
      font-size: 1.75rem;
      color: #333;
      font-weight: 600;
    }
    
    .form-control {
      padding: 0.6rem 0.75rem;
      border: 1px solid #dee2e6;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      box-shadow: 0 0 0 3px rgba(0, 131, 176, 0.25);
      border-color: #0083b0;
    }
    
    .form-label {
      font-weight: 500;
      color: #444;
    }
    
    .btn-primary {
      font-weight: 500;
      padding: 0.6rem 1.5rem;
      background: linear-gradient(to right, #00b4db, #0083b0);
      border: none;
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      background: linear-gradient(to right, #0083b0, #006f94);
      box-shadow: 0 3px 8px rgba(0, 131, 176, 0.3);
    }
    
    .error {
      color: #dc3545;
      font-size: 0.9rem;
      margin-top: 0.5rem;
      padding: 0.25rem 0.5rem;
      background-color: rgba(220, 53, 69, 0.1);
      border-radius: 0.25rem;
    }
    
    .success {
      color: #198754;
      font-size: 0.9rem;
      margin-top: 0.5rem;
      padding: 0.25rem 0.5rem;
      background-color: rgba(25, 135, 84, 0.1);
      border-radius: 0.25rem;
    }
    
    .divider {
      margin: 1.5rem 0;
      border-top: 1px solid #eaeaea;
    }
    
    .section-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #0083b0;
      margin-bottom: 1rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid rgba(0, 131, 176, 0.2);
    }
    
    .input-group-text {
      background-color: #f8f9fa;
      border-right: none;
    }
    
    .input-group .form-control {
      border-left: none;
    }
    
    .footer {
      text-align: center;
      margin-top: 1.5rem;
      padding-top: 1rem;
      border-top: 1px solid #eaeaea;
    }
    
    .back-link {
      color: #0083b0;
      text-decoration: none;
    }
    
    .back-link:hover {
      text-decoration: underline;
      color: #006f94;
    }
    
    /* Profile image styles */
    .profile-image-container {
      text-align: center;
      margin-bottom: 2rem;
    }
    
    .profile-image {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #fff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      margin-bottom: 1rem;
    }
    
    .image-upload-container {
      margin-top: 1rem;
    }
    
    .btn-outline-secondary {
      color: #6c757d;
      border-color: #ced4da;
      background-color: #f8f9fa;
      transition: all 0.2s ease;
    }
    
    .btn-outline-secondary:hover {
      background-color: #e9ecef;
      color: #495057;
    }
    
    .custom-file-upload {
      display: inline-block;
      cursor: pointer;
    }
    
    .custom-file-input {
      display: none;
    }
  </style>
</head>
<body>

  <div class="main-container">
    <div class="header">
      <div class="app-title">
        <i class="fas fa-user-edit me-2"></i>User Management
      </div>
      <h2>Edit Profile</h2>
    </div>
    
    @if(session('success'))
      <div class="success">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
      </div>
    @endif
    
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      
      <!-- Profile Photo -->
      <div class="profile-image-container">
        <img id="preview" src="{{ auth()->user()->profileImg ? asset(auth()->user()->profileImg) : asset('images/default-avatar.png') }}" 
             alt="Profile Photo" class="profile-image">
        
        <div class="image-upload-container">
          <label for="profileImg" class="btn btn-outline-secondary custom-file-upload">
            <i class="fas fa-camera me-2"></i>Change Photo
          </label>
          <input type="file" name="profileImg" id="profileImg" class="custom-file-input" accept="image/*">
          
          @error('profileImg')
            <div class="error mt-2">
              <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
            </div>
          @enderror
          
          <div class="form-text mt-1">Recommended: Square image, max 2MB</div>
        </div>
      </div>
      
      <!-- Profile Information -->
      <div class="section-title">
        <i class="fas fa-id-card me-2"></i>Profile Information
      </div>
      
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fas fa-user text-muted"></i>
          </span>
          <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>
        @error('name')
          <div class="error">
            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
          </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fas fa-envelope text-muted"></i>
          </span>
          <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled readonly>
        </div>
        <small class="text-muted mt-1 d-block">Your email cannot be changed</small>
      </div>
      
      <div class="divider"></div>
      
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Save Changes
        </button>
      </div>
    </form>
    
    <div class="footer">
      <a href="{{ url('home') }}" class="back-link">
        <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
      </a>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Preview uploaded image before form submission
  document.getElementById('profileImg').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    const file = e.target.files[0];
    
    if (file) {
      const reader = new FileReader();
      reader.onload = function(event) {
        preview.src = event.target.result;
      }
      reader.readAsDataURL(file);
    }
  });
</script>
</body>
</html>