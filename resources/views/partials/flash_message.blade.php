
 @if (session()->has('success'))
     <div class="alert alert-success alert-dismissible fade show">
         {{ session('success') }}
         <button class="btn-close" type="button" data-bs-dismiss='alert' aria-label="Close"></button>
     </div>
 @endif

 @if (session()->has('failed'))
     <div class="alert alert-danger alert-dismissible fade show">
         {{ session('failed') }}
         <button class="btn-close" type="button" data-bs-dismiss='alert' aria-label="Close"></button>
     </div>
 @endif
