{{-- =========================================================================
     DevConnect — My Projects Page
     Dark theme · Glassmorphism · Purple + Blue gradients · Poppins · Bootstrap 5
     ========================================================================= --}}
@extends('layouts.app')

@section('title', 'My Projects — DevConnect')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    .page-hero {
        padding: 100px 0 50px;
        text-align: center;
    }

    .page-hero .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(139, 92, 246, 0.15);
        border: 1px solid rgba(139, 92, 246, 0.3);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        color: #c4b5fd;
        margin-bottom: 16px;
    }

    .page-hero h1 {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 700;
        margin-bottom: 12px;
    }

    .page-hero p {
        color: #94a3b8;
        max-width: 560px;
        margin: 0 auto 28px;
    }

    .my-projects-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .filter-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-tabs .tab-btn {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #94a3b8;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s;
    }

    .filter-tabs .tab-btn:hover,
    .filter-tabs .tab-btn.active {
        background: linear-gradient(135deg, #7c3aed, #2563eb);
        border-color: transparent;
        color: #fff;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state i {
        font-size: 3.5rem;
        color: #7c3aed;
        margin-bottom: 20px;
        opacity: 0.7;
    }

    .empty-state h3 {
        font-size: 1.4rem;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 24px;
    }

    .project-actions {
        display: flex;
        gap: 8px;
    }

    .project-actions .btn-icon {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #cbd5e1;
        transition: all 0.2s;
    }

    .project-actions .btn-icon:hover {
        background: rgba(139, 92, 246, 0.2);
        color: #c4b5fd;
        border-color: rgba(139, 92, 246, 0.4);
    }

    .project-actions .btn-icon.danger:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border-color: rgba(239, 68, 68, 0.3);
    }

    .status-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .status-published {
        background: rgba(34, 197, 94, 0.2);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .status-draft {
        background: rgba(234, 179, 8, 0.2);
        color: #facc15;
        border: 1px solid rgba(234, 179, 8, 0.3);
    }
</style>
@endpush

@section('content')

{{-- Ambient animated gradient orbs --}}
<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<main>

    {{-- =====================================================
         Page Header
         ===================================================== --}}
    <section class="page-hero">
        <div class="container-xl">
            <span class="eyebrow">
                <i class="fa-solid fa-folder-open"></i> Your Workspace
            </span>
            <h1>My <span class="text-gradient">Projects</span></h1>
            <p>Manage, edit, and track all the projects you’ve uploaded to DevConnect.</p>
            
        </div>
    </section>

    {{-- =====================================================
         Stats Overview
         ===================================================== --}}
    <section class="stats-section" style="padding-top:0;">
        <div class="container-xl">
            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="glass-card stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-folder-open"></i></div>
                        <div class="stat-number">
                            <span>{{ $total}}</span>
                        </div>
                        <div class="stat-label">Total Projects</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="glass-card stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-heart"></i></div>
                        <div class="stat-number">
                            <span>{{ $totalLikes ?? 0 }}</span>
                        </div>
                        <div class="stat-label">Total Likes</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="glass-card stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
                        <div class="stat-number">
                            <span>{{ $avgRating ?? 0 }}</span>
                        </div>
                        <div class="stat-label">Avg. Rating</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="glass-card stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-eye"></i></div>
                        <div class="stat-number">
                            <span>{{ $totalViews ?? 0 }}</span>
                        </div>
                        <div class="stat-label">Total Views</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================
         Projects List
         ===================================================== --}}
    <section style="padding: 40px 0 100px;">
        <div class="container-xl">

            {{-- Toolbar --}}
            <div class="my-projects-toolbar">
                <div class="filter-tabs">
                    <button class="tab-btn active" data-filter="all">All</button>
                    <button class="tab-btn" data-filter="published">Published</button>
                    <button class="tab-btn" data-filter="draft">Drafts</button>
                </div>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);color:#cbd5e1;border-radius:10px;width:auto;">
                        <option>Newest First</option>
                        <option>Most Liked</option>
                        <option>Highest Rated</option>
                    </select>
                </div>
            </div>

            {{-- Projects Grid --}}
            <div class="row g-4"  id="my-projects-wrapper">
            </div>

        </div>
    </section>

</main>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cloudflare.com"></script>

<script>
    $(document).ready(function() {
        loadMyProjects();
    });


    function loadMyProjects() {
        $.ajax({
            url: "{{ route('Project.mydata') }}",
            type: "GET",
            dataType: "json",
            success: function(projects) {
                console.log(projects);
                createProjectCards(projects);

            },
            error: function(xhr) {
                console.log("data not found");
                console.log(xhr.responseText);
            }

        });

    }
    function createProjectCards(projects) {
        let output = "";

        // Agar project nahi hai
        if (projects.length === 0) {
            output += `
            <div class="no-projects">
                <h3>No Projects Found</h3>
                <p>
                    You have not uploaded any project yet.
                </p>
            </div>
        `;
            $("#my-projects-wrapper").html(output);
            return;
        }


        // Projects loop
        $.each(projects, function(index, project) {
            output += `
            <div class="col-md-6 col-lg-4 project-item"
                 data-status="published">
                <div class="glass-card project-card">
                    <!-- Project Image -->
                    <div class="project-thumb"
                         style="position:relative;">
                        <span class="project-category-tag">
                            ${project.category}
                        </span>
                        <img
                            src="/uploads/projects/${project.image}"
                            onerror="
                                this.onerror=null;
                                this.src='/uploads/projects/banner.png';
                            "
                            class="project-thumb-img"

                            alt="${project.title}"
                        >

                    </div>
                    <!-- Project Body -->
                    <div class="project-body">
                        <!-- Title -->
                        <h3 class="project-title">
                            ${project.title}
                        </h3>
                        <!-- Description -->
                        <p class="project-desc">
                            ${project.description}
                        </p>
                        
                        <!-- Technologies -->
                        <div class="tech-pills">
                            ${makeTechnology(project.technology)}
                        </div>
                        <!-- Footer -->
                        <div class="project-footer">
                            <!-- Date -->
                            <div class="project-metrics">
                                <span>
                                    <i class="fa-regular fa-user"></i>
                                ${project.user ? project.user.name : 'Unknown User'}
                                </span>
                            </div>
                            <!-- Actions -->
                            <div class="project-actions">
                               
                                    <i class="fa-solid fa-calendar"></i>
        ${formatDate(project.created_at)}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        });
        // Cards ko HTML me display karo

        $("#my-projects-wrapper").html(output);

    }

    function makeTechnology(technology) {

        let badge = '';

        let items = technology.split(',');

        $.each(items, function(index, item) {

            badge += `
        <span class="btn-icon">
            ${item.trim()}
        </span>
        `;

        });

        return badge;

    }


    function formatDate(date) {

        let d = new Date(date);

        return d.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'

        });

    }

    document.querySelectorAll('.filter-tabs .tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-tabs .tab-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            document.querySelectorAll('.project-item').forEach(card => {
                if (filter === 'all' || card.dataset.status === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush