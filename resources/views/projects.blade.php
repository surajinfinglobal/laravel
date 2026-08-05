{{-- =========================================================================
     DevConnect — All Projects (User Side)
     ========================================================================= --}}
@extends('layouts.app')

@section('title', 'Explore Projects — DevConnect')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    .page-hero {
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
        font-size: clamp(2rem, 5vw, 2.8rem);
        font-weight: 700;
        margin-bottom: 12px;
    }

    .page-hero p {
        color: #94a3b8;
        max-width: 560px;
        margin: 0 auto;
    }

    .projects-toolbar {
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
        text-decoration: none;
    }

    .filter-tabs .tab-btn:hover,
    .filter-tabs .tab-btn.active {
        background: linear-gradient(135deg, #7c3aed, #2563eb);
        border-color: transparent;
        color: #fff;
    }

    .search-box {
        display: flex;
        gap: 8px;
    }

    .search-box input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 10px 16px;
        color: #e2e8f0;
        font-size: 0.9rem;
        outline: none;
        min-width: 220px;
    }

    .search-box input:focus {
        border-color: rgba(139, 92, 246, 0.5);
    }

    .project-thumb {
        position: relative;
        height: 180px;
        overflow: hidden;
        border-radius: 14px 14px 0 0;
        background: rgba(255, 255, 255, 0.04);
    }

    .project-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease;
    }

    .project-card:hover .project-thumb img {
        transform: scale(1.05);
    }

    .project-category-tag {
        position: absolute;
        top: 12px;
        background: rgba(15, 15, 25, 0.75);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #c4b5fd;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 50px;
        z-index: 2;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state i {
        font-size: 3.5rem;
        color: #7c3aed;
        opacity: 0.7;
        margin-bottom: 16px;
    }
    .project-thumb{

    position:relative;

    overflow:hidden;

}



.premium-overlay{

    position:absolute;
    inset:0;
    background:rgba(0,0,0,.65);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    z-index:100;
    color:white;

}
.blur-image{
    filter: blur(8px);
}
.premium-overlay i{

    font-size:36px;
    margin-bottom:12px;

}

.premium-overlay h5{
    margin-bottom:15px;

}
.blur-text{

    filter: blur(5px);

    user-select:none;

}
</style>
@endpush

@section('content')

<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<main>
    {{-- Hero --}}
    <section class="page-hero">
        <div class="container-xl">
            <span class="eyebrow">
                <i class="fa-solid fa-layer-group"></i> Community Builds
            </span>
            <h1>Explore <span class="text-gradient">Projects</span></h1>
            <p>Discover amazing work from developers around the world.</p>
        </div>
    </section>
    {{-- Total count --}}
    <div class="text-center mb-4" style="color:#94a3b8;font-size:0.95rem;">
        <strong style="color:#e2e8f0;font-size:1.1rem;">{{ $totalProjects ?? $projects->total() }}</strong>
        projects found
        @if(request('category'))
        in <span style="color:#c4b5fd;">{{ request('category') }}</span>
        @endif
        @if(request('q'))
        for “{{ request('q') }}”
        @endif

    </div>
    {{-- Grid --}}
    <section style="padding: 20px 0 100px;">
        <div class="container-xl">

            {{-- Toolbar --}}
            <div class="projects-toolbar">
                <div class="filter-tabs">
                    <a href="{{ url('/home/project') }}"
                        class="tab-btn {{ !request('category') ? 'active' : '' }}">All</a>
                    <a href="{{ url('/home/project?category=Laravel') }}"
                        class="tab-btn {{ request('category') == 'Laravel' ? 'active' : '' }}">Laravel</a>
                    <a href="{{ url('/home/project?category=React') }}"
                        class="tab-btn {{ request('category') == 'React' ? 'active' : '' }}">React</a>
                    <a href="{{ url('/home/project?category=Flutter') }}"
                        class="tab-btn {{ request('category') == 'Flutter' ? 'active' : '' }}">Flutter</a>
                    <a href="{{ url('/home/project?category=Python') }}"
                        class="tab-btn {{ request('category') == 'Python' ? 'active' : '' }}">Python</a>
                </div>

                <form class="search-box" method="GET" action="{{ url('/home/project') }}">
                    @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search projects...">
                    <button type="submit" class="btn btn-gradient btn-sm">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
<div class="mb-3">
    <span class="badge bg-primary">
        Plan: {{ ucfirst($userPlan) }}
    </span>
</div>
            {{-- Projects Grid --}}

            <div class="row g-4">

                @forelse($projects as $project)
                @php

                $isPremiumLocked =
                $project->visibility == 'premium'
                && $userPlan == 'free';

                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card project-card h-100">
                        <div class="project-thumb">
                            <span class="project-category-tag">
                                {{ $project->category }}

                            </span>

                            <img
                            class="{{ $isPremiumLocked ? 'blur-image' : '' }}"
                                src="/uploads/projects/{{ $project->image }}"
                                alt="{{ $project->title }}"
                                onerror="this.onerror=null;this.src='/uploads/projects/banner.png';">

                            @if($isPremiumLocked)
                            <div class="premium-overlay">
                                <i class="fa-solid fa-lock"></i>
                                <h5>Premium Project</h5>
                                
                            </div>
                            @endif

                        </div>
                        <div class="project-body ">
                            <h3 class="project-title">{{ $project->title }}</h3>
                            <div class="project-author">
                                <img src="https://i.pravatar.cc/60?u={{ $project->user_id }}" alt="Author">
                                <span>by {{ $project->user->name ?? 'Developer' }}</span>
                            </div>
                            <p class="project-desc" class="project-desc {{ $isPremiumLocked ? 'blur-text' : '' }}">
                                {{ \Illuminate\Support\Str::limit(strip_tags($project->description), 100) }}
                            </p>

                            @if($project->technology)
                            <div  class="tech-pills {{ $isPremiumLocked ? 'blur-text' : '' }}">
                                @foreach(array_slice(explode(',', $project->technology), 0, 3) as $tech)
                                <span class="tech-pill">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                            @endif

                            <div class="project-footer">
                                <div class="project-metrics">
                                    <span><i class="fa-regular fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($project->created_at)->format('d M Y') }}
                                    </span>
                                </div>
                                @if($isPremiumLocked)
                                <a href="{{ url('home/pricing') }}"
                                    class="btn btn-warning btn-sm">
                                    Unlock Membership
                                </a>
                                @else
                                <a href="{{ route('project.usershow', $project->id) }}"
                                    class="btn btn-gradient btn-sm">
                                    View Details
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
</div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state glass-card">
                        <i class="fa-solid fa-folder-open"></i>
                        <h3>No projects found</h3>
                        <p style="color:#94a3b8;">Try a different category or search term.</p>
                    </div>
                </div>
                @endforelse

            </div>



        </div>
    </section>
</main>
<script>

</script>
@endsection