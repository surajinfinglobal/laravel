@extends('admin.navbar')

@section('content')

<div class="container">

    <h1 class="title">
        All Users
    </h1>

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
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td class="status">{{ $user->name }}</td>
                <td class="center">{{ $user->email }}</td>
               <td class="status">{{ $user->projects_count }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
<td class="status">
    @if($user->status)
        <span class="status-badge active">
            <span class="pulse-dot"></span>
            
        </span>
    @else
        <span class="status-badge inactive">
            <span class="pulse-dot"></span>
            
        </span>
    @endif
</td>

<td>
<form action="{{ route('users.toggleStatus',$user->id) }}" method="POST">
    @csrf
    @method('PATCH')
    @if($user->status)
     <button class="btn-status btn-activate">
            Activate
        </button>
        
    @else
       <button class="btn-status btn-deactivate">
            Deactivate
        </button>
    @endif
</form>
</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    No Users Found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
<div class="mt-4 custom-pagination" >
    {{ $users->links() }}
</div>
</div>
<style>
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


.pagination-outer{
    display: flex;
    justify-content: center;
   
}

.pagination{
    display: flex !important;
    align-items: center;
    justify-content: center;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination .page-item{
    margin: 0;
}

.pagination .page-link{
    display:flex;
     margin-top: 10px;
    align-items:center;
    justify-content:center;
    min-width:42px;
    height:42px;
    border-radius:10px;
    border:none;
    color:#fff;
    background:#1f2937;
    text-decoration:none;
    transition:.3s;
}

.pagination .page-item.active .page-link{
    background:#f59e0b;
}

.pagination .page-link:hover{
    background:#2563eb;
}


/* Previous */
.pagination .page-item:first-child .page-link{
    background:#3b82f6;
    padding:0 18px;
}

/* Next */
.pagination .page-item:last-child .page-link{
    background:#3b82f6;
    padding:0 18px;
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