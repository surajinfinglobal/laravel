@extends('admin.navbar')

@section('title','Messages')

@section('content')

<div class="container">

    <h1 class="title">
        Contact Messages
    </h1>

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>

            </thead>

            <tbody>

                @forelse($contacts as $contact)

                <tr>

                    <td>{{ $contact->id }}</td>

                    <td>{{ $contact->name }}</td>

                    <td>{{ $contact->email }}</td>

                    <td>{{ $contact->subject }}</td>

                    <td>
                        {{ Str::limit($contact->message,50) }}
                    </td>

                    <td>
                        {{ $contact->created_at->format('d M Y') }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6">
                        No Messages Found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
<div class="mt-4" pagination-wrapper>
    {{ $contacts->links() }}
</div>
</div>

<style>
.container{
    width: min(1200px, 95%);
  
}
/* Pagination - Horizontal Layout */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.pagination {
    display: flex !important;
    align-items: center;
    flex-wrap: wrap;           /* Small screen pe wrap ho sake */
    justify-content: center;
    gap: 6px;
    padding: 0;
    list-style: none;
    margin: 0;
}

.pagination li {
    display: inline-block;
}

/* All buttons (Prev, Numbers, Next) */
.pagination a,
.pagination span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    margin-top:10px;
    height: 40px;
    padding: 0 12px;
    color: #cbd5e1;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 15px;
}

.pagination a:hover {
    background: rgba(255, 255, 255, 0.18);
    color: #fff;
    transform: translateY(-2px);
}

/* Active page */
.pagination .active span {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
    font-weight: 600;
}

/* Previous & Next buttons - Special styling */
.pagination li:first-child a,
.pagination li:last-child a {
    padding: 0 16px;
    font-weight: 500;
    min-width: auto;
}

/* Disabled buttons */
.pagination .disabled span {
    color: #64748b;
    cursor: not-allowed;
    background: rgba(0, 241, 60, 0.05);
}

/* Mobile adjustments */
@media (max-width: 768px) {
    .pagination a,
    .pagination span {
        min-width: 36px;
        height: 36px;
        font-size: 14px;
        padding: 0 10px;
    }
    
    .pagination li:first-child a,
    .pagination li:last-child a {
        padding: 0 14px;
    }
}
main{
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.title{
    text-align: center;
    margin-bottom: 30px;
    font-size: 50px;
    color: #fff;
}

.table-wrapper{
    width: 100%;

    background: rgba(255,255,255,.05);
    backdrop-filter: blur(25px);

    border: 1px solid rgba(255,255,255,.08);
    border-radius: 25px;

    overflow-x: auto;

    box-shadow:
        0 10px 30px rgba(0,0,0,.25),
        inset 0 1px 0 rgba(255,255,255,.08);
}

table{
    width: 100%;
    border-collapse: collapse;
}

thead{
    background: rgba(255,255,255,.08);
}

th,
td{
    padding: 18px;
    text-align: left;
}

th{
    color: #fff;
    font-weight: 600;
}

td{
    color: #cbd5e1;
}

tr{
    border-bottom: 1px solid rgba(255,255,255,.05);
}

tbody tr:hover{
    background: rgba(255,255,255,.03);
}

@media (max-width: 768px){

    .container{
        margin-top: 120px;
    }

    .title{
        font-size: 32px;
    }

    th,
    td{
        padding: 12px;
        font-size: 14px;
    }
}

</style>

@endsection