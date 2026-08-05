{{-- =========================================================================
     DevConnect — Home Page
     Dark theme · Glassmorphism · Purple + Blue gradients · Poppins · Bootstrap 5
     Note: All content below is static Blade/HTML markup (no @php arrays/loops).
     ========================================================================= --}}
@extends('layouts.app')

@section('title', 'DevConnect — Show Your Skills. Share Your Projects.')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

{{-- Ambient animated gradient orbs (fixed background, shared across page) --}}
<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

{{-- =====================================================================
     1. Sticky Navigation Bar (extracted component)
     ===================================================================== --}}


<main>

    {{-- =================================================================
         2. Hero Section
         ================================================================= --}}
    <header class="hero">
        <div class="container-xl">
            <div class="hero-grid">
                <div class="hero-content">
                    <span class="eyebrow"><i class="fa-solid fa-sparkles"></i> The home for developer portfolios</span>
                    <h1 class="hero-title">
                        Show Your Skills.<br>
                        <span class="text-gradient">Share Your Projects.</span>
                    </h1>
                    <p class="hero-sub">
                        Upload your projects, discover amazing work, connect with developers, receive likes and ratings, and build your portfolio — all in one place.
                    </p>
                    <div class="hero-cta">
                        <a href="{{ url('home/project') }}" class="btn btn-gradient">
                            <i class="fa-solid fa-compass"></i> Explore Projects
                        </a>
                        <a href="{{ route('projects.upload') }}" class="btn btn-outline-light">
                            <i class="fa-solid fa-cloud-arrow-up"></i> Upload Your Project
                        </a>
                    </div>
                    <div class="hero-trust">
                        <div class="avatar-stack">
                            <img src="https://i.pravatar.cc/80?img=32" alt="Developer avatar">
                            <img src="https://i.pravatar.cc/80?img=45" alt="Developer avatar">
                            <img src="https://i.pravatar.cc/80?img=15" alt="Developer avatar">
                            <img src="https://i.pravatar.cc/80?img=8" alt="Developer avatar">
                        </div>
                        <p class="hero-trust-text"><strong>12,400+</strong> developers already building in public</p>
                    </div>
                </div>

                {{-- Dashboard mockup illustration --}}
                <div class="hero-visual">
                    <div class="mockup-window">
                        <div class="mockup-bar">
                            <span class="mockup-dot r"></span>
                            <span class="mockup-dot y"></span>
                            <span class="mockup-dot g"></span>
                            <span>devconnect.app/dashboard</span>
                        </div>
                        <div class="mockup-body">
                            <div class="mockup-line w-45"></div>
                            <div class="mockup-line w-90"></div>
                            <div class="mockup-line w-70"></div>

                            <div class="mockup-project-card">
                                <div class="mockup-thumb"><i class="fa-solid fa-diagram-project"></i></div>
                                <div class="mockup-meta" style="flex:1">
                                    <div class="mockup-line w-70"></div>
                                    <div class="mockup-line w-45"></div>
                                    <div class="mockup-stats">
                                        <span><i class="fa-solid fa-heart"></i> 248</span>
                                        <span><i class="fa-solid fa-star"></i> 4.9</span>
                                        <span><i class="fa-solid fa-eye"></i> 3.1k</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="float-badge badge-likes">
                        <span class="badge-icon"><i class="fa-solid fa-heart"></i></span>
                        <span>+248 Likes</span>
                    </div>
                    <div class="float-badge badge-rating">
                        <span class="badge-icon"><i class="fa-solid fa-star"></i></span>
                        <span>4.9 Rating</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- =================================================================
         3. Statistics Section
         ================================================================= --}}
    <section class="stats-section">
        <div class="container-xl">
            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="glass-card stat-card reveal">
                        <div class="stat-icon"><i class="fa-solid fa-user-astronaut"></i></div>
                        <div class="stat-number">
                            <span  data-counter="{{$totalUsers}}"  data-suffix="+" ></span>
                        </div>
                        <div class="stat-label">Developers</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="glass-card stat-card reveal">
                        <div class="stat-icon"><i class="fa-solid fa-folder-open"></i></div>
                        <div class="stat-number">
                            <span data-counter="{{$totalProjects}}"  data-suffix="+">{{$totalProjects}}</span>
                        </div>
                        <div class="stat-label">Projects Uploaded</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="glass-card stat-card reveal">
                        <div class="stat-icon"><i class="fa-solid fa-heart"></i></div>
                        <div class="stat-number">
                            <span data-counter="54200" data-suffix="+">0</span>
                        </div>
                        <div class="stat-label">Total Likes</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="glass-card stat-card reveal">
                        <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
                        <div class="stat-number">
                            <span data-counter="31900" data-suffix="+">0</span>
                        </div>
                        <div class="stat-label">Total Ratings</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =================================================================
         4. Featured Projects
         ================================================================= --}}
    <section id="projects">
        <div class="container-xl">
            <div class="section-head-wrap text-center">
                <span class="eyebrow"><i class="fa-solid fa-layer-group"></i> Featured Work</span>
                <h2 class="section-heading">Featured <span class="text-gradient">Projects</span></h2>
                <p class="section-sub mx-auto">A snapshot of standout builds from the DevConnect community — updated daily.</p>
            </div>

            <div class="row g-4">

                {{-- Project 1 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card project-card reveal">
                        <div class="project-thumb">
                            <span class="project-category-tag">Laravel</span>
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div class="project-body">
                            <h3 class="project-title">TaskFlow — Kanban SaaS</h3>
                            <div class="project-author">
                                <img src="https://i.pravatar.cc/60?img=49" alt="Priya Sharma">
                                <span>by Priya Sharma</span>
                            </div>
                            <p class="project-desc">A full-featured project management board with real-time drag-and-drop and team collaboration.</p>
                            <div class="tech-pills">
                                <span class="tech-pill">Laravel</span>
                                <span class="tech-pill">Livewire</span>
                                <span class="tech-pill">MySQL</span>
                            </div>
                            <div class="project-footer">
                                <div class="project-metrics">
                                    <span><i class="fa-solid fa-heart"></i> 342</span>
                                    <span><i class="fa-solid fa-star"></i> 4.9</span>
                                </div>
                                <a href="{{ url('/projects/taskflow-kanban-saas') }}" class="btn btn-gradient">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Project 2 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card project-card reveal">
                        <div class="project-thumb">
                            <span class="project-category-tag">Flutter</span>
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <div class="project-body">
                            <h3 class="project-title">PulseChat Mobile</h3>
                            <div class="project-author">
                                <img src="https://i.pravatar.cc/60?img=22" alt="Daniel Cho">
                                <span>by Daniel Cho</span>
                            </div>
                            <p class="project-desc">Cross-platform real-time messenger with end-to-end encryption and offline sync.</p>
                            <div class="tech-pills">
                                <span class="tech-pill">Flutter</span>
                                <span class="tech-pill">Firebase</span>
                                <span class="tech-pill">Dart</span>
                            </div>
                            <div class="project-footer">
                                <div class="project-metrics">
                                    <span><i class="fa-solid fa-heart"></i> 289</span>
                                    <span><i class="fa-solid fa-star"></i> 4.7</span>
                                </div>
                                <a href="{{ url('/projects/pulsechat-mobile') }}" class="btn btn-gradient">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Project 3 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card project-card reveal">
                        <div class="project-thumb">
                            <span class="project-category-tag">Machine Learning</span>
                            <i class="fa-solid fa-brain"></i>
                        </div>
                        <div class="project-body">
                            <h3 class="project-title">InsightAI Dashboard</h3>
                            <div class="project-author">
                                <img src="https://i.pravatar.cc/60?img=47" alt="Maria Lopez">
                                <span>by Maria Lopez</span>
                            </div>
                            <p class="project-desc">A predictive analytics dashboard that visualizes model output for business teams.</p>
                            <div class="tech-pills">
                                <span class="tech-pill">Python</span>
                                <span class="tech-pill">TensorFlow</span>
                                <span class="tech-pill">React</span>
                            </div>
                            <div class="project-footer">
                                <div class="project-metrics">
                                    <span><i class="fa-solid fa-heart"></i> 512</span>
                                    <span><i class="fa-solid fa-star"></i> 5.0</span>
                                </div>
                                <a href="{{ url('/projects/insightai-dashboard') }}" class="btn btn-gradient">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-5">
                <a href="{{ url('/projects') }}" class="btn btn-ghost">
                    View All Projects <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- =================================================================
         5. Top Developers Section
         ================================================================= --}}
    <section id="developers">
        <div class="container-xl">
            <div class="section-head-wrap text-center">
                <span class="eyebrow"><i class="fa-solid fa-trophy"></i> Community Leaders</span>
                <h2 class="section-heading">Top <span class="text-gradient">Developers</span></h2>
                <p class="section-sub mx-auto">Meet the highest-rated builders shipping standout projects on DevConnect.</p>
            </div>

            <div class="row g-4">

                {{-- Developer 1 --}}
                <div class="col-sm-6 col-lg-3">
                    <div class="glass-card dev-card reveal">
                        <div class="dev-avatar-wrap">
                            <img src="https://i.pravatar.cc/160?img=11" alt="Ethan Wright" class="dev-avatar">
                        </div>
                        <h3 class="dev-name">Ethan Wright</h3>
                        <p class="dev-role">Full-Stack Engineer</p>
                        <div class="dev-stats">
                            <div><strong>24</strong><span>Projects</span></div>
                            <div><strong>1840</strong><span>Likes</span></div>
                            <div><strong>4.9</strong><span>Rating</span></div>
                        </div>
                        <a href="{{ url('/developers/ethan-wright') }}" class="btn btn-ghost btn-sm w-100">View Profile</a>
                    </div>
                </div>

                {{-- Developer 2 --}}
                <div class="col-sm-6 col-lg-3">
                    <div class="glass-card dev-card reveal">
                        <div class="dev-avatar-wrap">
                            <img src="https://i.pravatar.cc/160?img=5" alt="Sofia Rossi" class="dev-avatar">
                        </div>
                        <h3 class="dev-name">Sofia Rossi</h3>
                        <p class="dev-role">Mobile App Developer</p>
                        <div class="dev-stats">
                            <div><strong>19</strong><span>Projects</span></div>
                            <div><strong>1520</strong><span>Likes</span></div>
                            <div><strong>4.8</strong><span>Rating</span></div>
                        </div>
                        <a href="{{ url('/developers/sofia-rossi') }}" class="btn btn-ghost btn-sm w-100">View Profile</a>
                    </div>
                </div>

                {{-- Developer 3 --}}
                <div class="col-sm-6 col-lg-3">
                    <div class="glass-card dev-card reveal">
                        <div class="dev-avatar-wrap">
                            <img src="https://i.pravatar.cc/160?img=14" alt="Kunal Verma" class="dev-avatar">
                        </div>
                        <h3 class="dev-name">Kunal Verma</h3>
                        <p class="dev-role">ML Engineer</p>
                        <div class="dev-stats">
                            <div><strong>16</strong><span>Projects</span></div>
                            <div><strong>1370</strong><span>Likes</span></div>
                            <div><strong>5.0</strong><span>Rating</span></div>
                        </div>
                        <a href="{{ url('/developers/kunal-verma') }}" class="btn btn-ghost btn-sm w-100">View Profile</a>
                    </div>
                </div>

                {{-- Developer 4 --}}
                <div class="col-sm-6 col-lg-3">
                    <div class="glass-card dev-card reveal">
                        <div class="dev-avatar-wrap">
                            <img src="https://i.pravatar.cc/160?img=9" alt="Grace Kim" class="dev-avatar">
                        </div>
                        <h3 class="dev-name">Grace Kim</h3>
                        <p class="dev-role">UI/UX Designer</p>
                        <div class="dev-stats">
                            <div><strong>22</strong><span>Projects</span></div>
                            <div><strong>1690</strong><span>Likes</span></div>
                            <div><strong>4.9</strong><span>Rating</span></div>
                        </div>
                        <a href="{{ url('/developers/grace-kim') }}" class="btn btn-ghost btn-sm w-100">View Profile</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- =================================================================
         6. Categories Section
         ================================================================= --}}
    <section id="categories">
        <div class="container-xl">
            <div class="section-head-wrap text-center">
                <span class="eyebrow"><i class="fa-solid fa-shapes"></i> Browse by Stack</span>
                <h2 class="section-heading">Explore <span class="text-gradient">Categories</span></h2>
                <p class="section-sub mx-auto">Find projects built with the technologies you care about most.</p>
            </div>

            <div class="row g-4">

                <div class="col-6 col-md-3">
                    <a href="{{ url('/categories/laravel') }}" class="glass-card category-card reveal d-block">
                        <div class="category-icon"><i class="fa-brands fa-laravel"></i></div>
                        <div class="category-name">Laravel</div>
                        <div class="category-count">{{ $laravelProjects }}</div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ url('/categories/php') }}" class="glass-card category-card reveal d-block">
                        <div class="category-icon"><i class="fa-brands fa-php"></i></div>
                        <div class="category-name">PHP</div>
                        <div class="category-count">{{ $phpProjects }}</div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ url('/categories/react') }}" class="glass-card category-card reveal d-block">
                        <div class="category-icon"><i class="fa-brands fa-react"></i></div>
                        <div class="category-name">React</div>
                        <div class="category-count">{{ $reactProjects }}</div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ url('/categories/vue') }}" class="glass-card category-card reveal d-block">
                        <div class="category-icon"><i class="fa-brands fa-vuejs"></i></div>
                        <div class="category-name">Web Development</div>
                        <div class="category-count">{{ $webProjects }}</div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ url('/categories/flutter') }}" class="glass-card category-card reveal d-block">
                        <div class="category-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                        <div class="category-name">Flutter</div>
                        <div class="category-count">{{ $flutterProjects }}</div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ url('/categories/android') }}" class="glass-card category-card reveal d-block">
                        <div class="category-icon"><i class="fa-brands fa-android"></i></div>
                        <div class="category-name">MobileApp</div>
                        <div class="category-count">{{$mobileProjects}}</div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ url('/categories/ui-ux') }}" class="glass-card category-card reveal d-block">
                        <div class="category-icon"><i class="fa-solid fa-pen-ruler"></i></div>
                        <div class="category-name">UI/UX</div>
                        <div class="category-count">{{ $uiuxProjects }}</div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ url('/categories/machine-learning') }}" class="glass-card category-card reveal d-block">
                        <div class="category-icon"><i class="fa-solid fa-brain"></i></div>
                        <div class="category-name">Machine Learning</div>
                        <div class="category-count">{{ $mlProjects }}</div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- =================================================================
         7. How It Works
         ================================================================= --}}
    <section id="how-it-works">
        <div class="container-xl">
            <div class="section-head-wrap text-center">
                <span class="eyebrow"><i class="fa-solid fa-route"></i> Getting Started</span>
                <h2 class="section-heading">How It <span class="text-gradient">Works</span></h2>
                <p class="section-sub mx-auto">Four simple steps from sign-up to a portfolio that gets noticed.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-3">
                    <div class="glass-card step-card reveal">
                        <span class="step-index">STEP 01</span>
                        <div class="step-icon"><i class="fa-solid fa-user-plus"></i></div>
                        <h3 class="step-title">Create Account</h3>
                        <p class="step-desc">Sign up in seconds and set up your developer profile.</p>
                        <div class="step-connector"></div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="glass-card step-card reveal">
                        <span class="step-index">STEP 02</span>
                        <div class="step-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                        <h3 class="step-title">Upload Projects</h3>
                        <p class="step-desc">Showcase your work with images, tech stack, and descriptions.</p>
                        <div class="step-connector"></div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="glass-card step-card reveal">
                        <span class="step-index">STEP 03</span>
                        <div class="step-icon"><i class="fa-solid fa-star-half-stroke"></i></div>
                        <h3 class="step-title">Receive Likes & Ratings</h3>
                        <p class="step-desc">Get feedback from the community as developers rate your work.</p>
                        <div class="step-connector"></div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="glass-card step-card reveal">
                        <span class="step-index">STEP 04</span>
                        <div class="step-icon"><i class="fa-solid fa-briefcase"></i></div>
                        <h3 class="step-title">Build Your Portfolio</h3>
                        <p class="step-desc">Turn your top projects into a portfolio that stands out.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- =================================================================
         8. Why Choose DevConnect
         ================================================================= --}}
    <section id="why-devconnect">
        <div class="container-xl">
            <div class="section-head-wrap text-center">
                <span class="eyebrow"><i class="fa-solid fa-circle-check"></i> Why DevConnect</span>
                <h2 class="section-heading">Built for <span class="text-gradient">Developers</span></h2>
                <p class="section-sub mx-auto">Everything you need to share your work and grow your network.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4">
                    <div class="glass-card feature-card reveal">
                        <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <h3 class="feature-title">Secure Authentication</h3>
                        <p class="feature-desc">Industry-standard encryption keeps your account and data safe.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="glass-card feature-card reveal">
                        <div class="feature-icon"><i class="fa-solid fa-bolt"></i></div>
                        <h3 class="feature-title">Fast Upload</h3>
                        <p class="feature-desc">Publish projects in seconds with a streamlined upload flow.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="glass-card feature-card reveal">
                        <div class="feature-icon"><i class="fa-solid fa-people-group"></i></div>
                        <h3 class="feature-title">Developer Community</h3>
                        <p class="feature-desc">Connect, follow, and collaborate with builders worldwide.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="glass-card feature-card reveal">
                        <div class="feature-icon"><i class="fa-solid fa-star"></i></div>
                        <h3 class="feature-title">Like & Rating System</h3>
                        <p class="feature-desc">Get honest feedback with likes and 5-star project ratings.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="glass-card feature-card reveal">
                        <div class="feature-icon"><i class="fa-solid fa-mobile-screen"></i></div>
                        <h3 class="feature-title">Responsive Design</h3>
                        <p class="feature-desc">A seamless experience across desktop, tablet, and mobile.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="glass-card feature-card reveal">
                        <div class="feature-icon"><i class="fa-solid fa-gauge-high"></i></div>
                        <h3 class="feature-title">Modern Dashboard</h3>
                        <p class="feature-desc">Track likes, ratings, and views from one clean dashboard.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- =================================================================
         9. Testimonials
         ================================================================= --}}
    <section id="testimonials">
        <div class="container-xl">
            <div class="section-head-wrap text-center">
                <span class="eyebrow"><i class="fa-solid fa-quote-left"></i> Community Voices</span>
                <h2 class="section-heading">What Developers <span class="text-gradient">Say</span></h2>
                <p class="section-sub mx-auto">Real feedback from the builders using DevConnect every day.</p>
            </div>

            <div class="row g-4">

                <div class="col-lg-4">
                    <div class="glass-card testimonial-card reveal">
                        <div class="testimonial-stars">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="testimonial-text">"DevConnect helped me land three freelance gigs. The rating system gives my projects real credibility."</p>
                        <div class="testimonial-person">
                            <img src="https://i.pravatar.cc/100?img=33" alt="Liam Johnson">
                            <div>
                                <div class="testimonial-name">Liam Johnson</div>
                                <div class="testimonial-role">Frontend Developer</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="glass-card testimonial-card reveal">
                        <div class="testimonial-stars">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="testimonial-text">"Uploading projects is effortless and the community feedback pushed me to improve my code quality."</p>
                        <div class="testimonial-person">
                            <img src="https://i.pravatar.cc/100?img=26" alt="Aisha Bello">
                            <div>
                                <div class="testimonial-name">Aisha Bello</div>
                                <div class="testimonial-role">Backend Developer</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="glass-card testimonial-card reveal">
                        <div class="testimonial-stars">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="testimonial-text">"The best place to showcase side projects. I found two collaborators through the developer directory."</p>
                        <div class="testimonial-person">
                            <img src="https://i.pravatar.cc/100?img=51" alt="Marco Silva">
                            <div>
                                <div class="testimonial-name">Marco Silva</div>
                                <div class="testimonial-role">Mobile Developer</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- =================================================================
         10. Call To Action
         ================================================================= --}}
    <section class="cta-section">
        <div class="container-xl">
            <div class="cta-panel reveal">
                <h2 class="cta-title">Ready to Showcase Your Talent?</h2>
                <p class="cta-sub">Join thousands of developers already sharing their work, growing their network, and building standout portfolios.</p>
                <div class="cta-buttons">
                    <a href="{{ route('signup') }}" class="btn btn-gradient">
                        <i class="fa-solid fa-rocket"></i> Join Now
                    </a>
                    <a href="{{ url('/projects') }}" class="btn btn-outline-light">
                        <i class="fa-solid fa-compass"></i> Explore Projects
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

