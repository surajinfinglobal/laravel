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
<div class="mt-4 custom-pagination">
    {{ $contacts->links() }}
</div>

</div>

<style>
.container{
    width: min(1200px, 95%);
  
}
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