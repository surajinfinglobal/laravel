$(document).ready(function(){
    
  
    loadProjects();
    $("#search").on("keyup", function () {
        filterProjects();
    });

    $("#category-filter").on("change", function () {
        filterProjects();
    });

});



function filterProjects(){

    let search = $("#search").val();

    let categories = $("#category-filter").val();
    console.log(categories);
    $.ajax({

        url:'/admin/projects/search',

        type:'GET',

        data:{
            search: search,
            categories: categories
        },

        success:function(projects){

            createCards(projects);

        },

        error:function(xhr){

            console.log(xhr.responseText);

        }

    });

}
function loadProjects(){

    $.ajax({

        url:'/admin/projects/data',

        type:'GET',

        success:function(projects){
console.log(projects);
            createCards(projects);

        }

    });

}
function createCards(projects){

    let output='';

    $.each(projects,function(index,project){

        output+=createCard(project);

    });

    $(".projects-wrapper").html(output);

}
function makeTechnology(technology){

    let badge='';

    let items=technology.split(',');

    $.each(items,function(index,item){

        badge+=`
        <span class="tech-tag">
            ${item.trim()}
        </span>
        `;

    });

    return badge;

}
function formatDate(date){

    let d=new Date(date);

    return d.toLocaleDateString('en-GB',{

        day:'2-digit',

        month:'short',

        year:'numeric'

    });

}
function createCard(project) {
    let image = project.image
        ? `/uploads/projects/${project.image}`
        : `/uploads/projects/banner.png`;

    let isPublished = project.is_published == 1
        || project.is_published === true
        || project.status === 'published';

    // plan column: free / premium
    let plan = (project.plan || 'free').toLowerCase();

    return `
<div class="project-card" data-project='${JSON.stringify(project).replace(/'/g, "&#39;")}'>

    <div class="card-top-controls">
       <label class="publish-toggle" title="${isPublished ? 'Published' : 'Unpublished'}">
    <input type="checkbox" class="publish-status" data-id="${project.id}" ${isPublished ? 'checked' : ''}>
    <span class="toggle-slider"></span>
    <span class="toggle-label">${isPublished ? 'Published' : 'Unpublished'}</span>
</label>
        <select class="plan-select" data-id="${project.id}">
            <option value="free" ${plan === 'free' ? 'selected' : ''}>Free</option>
            <option value="premium" ${plan === 'premium' ? 'selected' : ''}>Premium</option>
        </select>
    </div>

    <img src="${image}"
         onerror="this.onerror=null;this.src='/uploads/projects/banner.png';"
         alt="${project.title}">

    <div class="card-body">
        <h2 class="card-title">${project.title}</h2>
        <p class="card-description">${project.description ?? ''}</p>
        <div class="category">${project.category ?? ''}</div>
        <div class="username">
            <i class="fa-solid fa-user"></i>
            ${project.user ? project.user.name : 'Unknown User'}
        </div>
        <div class="tech-container">${makeTechnology(project.technology || '')}</div>
        <div class="card-footer">
            <div class="upload-date">
                <i class="fa-solid fa-calendar"></i>
                ${formatDate(project.created_at)}
            </div>
            <div class="project-rating">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
        </div>
    </div>
</div>`;
}

// Toggle change → status update

    // Label text update
   
$(document).on("change", ".publish-status", function () {

    let checkbox = $(this);
    let projectId = checkbox.data("id");
    let is_published = checkbox.is(":checked") ? 1 : 0;

    $.ajax({
        url: `/admin/projects/publish-status/${projectId}`,
        type: "POST",
        data: {
            is_published: is_published,
            _method: "PATCH",
            _token: $('meta[name="csrf-token"]').attr("content")
        },
        success: function (res) {

            let label = checkbox.closest(".publish-toggle").find(".toggle-label");

            if (is_published) {
                label.text("Published");
                checkbox.closest(".publish-toggle").attr("title", "Published");
            } else {
                label.text("Unpublished");
                checkbox.closest(".publish-toggle").attr("title", "Unpublished");
            }

        },
        error: function () {
            // Error aaye to checkbox wapas previous state me le aao
            checkbox.prop("checked", !is_published);
        }
    });

});

$(document).on("change", ".plan-select", function () {

    let projectId = $(this).data("id");
    let visibility = $(this).val();

    $.ajax({
        url: `/admin/projects/visibility/${projectId}`,
        type: "POST",
        data: {
            visibility: visibility,
            _method: "PATCH",
            _token: $('meta[name="csrf-token"]').attr("content")
        },
        success: function (res) {
            console.log("Visibility Updated", res);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });

})