{{-- =====================================================================
     11. Footer
     ===================================================================== --}}
<footer>
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <a href="{{ url('/') }}" class="brand">
                    <span class="brand-mark"><i class="fa-solid fa-code"></i></span>
                    <span class="brand-text">Dev<span>Connect</span></span>
                </a>
                <p class="footer-brand-desc">
                    The platform where developers upload projects, get discovered, and connect with a global community of builders.
                </p>
                <div class="social-icons">
                    <a href="#" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                    <a href="#" aria-label="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" aria-label="Discord"><i class="fa-brands fa-discord"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h4 class="footer-heading">Company</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/careers') }}">Careers</a></li>
                    <li><a href="{{ url('/blog') }}">Blog</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/projects') }}">Explore Projects</a></li>
                    <li><a href="{{ url('/categories') }}">Categories</a></li>
                    <li><a href="{{ url('/developers') }}">Top Developers</a></li>
                    <li><a href="{{ url('/projects/upload') }}">Upload Project</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h4 class="footer-heading">Resources</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/docs') }}">Documentation</a></li>
                    <li><a href="{{ url('/faq') }}">FAQ</a></li>
                    <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('/terms') }}">Terms of Service</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h4 class="footer-heading">Newsletter</h4>
                <p class="footer-brand-desc" style="max-width:none;">Get product updates and featured projects in your inbox.</p>
                <form class="newsletter-form" action="{{ url('/newsletter/subscribe') }}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="you@example.com" required>
                    <button type="submit" class="btn btn-gradient btn-sm" aria-label="Subscribe">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; 2026 DevConnect. All rights reserved.</span>
            <div class="footer-bottom-links">
                <a href="{{ url('/privacy') }}">Privacy</a>
                <a href="{{ url('/terms') }}">Terms</a>
                <a href="{{ url('/sitemap') }}">Sitemap</a>
            </div>
        </div>
    </div>
</footer>

@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush