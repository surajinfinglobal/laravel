{{-- =========================================================================
     DevConnect — Upload Project Page
     Fields used exactly as provided: image, github, demo, technology, status, description
     ========================================================================= --}}
@extends('layouts.app')

@section('title', 'Upload Project — DevConnect')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
@endpush

@section('content')

<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>


<main class="upload-wrapper">
    <div class="container-xl">

        <div class="glass-card upload-card reveal in-view">

            <div class="upload-header">
                <span class="eyebrow"><i class="fa-solid fa-cloud-arrow-up"></i> Share Your Work</span>
                <h1>Upload Your Project</h1>
                <p>Add your project details below so other developers can discover, like, and rate your work.</p>
            </div>

            @if ($errors->any())
                <div class="auth-alert">
                    <i class="fa-solid fa-circle-exclamation"></i> Please fix the errors below and try again.
                </div>
            @endif

          
                 <form  action="{{ route('projects.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="upload-form">
                @csrf

                <div class="form-group">
                    <label>Project Thumbnail</label>

                    <div class="file-drop" id="fileDrop">
                        <i class="fa-solid fa-image"></i>
                        <div class="file-drop-text">Click to upload or drag and drop</div>
                        <div class="file-drop-hint">PNG, JPG or WEBP — up to 5MB</div>
                        <input type="file"
                               name="image"
                               id="image"
                               accept="image/*">
                    </div>
                    <div class="file-name" id="fileName">
                        <i class="fa-solid fa-paperclip"></i>
                        <span id="fileNameText"></span>
                    </div>
                    @error('image')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                     <div class="form-group">
            <label>Project Title</label>
            <input type="text"
                   name="title"
                   placeholder="Enter project title"
                   required>
        </div>
        <div class="form-group">
            <label>Category</label>

            <select name="category">
                <option>Web Development</option>
                <option>Mobile App</option>
                <option>UI/UX Design</option>
                <option>Laravel</option>
                
                <option>Machine Learning</option>
                <option>Flutter</option>
                <option>React</option>
                <option>PHP</option>
            </select>
        </div>
                <div class="form-group">
                    <label>GitHub URL</label>

                    <input type="url"
                           name="github"
                           placeholder="https://github.com/...">
                    @error('github')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Live Demo URL</label>

                    <input type="url"
                           name="demo"
                           placeholder="https://example.com">
                    @error('demo')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Technologies Used</label>

                    <input type="text"
                           name="technology"
                           placeholder="Laravel, PHP, MySQL, Bootstrap">
                    @error('technology')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Status</label>

                    <select name="status">
                        <option value="Completed">Completed</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Pending">Pending</option>
                    </select>
                    @error('status')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Short Description</label>

                    <textarea name="description"
                              rows="6"
                              placeholder="Write project details..."></textarea>
                    @error('description')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn-upload" type="submit">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Project
                </button>

            </form>

        </div>

    </div>
</main>

@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/upload.js') }}"></script>
@endpush