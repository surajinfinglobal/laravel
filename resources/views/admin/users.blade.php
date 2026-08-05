@extends('admin.navbar')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="container">


    <h1 class="title">
        All Users
    </h1>
    <form method="GET" action="{{ route('admin.users') }}" class="toolbar-inner">

    <!-- Search Bar -->
    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input
            type="text"
            name="search"
            id="search"
            value="{{ request('search') }}"
            placeholder="Search users...">
    </div>

    <!-- Right Side Dropdowns -->
    <div class="filter-group">

        <!-- Status Dropdown (Active / Inactive) -->
        <select name="status" id="status-filter" class="filter-dropdown" onchange="this.form.submit()">
            <option value="">All Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <!-- Project/Category Dropdown -->
        <select name="project" id="project-filter" class="filter-dropdown" onchange="this.form.submit()">
            <option value="">All Projects</option>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ request('project') == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>

        <button type="submit" class="action-btn"><i class="fa-solid fa-magnifying-glass"></i></button>

    </div>

</form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Project</th>
                <th>Created</th>
                <th>Status</th>
                <th>Action</th>
                <th>Member</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
        <tbody id="usersTableBody">
        @forelse($users as $user)
            <tr id="user-{{ $user->id }}">
                <td>{{ $user->id }}</td>
                <td class="status">{{ $user->name }}</td>
                <td class="center">{{ $user->email }}</td>
                <td class="status">{{ $user->projects_count ?? 0 }}</td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                <td class="status">
                    @if($user->status == 1)
                        <span class="status-badge active"><span class="pulse-dot"></span></span>
                    @else
                        <span class="status-badge inactive"><span class="pulse-dot"></span></span>
                    @endif
                </td>
               
                <td> <button
                        class="action-btn"
                        onclick="openEditModal(
                            '{{ $user->id }}',
                            '{{ $user->name }}',
                            '{{ $user->email }}',
                            '{{ $user->status }}'
                        )">
                        <i class="fa-solid fa-pen"></i>
                    </button> </td>
                    <td>{{ $user->plan ?? 'Free' }}</td>
                    <td> {{ $user->membership_expiry ? \Carbon\Carbon::parse($user->membership_expiry)->format('d M Y') : 'N/A' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="center">No users found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div id="editModal" class="modal">

    <div class="modal-content">
        <h2>Edit User</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <label>Name</label>
            <input
                type="text"
                id="editName"
                name="name"
            >
            <label>Email</label>
            <input
                type="email"
                id="editEmail"
                name="email"
            >
            <label>Status</label>
            <select
                id="editStatus"
                name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <div class="modal-buttons">
                <button type="submit" class="save-btn">
                    Save
                </button>
                 <button type="button"
            class="delete-btn"
            onclick="deleteUser()">
        Delete
    </button>
                <button
                    type="button"
                    class="close-btn"
                    onclick="closeEditModal()">
                    Close
                </button>
            </div>
        </form>
        <form
            id="deleteForm"
            method="POST"
            style="display:none;">

            @csrf
            @method('DELETE')

        </form>

    </div>
 
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>let currentUserId;

function openEditModal(id, name, email, status) {
    currentUserId = id;

    $("#editModal").css("display", "flex");

    $("#editName").val(name);
    $("#editEmail").val(email);
    $("#editStatus").val(status);

    $("#editForm").attr("action", "/admin/users/update/" + id);
}

function closeEditModal() {
    $("#editModal").css("display", "none");
}

function deleteUser() {
    if (confirm("Are you sure you want to delete this user?")) {
        $("#deleteForm")
            .attr("action", "/admin/users/" + currentUserId)
            .trigger("submit"); 
    }
}
</script>
<div class="mt-4 custom-pagination" >
    {{ $users->appends(request()->query())->links() }}
</div>

<div class="user-profile-card" id="user-cards-container">
    
</div>
<style>
  .toolbar-inner {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 10px;
}

.search-box {
    flex: 1;
    min-width: 280px;
    position: relative;
}

.search-box i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 1.1rem;
}

.search-box input {
    width: 100%;
    padding: 14px 16px 14px 48px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    color: white;
    font-size: 1rem;
}

.search-box input:focus {
    outline: none;
    border-color: #a29fa3;
    background: rgba(255,255,255,0.12);
}
  .toolbar-inner {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.search-box {
    flex: 1;
    min-width: 280px;
    position: relative;
}

/* Filter Group (Right Side) */
.filter-group {
    display: flex;
    gap: 12px;
}

/* Dark Dropdown Fix */
.filter-dropdown {
    padding: 12px 16px;
    background: rgba(255,255,255,0.08) !important;
    border: 1px solid rgba(255,255,255,0.18) !important;
    border-radius: 12px;
    color: white !important;
    font-size: 0.95rem;
    min-width: 160px;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23e2e8f0' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592c.859 0 1.319 1.013.753 1.658L8.753 11.14a.5.5 0 0 1-.706 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
}

.filter-dropdown:focus {
    outline: none;
    border-color: #3b82f6 !important;
    background: rgba(255,255,255,0.15) !important;
}

/* Dropdown Options (Jab khule) */
.filter-dropdown option {
    background: #0f172a !important;     /* Dark background */
    color: #e2e8f0 !important;
    padding: 12px 16px;
}

.filter-dropdown option:hover {
    background: #1e2937 !important;
}
@media (max-width: 768px) {
    .toolbar-inner {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        justify-content: center;
    }
}
#user-cards-container {
    margin-top: 20px;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr)); 
    gap: 20px; 
    width: 100%;
    padding: 15px;      
}
.user-profile-card {
    width: 100%;          
    display: flex;
    align-items: center;
    justify-content: space-between; 
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
}
.user-profile-card {
    background: rgba(31, 41, 55, 0.9);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 18px;
    position: relative;
    transition: all 0.3s ease;
    margin-bottom: 16px;
}

