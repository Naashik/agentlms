@extends('layouts.layout', ['agent' => $agent])
@section('content')

<div>
<div  class="mt-10 m-5 ">
<div class="d-grid">

<h2 style="font-size:20px">Lead Profile</h2>
<div>
<lable style="font-size:13px;font-weight:bold">Update Status :</label><button type="submit"
 class="btn btn-primary ">Work In Progress</button>
</div>
 
</div>
<div ><img src="../media/logos/icons8-male-user-100.png"></div>

<form class="mt-10" style="font-size:15px">
    <label >Lead ID:</label><br>
    <label class="mt-1">Batch ID:</label><br>
    <label class="mt-1">Lead Name:</label><br>
    <label class="mt-1">Email:</label><br>
    <label class="mt-1">Phone:</label><br>
    <label class="mt-1">Phone 2:</label><br>
    <label class="mt-1">Country:</label><br>
    <label class="mt-1">State:</label><br>
    <label class="mt-1">City:</label><br>
    <label class="mt-1">Position:</label><br>
    <label class="mt-1">Lead Type:</label><br>
    
   
</form>
</div>
<div class="d-flex">
    
<table class="table mt-10 w-50 m-5 caption-top">
<caption  style="color:black;font-weight:bold">Lead Status Transaction</caption>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Lead ID</th>
            <th scope="col">Status</th>
            <th scope="col">Time stamp</th>
            <th scope="col">Note</th>
            <th scope="col">Reminder date</th>
            <th scope="col">Reminder time</th>
  
        
        </tr>
    </thead>

   

</table>
<table class="table mt-10 w-50 m-5 caption-top">
<caption style="color:black;font-weight:bold">Lead Zoiper Transaction</caption>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Lead ID</th>
            <th scope="col">Call number</th>
            <th scope="col">Start time</th>
            <th scope="col">End time</th>
  
        
        </tr>
    </thead>

   

</table>
</div>
</div>


@endsection