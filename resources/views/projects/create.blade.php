

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Project</title>
</head>
<style>

body{
    margin:0;
    font-family:'Inter',sans-serif;
    background:#06080d;
    color:#fff;
}

.container{
    max-width:900px;
    margin:50px auto;
    padding:20px;
}

.page-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:30px;
}

.btn-back{
    text-decoration:none;
    color:#fff;
    background:#2563eb;
    padding:10px 18px;
    border-radius:8px;
    font-weight:600;
    transition:.3s;
}

.btn-back:hover{
    background:#1d4ed8;
}
    .container{
    max-width:900px;
    margin:auto;
    padding:40px;
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.page-header h2{
    color:white;
}

.btn-back{
    text-decoration:none;
    background:#3b82f6;
    color:#fff;
    padding:10px 20px;
    border-radius:8px;
}

.project-form{

    background:rgba(255,255,255,.05);

    backdrop-filter:blur(15px);

    border:1px solid rgba(255,255,255,.08);

    border-radius:18px;

    padding:35px;

}

.form-group{

    display:flex;

    flex-direction:column;

    margin-bottom:22px;

}

.form-group label{

    color:white;

    margin-bottom:10px;

    font-weight:600;

}

.form-group input,

.form-group textarea,

.form-group select{

    background:#1e293b;

    border:none;

    border-radius:10px;

    padding:15px;

    color:white;

    font-size:15px;

}

.form-group input:focus,

.form-group textarea:focus,

.form-group select:focus{

    outline:none;

    border:1px solid #3b82f6;

}

.btn-upload{

    width:100%;

    background:#2563eb;

    border:none;

    padding:16px;

    color:white;

    font-size:18px;

    border-radius:10px;

    cursor:pointer;

    transition:.3s;

}

.btn-upload:hover{

    background:#1d4ed8;

}
</style>
<body>
<div class="container">
    <div class="page-header">
        <h2>Upload New Project</h2>
        <a href="{{ url('home/project') }}" class="btn-back">← Back</a>
    </div>
    <form action="{{ route('projects.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="project-form">

        @csrf

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
                <option>PHP</option>
            </select>
        </div>

        <div class="form-group">
            <label>Project Thumbnail</label>

            <input type="file"
                   name="image"
                   accept="image/*">
        </div>

        <div class="form-group">
            <label>GitHub URL</label>

            <input type="url"
                   name="github"
                   placeholder="https://github.com/...">
        </div>

        <div class="form-group">
            <label>Live Demo URL</label>

            <input type="url"
                   name="demo"
                   placeholder="https://example.com">
        </div>

        <div class="form-group">
            <label>Technologies Used</label>

            <input type="text"
                   name="technology"
                   placeholder="Laravel, PHP, MySQL, Bootstrap">
        </div>

        <div class="form-group">
            <label>Status</label>

            <select name="status">
                <option value="Completed">Completed</option>
                <option value="In Progress">In Progress</option>
                <option value="Pending">Pending</option>
            </select>
        </div>

        <div class="form-group">
            <label>Short Description</label>

            <textarea name="description"
                      rows="6"
                      placeholder="Write project details..."></textarea>
        </div>

        <button class="btn-upload">
            Upload Project
        </button>

    </form>

</div>

</div>

</body>
</html>