.user-profile-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
}

/* Profile Image */
.profile-img {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255,255,255,0.12);
    flex-shrink: 0;
}

/* Profile Info */
.profile-info {
    flex: 1;
}

.profile-info h4 {
    margin: 0 0 5px 0;
    color: white;
    font-size: 1.15rem;
}

.profile-info .designation {
    color: #60a5fa;
    margin: 0 0 4px 0;
    font-size: 0.95rem;
}

.profile-info .email {
    color: #94a3b8;
    font-size: 0.9rem;
    margin: 0;
}

/* Delete Button */
.btn-delete {
    background: #ef4444;
    color: white;
    border: none;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.btn-delete:hover {
    background: #dc2626;
    transform: scale(1.1);
}

.btn-delete i {
    font-size: 1.1rem;
}
.action-btn{
    width:40px;
    height:40px;
    border:none;
    border-radius:10px;
    background:#2563eb;
    color:#fff;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:0.3s ease;
    font-size:16px;
    box-shadow:0 4px 10px rgba(37,99,235,.3);

}

.action-btn:hover{

    background:#1d4ed8;
    transform:translateY(-2px);
    box-shadow:0 6px 15px rgba(37,99,235,.4);

}

.action-btn:active{

    transform:scale(.95);

}

.action-btn i{

    pointer-events:none;

}
    .delete-btn{

    background:#dc2626;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;

}

.delete-btn:hover{

    background:#b91c1c;

}
 .modal{

    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.6);
    justify-content:center;
    align-items:center;
    z-index:999;

}

.modal-content{
    width:420px;
    background:#1e293b;
    padding:30px;
    border-radius:15px;
    color:white;

}

.modal-content input,
.modal-content select{

    width:100%;
    padding:12px;
    margin-top:8px;
    margin-bottom:20px;
    background:#0f172a;
    border:1px solid #334155;
    color:white;
    border-radius:8px;

}

.modal-buttons{

    display:flex;
    justify-content:space-between;

}

.save-btn{

    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;

}

.close-btn{

    background:#ef4444;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;

}
    .center{
        text-align:center;
    }
    .status {
    display: flex;
        align-items: center;
        justify-content: center;
    }
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 8px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    color: white;
}

.status-badge .pulse-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

/* Active Status */
.status-badge.active {
    background: rgba(40, 167, 69, 0.2);
    color: #28a745;
    border: 1px solid rgba(40, 167, 69, 0.4);
}

.status-badge.active .pulse-dot {
    background: #28a745;
    box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
    animation: pulse-active 2s infinite;
}

/* Inactive Status */
.status-badge.inactive {
    background: rgba(220, 53, 69, 0.2);
    color: #dc3545;
    border: 1px solid rgba(220, 53, 69, 0.4);
}

.status-badge.inactive .pulse-dot {
    background: #dc3545;
    box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
    animation: pulse-inactive 2.5s infinite;
}

/* Pulse Animation */
@keyframes pulse-active {
    0% {
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
    }
    70% {
        box-shadow: 0 0 0 8px rgba(40, 167, 69, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
    }
}

@keyframes pulse-inactive {
    0% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.6);
    }
    70% {
        box-shadow: 0 0 0 7px rgba(220, 53, 69, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
    }
}

.btn-status {
    border: none;
    padding: 5px 15px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 100px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Activate Button */
.btn-activate {
    background: linear-gradient(135deg, #28a745, #34d058);
    color: white;
}

.btn-activate:hover {
    background: linear-gradient(135deg, #218838, #2ea44f);
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
}

/* Deactivate Button */
.btn-deactivate {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: white;
}

.btn-deactivate:hover {
    background: linear-gradient(135deg, #c82333, #d43f4e);
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
}

/* Active State (Optional - jab button pressed ho) */
.btn-status:active {
    transform: scale(0.95);
}

/* Previous & Next */


.custom-pagination{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:20px;
    margin-top:30px;
    flex-wrap:wrap;
}

.page-btn{
    padding:12px 22px;
    text-decoration:none;
    border-radius:10px;
    color:#fff;
    font-weight:600;
    transition:.3s;

}

.prev{

    background:#2563eb;

}

.prev:hover{

    background:#2563eb;

}

.next{

    background:#2563eb;

}

.next:hover{

    background:#1d4ed8;

}

.disabled{

    background:#555;
    cursor:not-allowed;
    opacity:.6;

}

.page-numbers{

    display:flex;
    gap:8px;
    align-items:center;

}

.page-number{

    width:42px;
    height:42px;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#1f2937;
    color:#fff;
    text-decoration:none;
    border-radius:10px;
    transition:.3s;

}

.page-number:hover{

    background:#2563eb;

}

.page-number.active{

    background:#f59e0b;
    color:#fff;
    font-weight:bold;

}

.dots{

    color:white;
    padding:0 8px;

}

.title{

    color:white;
    text-align:center;
    margin-bottom:30px;
}

table{

    width:100%;
    border-collapse:collapse;
    background:
    rgba(255,255,255,.05);
    backdrop-filter:
    blur(20px);
    border-radius:20px;
    overflow:hidden;
}

th{

    background:
    rgba(255,255,255,.08);
    color:white;
    padding:18px;
}

td{

    padding:18px;

    color:#ddd;
}

tr{

    border-bottom:
    1px solid rgba(255,255,255,.08);
}
</style>

@endsection