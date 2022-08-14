<div class="header container pt-5">
    <div class="d-flex flex-row">
        <div class="logo me-auto">
           <a href="/">
            <img src="{{ asset('svg/logo-2.svg') }}" alt="" />
         </a>
        </div>
        <div class="menu my-auto w-50">
            <div class="d-flex flex-row justify-content-between navbar-custom-page">
                <a href="/" class="text-black text-decoration-none nav-link-page">Home</a>
                <div class="dropdown-custom-page">
                    <button class="dropbtn-custom-page dropbtn-custom-page text-black {{ 
                        $title == 'Visi Misi' ||
                        $title == 'Struktur Organisasi' ||
                        $title == 'Tenaga Pengajar' ||
                        $title == 'Fasilitas Sekolah' ||
                        $title == 'Ekstrakulikuler Sekolah' ? 'nav-active-page' : ''
                     }}">
                        Profil
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content-custom-page">
                        <a href="/visimisi">Visi Misi</a>
                        <a href="/struktur">Struktur Organisasi</a>
                        <a href="/pengajar">Tenaga Pengajar</a>
                        <a href="/berita?category=fasilitas">Fasilitas</a>
                        <a href="/berita?category=ekstrakulikuler">Ekstrakulikuler</a>
                    </div>
                </div>
                <a href="/berita?category=program-unggulan" class="text-black text-decoration-none nav-link-page {{ $title == 'Program Unggulan Sekolah' ? 'nav-active-page' : '' }}">Program</a>
                <a href="/berita" class="text-black text-decoration-none nav-link-page {{ $title == 'Berita Sekolah' ? 'nav-active-page' : '' }}">Berita</a>
                <div class="dropdown-custom-page">
                    <button class="dropbtn-custom-page dropbtn-custom-page text-black {{ 
                     $title == 'Prestasi Sekolah' ||
                     $title == 'Prestasi Kepala Sekolah' ||
                     $title == 'Prestasi Guru Sekolah' ? 'nav-active-page' : ''
                  }}">
                        Prestasi
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content-custom-page">
                        <a href="/berita?category=prestasi-sekolah">Sekolah</a>
                        <a href="/berita?category=prestasi-kepala-sekolah">Kepala Sekolah</a>
                        <a href="/berita?category=prestasi-guru">Guru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="divider-4"></div>
</div> 
