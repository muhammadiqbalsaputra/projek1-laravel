@php
    $cards = [
        [
            'gambar' => 'https://www.patrobas.id/wp-content/uploads/2022/01/7bb1cbd890c9d35334d23faeab879deb_1636285209033-800x800.jpeg',
            'judul' => 'Sepatu Patrobas',
            'desk' => 'Patrobas Cloud High Olive Terinspirasi dari awan yang empuk',
            'btn' => 'Beli Sekarang'
        ],
        [
            'gambar' => 'https://antarestar.com/wp-content/uploads/2024/02/Desain-tanpa-judul-25.png',
            'judul' => 'Jaket Gunung',
            'desk' => 'Jacket Aether adalah jaket yang dirancang untuk kegiatan outdoor',
            'btn' => 'Beli Sekarang'
        ],
        [
            'gambar' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//catalog-image/95/MTA-105601827/no-brand_celana-panjang-chino-cargo-anak-laki-laki-usia-1-8-tahun_full01.jpg',
            'judul' => 'Celana Cargo',
            'desk' => 'Celana cargo banyak kantong, dengan pilihan 4 warna',
            'btn' => 'Beli Sekarang'
        ],
        [
            'gambar' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//85/MTA-6351510/true_rhodey_true_topi_kupluk_rajut_beanie_hat_-_ec002_full05_mfvytk9o.jpg',
            'judul' => 'Topi Kupluk Pria',
            'desk' => 'Topi kupluk dari bahan kain yang lembut dan nyaman ',
            'btn' => 'Beli Sekarang'
        ],
        [
            'gambar' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//catalog-image/95/MTA-105601827/no-brand_celana-panjang-chino-cargo-anak-laki-laki-usia-1-8-tahun_full01.jpg',
            'judul' => 'Celana Cargo',
            'desk' => 'Celana cargo banyak kantong, dengan pilihan 4 warna',
            'btn' => 'Beli Sekarang'
        ],
    ];
    $alerts = [
      [
        'Diskon 50%'
      ],
      [
        'Diskon 20%'
      ],
      [
        'Diskon 35%'
      ],
      [
        'Diskon 70%'
      ],
      [
        'Diskon 20%'
      ],

      ]
@endphp


<x-Layout>
  <x-slot:title>{{ $title }}</x-slot>

  <h3 class="mb-lg-5 mt-lg-5">Homepage</h3>
  
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-lg-5">
      @foreach ($cards as $index => $card)
        <div class="col">
          <x-card img="{{ $card['gambar'] }}">
            <x-slot name="judul">{{ $card['judul'] }}</x-slot>
            <x-slot name="desk">{{ $card['desk'] }}</x-slot>
            <x-slot name="tombol">{{ $card['btn'] }}</x-slot>
          </x-card>

          @if (isset($alerts[$index]))
            <x-alert pesan="{{ $alerts[$index][0] }}"/>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</x-Layout>

