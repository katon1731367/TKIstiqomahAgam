<ul class="nav justify-content-center">
   <li class="nav-item">
     <a class="nav-link {{ ($title == "Beranda") ? 'border-bottom border-2' : '' }}" aria-current="page" href="#">Beranda</a>
   </li>
   <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Profil</a>
      <ul class="dropdown-menu">
         <li><a class="dropdown-item" href="#">Visi Misi</a></li>
         <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
         <li><a class="dropdown-item" href="#">Tenaga Pengajar</a></li>
         <li><a class="dropdown-item" href="#">Fasilias</a></li>
         <li><a class="dropdown-item" href="#">Extrakulikuler</a></li>
      </ul>
   </li>
   <li class="nav-item">
     <a class="nav-link {{ ($title == "Program") ? 'border-bottom border-2' : '' }}" href="#">Program</a>
   </li>
   <li class="nav-item">
     <a class="nav-link {{ ($title == "News") ? 'border-bottom border-2' : '' }}" href="news">Berita</a>
   </li>
   <li class="nav-item">
      <a class="nav-link {{ ($title == "Prestasi") ? 'border-bottom border-2' : '' }}" href="#">Prestasi</a>
    </li>
 </ul>