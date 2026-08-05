{{-- =========================================================================
     DevConnect — Project Detail Page (User Side)
     ========================================================================= --}}
@extends('layouts.app')

@section('title', ($project->title ?? 'Project') . ' — DevConnect')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    .project-detail {
        padding: 100px 0 80px;
    }
    .project-hero-img {
        width: 100%;
        height: 340px;
        object-fit: cover;
        border-radius: 18px;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.04);
    }
    .project-detail-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 18px;
        padding: 28px;
        backdrop-filter: blur(12px);
    }
    .project-title-lg {
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        font-weight: 700;
        margin-bottom: 12px;
    }
    .project-meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: center;
        margin-bottom: 20px;
        color: #94a3b8;
        font-size: 0.9rem;
    }
    .project-meta-row img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
    }
    .category-badge {
        display: inline-block;
        background: rgba(139, 92, 246, 0.15);
        border: 1px solid rgba(139, 92, 246, 0.35);
        color: #c4b5fd;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 50px;
    }
    .status-badge-detail {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 50px;
        text-transform: uppercase;
    }
    .status-published {
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }
    .status-draft {
        background: rgba(234, 179, 8, 0.15);
        color: #facc15;
        border: 1px solid rgba(234, 179, 8, 0.3);
    }
    .tech-pills-detail {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 16px 0 24px;
    }
    .tech-pills-detail .tech-pill {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        color: #cbd5e1;
        font-size: 0.8rem;
        padding: 5px 12px;
        border-radius: 50px;
    }
    .project-desc {
        color: #cbd5e1;
        line-height: 1.7;
        font-size: 0.95rem;
        white-space: pre-line;
    }
    .action-btns {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 24px;
    }
    .sidebar-stat {
        text-align: center;
        padding: 16px 8px;
    }
    .sidebar-stat .num {
        font-size: 1.4rem;
        font-weight: 700;
        background: linear-gradient(135deg, #a78bfa, #60a5fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .sidebar-stat .lbl {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 4px;
    }
    .author-card {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 20px;
    }
    .author-card img {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        object-fit: cover;
    }
    .author-card .name {
        font-weight: 600;
        color: #e2e8f0;
    }
    .author-card .role {
        font-size: 0.85rem;
        color: #94a3b8;
    }
</style>
@endpush

@section('content')

<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<main class="project-detail">
    <div class="container-xl">

        <div class="row g-4">

            {{-- ========== LEFT: Main Content ========== --}}
            <div class="col-lg-8">

                {{-- Image --}}
                <img
    src="/uploads/projects/{{ $project->image }}"
    alt="{{ $project->title }}"
    class="project-hero-img mb-4"
    onerror="this.onerror=null;this.src='/uploads/projects/banner.png';"
>

                <div class="project-detail-card">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="category-badge">{{ $project->category }}</span>
                        <span class="status-badge-detail {{ strtolower($project->status) === 'published' ? 'status-published' : 'status-draft' }}">
                            {{ $project->status }}
                        </span>
                    </div>

                    <h1 class="project-title-lg">{{ $project->title }}</h1>

                    <div class="project-meta-row">
                        <span>
                            <i class="fa-regular fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($project->created_at)->format('d M Y') }}
                        </span>
                        @if($project->user ?? null)
                        <span class="d-flex align-items-center gap-2">
                            <img src="https://i.pravatar.cc/80?u={{ $project->user_id }}" alt="Author">
                            by {{ $project->user->name ?? 'Developer' }}
                        </span>
                        @endif
                    </div>

                    {{-- Technologies --}}
                    @if($project->technology)
                    <div class="tech-pills-detail">
                        @foreach(explode(',', $project->technology) as $tech)
                            <span class="tech-pill">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    @endif

                    {{-- Description --}}
                    <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:12px;">About this project</h3>
                    <div class="project-desc">{{ $project->description }}</div>

                    {{-- Action Buttons --}}
                    <div class="action-btns">
                        @if($project->demo)
                        <a href="{{ $project->demo }}" target="_blank" rel="noopener" class="btn btn-gradient">
                            <i class="fa-solid fa-external-link"></i> Live Demo
                        </a>
                        @endif
                        @if($project->github)
                        <a href="{{ $project->github }}" target="_blank" rel="noopener" class="btn btn-ghost">
                            <i class="fa-brands fa-github"></i> View Code
                        </a>
                        @endif
                        <a href="{{ url('/home/project') }}" class="btn btn-outline-light btn-sm">
                            <i class="fa-solid fa-arrow-left"></i> Back to Projects
                        </a>
                    </div>
                </div>
            </div>

            {{-- ========== RIGHT: Sidebar ========== --}}
            <div class="col-lg-4">

                {{-- Author --}}
                <div class="project-detail-card mb-4">
                    <h4 style="font-size:0.95rem;font-weight:600;margin-bottom:16px;color:#94a3b8;">Created by</h4>
                    <div class="author-card">
                        <img src="https://i.pravatar.cc/100?u={{ $project->user_id }}" alt="Author">
                        <div>
                            <div class="name">{{ $project->user->name ?? 'Developer' }}</div>
                            <div class="role">{{ $project->user->email ?? '' }}</div>
                        </div>
                    </div>
                    <a href="{{ url('/developers/' . ($project->user_id ?? '')) }}" class="btn btn-ghost btn-sm w-100">
                        View Profile
                    </a>
                </div>

                {{-- Stats (agar ratings/likes table se aaye) --}}
                <div class="project-detail-card mb-4">
                    <div class="row g-2">
                        <div class="col-4">
                            <div class="sidebar-stat">
                                <div class="num">{{ $likesCount ?? 0 }}</div>
                                <div class="lbl">Likes</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="sidebar-stat">
                                <div class="num">{{ $avgRating ?? '—' }}</div>
                                <div class="lbl">Rating</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="sidebar-stat">
                                <div class="num">{{ $viewsCount ?? 0 }}</div>
                                <div class="lbl">Views</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Info --}}
                <div class="project-detail-card">
                    <h4 style="font-size:0.95rem;font-weight:600;margin-bottom:14px;color:#94a3b8;">Project Info</h4>
                    <div style="font-size:0.9rem;color:#cbd5e1;">
                        <div class="d-flex justify-content-between py-2" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                            <span style="color:#94a3b8;">Category</span>
                            <span>{{ $project->category }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                            <span style="color:#94a3b8;">Status</span>
                            <span>{{ ucfirst($project->status) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span style="color:#94a3b8;">Published</span>
                            <span>{{ \Carbon\Carbon::parse($project->created_at)->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>

@endsection